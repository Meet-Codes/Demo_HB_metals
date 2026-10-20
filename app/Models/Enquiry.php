<?php

namespace App\Models;

use Exception;

class Enquiry
{
    public static function create(array $data, array $items = [], ?array $file = null): array
    {
        $reference = 'HBM-' . date('Ym') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));

        $pdo = Database::getConnection();
        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare("INSERT INTO enquiries (
                reference_code, enquiry_type, name, company_name, email, phone,
                country, destination, message, privacy_acknowledged_at, status
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'new')");

            $privacyAck = !empty($data['privacy']) ? date('Y-m-d H:i:s') : null;

            $stmt->execute([
                $reference,
                $data['enquiry_type'] ?? 'rfq',
                $data['name'],
                $data['company_name'] ?? null,
                $data['email'],
                $data['phone'],
                $data['country'] ?? 'India',
                $data['destination'] ?? null,
                $data['message'],
                $privacyAck,
            ]);

            $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
            $enquiryId = (int)($driver === 'pgsql' ? $pdo->lastInsertId('enquiries_id_seq') : $pdo->lastInsertId());

            // Insert enquiry items
            if (!empty($items)) {
                $itemStmt = $pdo->prepare("INSERT INTO enquiry_items (
                    enquiry_id, requested_product_name, quantity, quantity_unit,
                    requested_grade, requested_purity, packaging_preference, specification_notes
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

                foreach ($items as $item) {
                    $itemStmt->execute([
                        $enquiryId,
                        $item['product_name'] ?? null,
                        !empty($item['quantity']) ? (float)$item['quantity'] : null,
                        $item['quantity_unit'] ?? 'Kilogram',
                        $item['grade'] ?? null,
                        $item['purity'] ?? null,
                        $item['packaging'] ?? null,
                        $item['notes'] ?? null,
                    ]);
                }
            }

            // Handle attachment if uploaded securely
            if ($file !== null && !empty($file['tmp_name']) && is_uploaded_file($file['tmp_name'])) {
                $uploadDir = __DIR__ . '/../../storage/private-uploads';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0750, true);
                }

                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $safeName = $reference . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
                $dest = $uploadDir . '/' . $safeName;

                if (move_uploaded_file($file['tmp_name'], $dest)) {
                    $attachStmt = $pdo->prepare("INSERT INTO enquiry_attachments (
                        enquiry_id, stored_filename, original_filename, mime_type, file_size
                    ) VALUES (?, ?, ?, ?, ?)");
                    $attachStmt->execute([
                        $enquiryId,
                        $safeName,
                        basename($file['name']),
                        $file['type'] ?? 'application/octet-stream',
                        (int)$file['size'],
                    ]);
                }
            }

            $pdo->commit();
            return [
                'success' => true,
                'reference' => $reference,
                'enquiry_id' => $enquiryId,
            ];
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log("Enquiry creation failed: " . $e->getMessage());
            return [
                'success' => false,
                'error' => 'An internal error occurred while processing your enquiry. Please contact us directly at info@hbmetals.co.in or call 9898449394.',
            ];
        }
    }
}
