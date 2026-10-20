<?php

namespace App\Controllers;

use App\Models\SiteSetting;
use App\Models\Category;
use App\Models\Product;
use App\Models\TechnicalDocument;
use App\Support\Helpers;

class ProductController
{
    public function index(): void
    {
        $settings = SiteSetting::get();
        $categories = Category::all();

        $search = $_GET['q'] ?? null;
        $categorySlug = $_GET['category'] ?? null;
        $categoryId = null;

        if ($categorySlug) {
            $cat = Category::findBySlug($categorySlug);
            if ($cat) {
                $categoryId = (int)$cat['id'];
            }
        }

        $products = Product::all($categoryId, $search);

        Helpers::view('products.index', [
            'meta_title' => 'Our Product Catalogue | HB Metals India - Metal Powders & Compounds',
            'meta_description' => 'Browse our high-purity product catalogue: Magnesium Metal Powder, Magnesium Turnings, Sodium Tungstate, Tungsten Trioxide Powder, and Metallic Salts.',
            'canonical_url' => Helpers::url('/our-products/'),
            'settings' => $settings,
            'categories' => $categories,
            'products' => $products,
            'currentSearch' => $search,
            'currentCategorySlug' => $categorySlug,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Our Products', 'url' => '/our-products/'],
            ],
        ]);
    }

    public function category(string $slug): void
    {
        $settings = SiteSetting::get();
        $category = Category::findBySlug($slug);

        if (!$category) {
            http_response_code(404);
            Helpers::view('errors.404', [
                'meta_title' => 'Category Not Found | HB Metals India',
                'requested_path' => "/product-category/{$slug}/",
            ]);
            return;
        }

        $allCategories = Category::all();
        $products = Product::all((int)$category['id']);

        Helpers::view('products.category', [
            'meta_title' => "{$category['name']} | HB Metals India",
            'meta_description' => $category['short_description'] ?? "Explore our complete range of {$category['name']}.",
            'canonical_url' => Helpers::url("/product-category/{$category['slug']}/"),
            'settings' => $settings,
            'category' => $category,
            'allCategories' => $allCategories,
            'products' => $products,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Our Products', 'url' => '/our-products/'],
                ['label' => $category['name'], 'url' => "/product-category/{$category['slug']}/"],
            ],
        ]);
    }

    public function show(string $slug): void
    {
        $settings = SiteSetting::get();
        $product = Product::findBySlug($slug);

        if (!$product) {
            http_response_code(404);
            Helpers::view('errors.404', [
                'meta_title' => 'Product Not Found | HB Metals India',
                'requested_path' => "/{$slug}/",
            ]);
            return;
        }

        $relatedProducts = Product::getRelated((int)$product['id'], !empty($product['category_id']) ? (int)$product['category_id'] : null);
        $documents = TechnicalDocument::forProduct($product['slug']);

        $categoryUrl = !empty($product['category_slug']) ? "/product-category/{$product['category_slug']}/" : '/our-products/';
        $categoryLabel = $product['category_name'] ?? 'Products';

        Helpers::view('products.show', [
            'meta_title' => "{$product['name']} - Specifications & Quote | HB Metals India",
            'meta_description' => $product['short_description'] ?? "Technical specifications, applications, and commercial supply terms for {$product['name']}.",
            'canonical_url' => Helpers::url("/{$product['slug']}/"),
            'settings' => $settings,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'documents' => $documents,
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => '/'],
                ['label' => 'Our Products', 'url' => '/our-products/'],
                ['label' => $categoryLabel, 'url' => $categoryUrl],
                ['label' => $product['name'], 'url' => "/{$product['slug']}/"],
            ],
        ]);
    }
}
