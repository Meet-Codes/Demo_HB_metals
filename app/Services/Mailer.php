<?php

namespace App\Services;

class Mailer
{
    public static function sendEnquiryNotification(array $enquiryData, string $reference): bool
    {
        $driver = getenv('MAIL_DRIVER') ?: 'log';
        $to = getenv('NOTIFICATION_EMAIL') ?: 'info@hbmetals.co.in';
        $subject = "New Business Enquiry - Ref: {$reference} ({$enquiryData['name']})";

        $body = "HB METALS INDIA - NEW ENQUIRY NOTIFICATION\n";
        $body .= "===========================================\n";
        $body .= "Reference: {$reference}\n";
        $body .= "Date: " . date('Y-m-d H:i:s T') . "\n";
        $body .= "Type: " . strtoupper($enquiryData['enquiry_type'] ?? 'General') . "\n\n";
        $body .= "CONTACT INFORMATION:\n";
        $body .= "Name: {$enquiryData['name']}\n";
        $body .= "Company: " . ($enquiryData['company_name'] ?? 'N/A') . "\n";
        $body .= "Email: {$enquiryData['email']}\n";
        $body .= "Phone: {$enquiryData['phone']}\n";
        $body .= "Country / Destination: " . ($enquiryData['destination'] ?? $enquiryData['country'] ?? 'India') . "\n\n";

        if (!empty($enquiryData['product_name'])) {
            $body .= "PRODUCT REQUIREMENTS:\n";
            $body .= "Product: {$enquiryData['product_name']}\n";
            $body .= "Quantity: " . ($enquiryData['quantity'] ?? 'Unspecified') . " " . ($enquiryData['quantity_unit'] ?? 'Kg') . "\n";
            $body .= "Grade / Specs: " . ($enquiryData['grade'] ?? 'Standard') . "\n";
            $body .= "Packaging: " . ($enquiryData['packaging'] ?? 'Standard Drum') . "\n\n";
        }

        $body .= "MESSAGE:\n" . $enquiryData['message'] . "\n\n";
        $body .= "===========================================\n";

        if ($driver === 'log') {
            $logFile = __DIR__ . '/../../storage/logs/mail.log';
            $logDir = dirname($logFile);
            if (!is_dir($logDir)) {
                mkdir($logDir, 0755, true);
            }
            file_put_contents($logFile, "[MAIL DISPATCH LOG] To: {$to}\nSubject: {$subject}\n{$body}\n\n", FILE_APPEND);
            return true;
        }

        if ($driver === 'mail' || $driver === 'smtp') {
            $from = getenv('MAIL_FROM_ADDRESS') ?: 'info@hbmetals.co.in';
            $headers = [
                'From' => $from,
                'Reply-To' => $enquiryData['email'],
                'X-Mailer' => 'PHP/' . phpversion(),
            ];
            $headerStr = '';
            foreach ($headers as $k => $v) {
                $headerStr .= "{$k}: {$v}\r\n";
            }
            return @mail($to, $subject, $body, $headerStr);
        }

        return true;
    }
}
