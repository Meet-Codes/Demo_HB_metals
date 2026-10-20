<?php

namespace App\Controllers;

use App\Models\SiteSetting;
use App\Models\Category;
use App\Models\Product;
use App\Models\Faq;
use App\Support\Helpers;

class PageController
{
    public function about(): void
    {
        $settings = SiteSetting::get();
        $siteData = require __DIR__ . '/../../data/site_data.php';

        Helpers::view('pages.about', [
            'meta_title' => 'About Us | HB Metals India - Manufacturing Metal Powders & Tungsten Compounds',
            'meta_description' => 'Learn about HB Metals, established in 2013 in Rajkot, Gujarat. Dedicated to high-purity processing, technical integrity, and customer satisfaction.',
            'canonical_url' => Helpers::url('/about-us/'),
            'settings' => $settings,
            'capabilities' => $siteData['capabilities'] ?? [],
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'About Us', 'url' => '/about-us/'],
            ],
        ]);
    }

    public function capabilities(): void
    {
        $settings = SiteSetting::get();
        $siteData = require __DIR__ . '/../../data/site_data.php';

        Helpers::view('pages.capabilities', [
            'meta_title' => 'Manufacturing & Processing Capabilities | HB Metals India',
            'meta_description' => 'Explore our high-speed automatic processing, quality testing, specialized packaging, and raw material sourcing capabilities in Shapar, Rajkot.',
            'canonical_url' => Helpers::url('/capabilities/'),
            'settings' => $settings,
            'capabilities' => $siteData['capabilities'] ?? [],
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Capabilities', 'url' => '/capabilities/'],
            ],
        ]);
    }

    public function quality(): void
    {
        $settings = SiteSetting::get();

        Helpers::view('pages.quality', [
            'meta_title' => 'Quality Assurance & Standards | HB Metals India',
            'meta_description' => 'Our verified quality assurance framework: batch sampling, purity testing, analytical inspection, and moisture-proof packaging verification.',
            'canonical_url' => Helpers::url('/quality/'),
            'settings' => $settings,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Quality', 'url' => '/quality/'],
            ],
        ]);
    }

    public function contact(): void
    {
        $settings = SiteSetting::get();

        Helpers::view('pages.contact', [
            'meta_title' => 'Contact Us | HB Metals India - Rajkot, Gujarat',
            'meta_description' => 'Contact HB Metals India in Shapar, Rajkot. Phone: +91 9898449394, Email: info@hbmetals.co.in. Speak with Managing Director Mr. Anil Patel or our technical team.',
            'canonical_url' => Helpers::url('/contact-us/'),
            'settings' => $settings,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Contact Us', 'url' => '/contact-us/'],
            ],
        ]);
    }

    public function requestQuote(): void
    {
        $settings = SiteSetting::get();
        $products = Product::all();
        $preselectedProduct = $_GET['product'] ?? '';

        Helpers::view('pages.request_quote', [
            'meta_title' => 'Request a Commercial Quote | HB Metals India',
            'meta_description' => 'Request bulk supply pricing and technical specifications for Magnesium Metal Powder, Sodium Tungstate, Tungsten Trioxide, and Metallic Salts.',
            'canonical_url' => Helpers::url('/request-a-quote/'),
            'settings' => $settings,
            'products' => $products,
            'preselectedProduct' => $preselectedProduct,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Request a Quote', 'url' => '/request-a-quote/'],
            ],
        ]);
    }

    public function faqs(): void
    {
        $settings = SiteSetting::get();
        $faqs = Faq::all();

        Helpers::view('pages.faqs', [
            'meta_title' => 'Frequently Asked Questions (FAQs) | HB Metals India',
            'meta_description' => 'Answers to key commercial questions regarding order quantities, minimum order quantities (25 Kg), packaging standards, and COA documentation.',
            'canonical_url' => Helpers::url('/faq/'),
            'settings' => $settings,
            'faqs' => $faqs,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'FAQs', 'url' => '/faq/'],
            ],
        ]);
    }

    public function sitemap(): void
    {
        $settings = SiteSetting::get();
        $categories = Category::all();
        $products = Product::all();

        Helpers::view('pages.sitemap_html', [
            'meta_title' => 'HTML Sitemap & Navigation Index | HB Metals India',
            'meta_description' => 'Complete directory of products, categories, technical documentation, and company pages on HB Metals India.',
            'canonical_url' => Helpers::url('/sitemap/'),
            'settings' => $settings,
            'categories' => $categories,
            'products' => $products,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Sitemap', 'url' => '/sitemap/'],
            ],
        ]);
    }

    public function privacyPolicy(): void
    {
        $settings = SiteSetting::get();

        Helpers::view('pages.privacy_policy', [
            'meta_title' => 'Privacy Policy | HB Metals India',
            'meta_description' => 'Privacy policy detailing the lawful handling, transmission, and protection of business enquiry data submitted to HB Metals India.',
            'canonical_url' => Helpers::url('/privacy-policy/'),
            'settings' => $settings,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Privacy Policy', 'url' => '/privacy-policy/'],
            ],
        ]);
    }

    public function terms(): void
    {
        $settings = SiteSetting::get();

        Helpers::view('pages.terms', [
            'meta_title' => 'Terms & Conditions | HB Metals India',
            'meta_description' => 'Commercial terms, quotation validity, packaging, and supply stipulations for HB Metals India products.',
            'canonical_url' => Helpers::url('/terms-and-conditions/'),
            'settings' => $settings,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Terms & Conditions', 'url' => '/terms-and-conditions/'],
            ],
        ]);
    }
}
