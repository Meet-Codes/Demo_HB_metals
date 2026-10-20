<?php

namespace App\Controllers;

use App\Models\SiteSetting;
use App\Models\Category;
use App\Models\Product;
use App\Models\Faq;
use App\Support\Helpers;

class HomeController
{
    public function index(): void
    {
        $settings = SiteSetting::get();
        $categories = Category::all();
        $featuredProducts = Product::featured();
        $faqs = Faq::all();

        $siteData = require __DIR__ . '/../../data/site_data.php';
        $capabilities = $siteData['capabilities'] ?? [];

        Helpers::view('pages.home', [
            'meta_title' => $settings['seo_default_title'] ?? 'HB Metals India | Manufacturing Metal Powders & Tungsten Compounds',
            'meta_description' => $settings['seo_default_description'] ?? 'Established in 2013, HB Metals India manufactures and supplies Magnesium Metal Powder, Sodium Tungstate, and Tungsten Oxides from Rajkot, Gujarat.',
            'canonical_url' => Helpers::url('/'),
            'settings' => $settings,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'capabilities' => $capabilities,
            'faqs' => $faqs,
        ]);
    }
}
