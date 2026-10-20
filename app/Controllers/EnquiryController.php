<?php

namespace App\Controllers;

use App\Models\SiteSetting;
use App\Models\Enquiry;
use App\Validation\Validator;
use App\Services\Mailer;
use App\Support\Helpers;

class EnquiryController
{
    public function submitContact(): void
    {
        $validator = new Validator();
        $rules = [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'phone'],
            'message' => ['required', 'min:10'],
        ];

        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
               || (isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json'));

        if (!$validator->validate($_POST, $rules)) {
            if ($isAjax) {
                Helpers::json([
                    'success' => false,
                    'errors' => $validator->getErrors(),
                    'message' => $validator->getFirstError(),
                ], 422);
            }
            $_SESSION['form_errors'] = $validator->getErrors();
            $_SESSION['form_old'] = $_POST;
            Helpers::redirect('/contact-us/');
            return;
        }

        $data = [
            'enquiry_type' => 'contact',
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'phone' => trim($_POST['phone']),
            'message' => trim($_POST['message']),
            'privacy' => !empty($_POST['privacy']),
        ];

        $result = Enquiry::create($data);

        if ($result['success']) {
            Mailer::sendEnquiryNotification($data, $result['reference']);

            if ($isAjax) {
                Helpers::json([
                    'success' => true,
                    'reference' => $result['reference'],
                    'message' => "Thank you! Your message has been received. Reference ID: {$result['reference']}.",
                    'redirect' => Helpers::url('/enquiry/thank-you/?ref=' . urlencode($result['reference'])),
                ]);
            }

            Helpers::redirect('/enquiry/thank-you/?ref=' . urlencode($result['reference']));
        } else {
            if ($isAjax) {
                Helpers::json(['success' => false, 'message' => $result['error']], 500);
            }
            $_SESSION['form_error'] = $result['error'];
            Helpers::redirect('/contact-us/');
        }
    }

    public function submitRfq(): void
    {
        $validator = new Validator();
        $rules = [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'phone'],
            'product_name' => ['required'],
            'message' => ['required'],
        ];

        $file = $_FILES['attachment'] ?? null;
        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
               || (isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json'));

        if (!$validator->validate($_POST, $rules) || !$validator->validateUpload($file)) {
            if ($isAjax) {
                Helpers::json([
                    'success' => false,
                    'errors' => $validator->getErrors(),
                    'message' => $validator->getFirstError(),
                ], 422);
            }
            $_SESSION['form_errors'] = $validator->getErrors();
            $_SESSION['form_old'] = $_POST;
            $returnTo = !empty($_POST['return_url']) ? $_POST['return_url'] : '/request-a-quote/';
            Helpers::redirect($returnTo);
            return;
        }

        $data = [
            'enquiry_type' => 'rfq',
            'name' => trim($_POST['name']),
            'company_name' => trim($_POST['company_name'] ?? ''),
            'email' => trim($_POST['email']),
            'phone' => trim($_POST['phone']),
            'destination' => trim($_POST['destination'] ?? 'India'),
            'message' => trim($_POST['message']),
            'product_name' => trim($_POST['product_name']),
            'quantity' => trim($_POST['quantity'] ?? ''),
            'quantity_unit' => trim($_POST['quantity_unit'] ?? 'Kilogram'),
            'grade' => trim($_POST['grade'] ?? ''),
            'packaging' => trim($_POST['packaging'] ?? ''),
            'privacy' => !empty($_POST['privacy']),
        ];

        $item = [
            'product_name' => $data['product_name'],
            'quantity' => $data['quantity'],
            'quantity_unit' => $data['quantity_unit'],
            'grade' => $data['grade'],
            'packaging' => $data['packaging'],
            'notes' => $data['message'],
        ];

        $result = Enquiry::create($data, [$item], $file);

        if ($result['success']) {
            Mailer::sendEnquiryNotification($data, $result['reference']);

            if ($isAjax) {
                Helpers::json([
                    'success' => true,
                    'reference' => $result['reference'],
                    'message' => "Quotation request registered! Reference: {$result['reference']}.",
                    'redirect' => Helpers::url('/enquiry/thank-you/?ref=' . urlencode($result['reference'])),
                ]);
            }

            Helpers::redirect('/enquiry/thank-you/?ref=' . urlencode($result['reference']));
        } else {
            if ($isAjax) {
                Helpers::json(['success' => false, 'message' => $result['error']], 500);
            }
            $_SESSION['form_error'] = $result['error'];
            $returnTo = !empty($_POST['return_url']) ? $_POST['return_url'] : '/request-a-quote/';
            Helpers::redirect($returnTo);
        }
    }

    public function thankYou(): void
    {
        $settings = SiteSetting::get();
        $ref = $_GET['ref'] ?? 'HBM-GENERAL';

        Helpers::view('pages.thank_you', [
            'meta_title' => 'Enquiry Confirmation | HB Metals India',
            'meta_description' => 'Thank you for your enquiry with HB Metals India. We have registered your request and our team will get in touch shortly.',
            'canonical_url' => Helpers::url('/enquiry/thank-you/'),
            'robots_directive' => 'noindex, nofollow',
            'settings' => $settings,
            'reference' => $ref,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Enquiry Received', 'url' => '/enquiry/thank-you/'],
            ],
        ]);
    }
}
