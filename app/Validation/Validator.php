<?php

namespace App\Validation;

use App\Support\Csrf;

class Validator
{
    private array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];

        // 1. Anti-spam honeypot check (field named 'website_url_hp' should always be empty)
        if (!empty($data['website_url_hp'])) {
            $this->errors['spam'] = 'Spam detected.';
            return false;
        }

        // 2. CSRF Token verification
        if (!Csrf::verify($data['_token'] ?? null)) {
            $this->errors['csrf'] = 'Security session expired. Please refresh the page and try again.';
            return false;
        }

        foreach ($rules as $field => $fieldRules) {
            $value = isset($data[$field]) ? trim((string)$data[$field]) : '';

            foreach ($fieldRules as $rule) {
                if ($rule === 'required' && $value === '') {
                    $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
                    break;
                }

                if ($rule === 'email' && $value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = 'Please provide a valid email address.';
                    break;
                }

                if ($rule === 'phone' && $value !== '') {
                    // Strip non-digits and test length
                    $digits = preg_replace('/[^\d]/', '', $value);
                    if (strlen($digits) < 7 || strlen($digits) > 15) {
                        $this->errors[$field] = 'Please provide a valid phone number with area/country code.';
                        break;
                    }
                }

                if ($rule === 'min:3' && strlen($value) < 3) {
                    $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' must be at least 3 characters.';
                    break;
                }

                if ($rule === 'min:10' && strlen($value) < 10) {
                    $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' must be at least 10 characters.';
                    break;
                }
            }
        }

        return empty($this->errors);
    }

    public function validateUpload(?array $file): bool
    {
        if ($file === null || empty($file['tmp_name'])) {
            return true; // Optional file
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors['attachment'] = 'File upload error code: ' . $file['error'];
            return false;
        }

        // Limit size to 10MB
        $maxBytes = 10 * 1024 * 1024;
        if ($file['size'] > $maxBytes) {
            $this->errors['attachment'] = 'Attached document exceeds the 10MB size limit.';
            return false;
        }

        // Validate allowed extensions and MIME types
        $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'txt'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed, true)) {
            $this->errors['attachment'] = 'Disallowed file type. Allowed formats: PDF, DOC, DOCX, JPG, PNG, TXT.';
            return false;
        }

        // Verify MIME type using finfo
        if (extension_loaded('fileinfo')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            $allowedMimes = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'image/jpeg',
                'image/png',
                'text/plain',
            ];

            if (!in_array($mime, $allowedMimes, true)) {
                $this->errors['attachment'] = 'File MIME type validation failed.';
                return false;
            }
        }

        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getFirstError(): ?string
    {
        return reset($this->errors) ?: null;
    }
}
