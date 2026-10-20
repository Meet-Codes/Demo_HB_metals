<?php

namespace App\Controllers;

use App\Models\SiteSetting;
use App\Models\TechnicalDocument;
use App\Models\Product;
use App\Support\Helpers;

class TechnicalController
{
    public function index(): void
    {
        $settings = SiteSetting::get();
        $documents = TechnicalDocument::all();
        $products = Product::all();

        Helpers::view('pages.technical_resources', [
            'meta_title' => 'Technical Resources & Data Sheets (TDS) | HB Metals India',
            'meta_description' => 'Access verified technical specifications, handling guidelines, and Technical Data Sheets (TDS) for our metal powder and tungsten compound product lines.',
            'canonical_url' => Helpers::url('/technical-resources/'),
            'settings' => $settings,
            'documents' => $documents,
            'products' => $products,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Technical Resources', 'url' => '/technical-resources/'],
            ],
        ]);
    }
}
