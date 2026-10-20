<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Support\Helpers;

class SeoController
{
    public function sitemapXml(): void
    {
        header('Content-Type: application/xml; charset=utf-8');

        $staticPages = [
            ['loc' => '/', 'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => '/about-us/', 'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => '/our-products/', 'priority' => '0.9', 'freq' => 'weekly'],
            ['loc' => '/capabilities/', 'priority' => '0.7', 'freq' => 'monthly'],
            ['loc' => '/quality/', 'priority' => '0.7', 'freq' => 'monthly'],
            ['loc' => '/technical-resources/', 'priority' => '0.8', 'freq' => 'weekly'],
            ['loc' => '/contact-us/', 'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => '/request-a-quote/', 'priority' => '0.9', 'freq' => 'monthly'],
            ['loc' => '/faq/', 'priority' => '0.6', 'freq' => 'monthly'],
            ['loc' => '/sitemap/', 'priority' => '0.5', 'freq' => 'monthly'],
        ];

        $categories = Category::all();
        $products = Product::all();
        $today = date('Y-m-d');

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($staticPages as $page) {
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars(Helpers::url($page['loc']), ENT_XML1, 'UTF-8') . "</loc>\n";
            echo "    <lastmod>{$today}</lastmod>\n";
            echo "    <changefreq>{$page['freq']}</changefreq>\n";
            echo "    <priority>{$page['priority']}</priority>\n";
            echo "  </url>\n";
        }

        foreach ($categories as $cat) {
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars(Helpers::url("/product-category/{$cat['slug']}/"), ENT_XML1, 'UTF-8') . "</loc>\n";
            echo "    <lastmod>{$today}</lastmod>\n";
            echo "    <changefreq>weekly</changefreq>\n";
            echo "    <priority>0.8</priority>\n";
            echo "  </url>\n";
        }

        foreach ($products as $prod) {
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars(Helpers::url("/{$prod['slug']}/"), ENT_XML1, 'UTF-8') . "</loc>\n";
            echo "    <lastmod>{$today}</lastmod>\n";
            echo "    <changefreq>weekly</changefreq>\n";
            echo "    <priority>0.9</priority>\n";
            echo "  </url>\n";
        }

        echo '</urlset>';
        exit;
    }

    public function robotsTxt(): void
    {
        header('Content-Type: text/plain; charset=utf-8');
        $sitemapUrl = Helpers::url('/sitemap.xml');

        echo "User-agent: *\n";
        echo "Allow: /\n";
        echo "Disallow: /storage/\n";
        echo "Disallow: /enquiry/thank-you/\n";
        echo "Disallow: /*?*q=\n";
        echo "\n";
        echo "Sitemap: {$sitemapUrl}\n";
        exit;
    }
}
