<?php

declare(strict_types=1);

// Handle PHP built-in web server static files
if (php_sapi_name() === 'cli-server') {
    $filePath = __DIR__ . parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    if (is_file($filePath)) {
        return false;
    }
}

/**
 * HB Metals India - Master Application Entry Point
 * Architecture: PHP 8.2+ OOP MVC with Strict PDO Prepared Statements
 */

// PSR-4 style autoloader for App\ namespace
spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Config\App;
use App\Routing\Router;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\ProductController;
use App\Controllers\EnquiryController;
use App\Controllers\TechnicalController;
use App\Controllers\SeoController;

// Boot application, environment variables, security headers & session
App::boot();

// Instantiate Router
$router = new Router();

// =============================================================================
// Primary Navigation & Informational Routes
// =============================================================================
$router->get('/', [HomeController::class, 'index']);
$router->get('/about-us/', [PageController::class, 'about']);
$router->get('/capabilities/', [PageController::class, 'capabilities']);
$router->get('/quality/', [PageController::class, 'quality']);
$router->get('/contact-us/', [PageController::class, 'contact']);
$router->get('/request-a-quote/', [PageController::class, 'requestQuote']);
$router->get('/technical-resources/', [TechnicalController::class, 'index']);
$router->get('/faq/', [PageController::class, 'faqs']);
$router->get('/sitemap/', [PageController::class, 'sitemap']);
$router->get('/privacy-policy/', [PageController::class, 'privacyPolicy']);
$router->get('/terms-and-conditions/', [PageController::class, 'terms']);

// =============================================================================
// Product Catalogue Routes
// =============================================================================
$router->get('/our-products/', [ProductController::class, 'index']);

// Verified Individual Product Routes (preserves live website canonical URLs)
$router->get('/magnesium-metal-powder/', function() {
    (new ProductController())->show('magnesium-metal-powder');
});
$router->get('/magnesium-metal-turning/', function() {
    (new ProductController())->show('magnesium-metal-turning');
});
$router->get('/sodium-tungstate/', function() {
    (new ProductController())->show('sodium-tungstate');
});
$router->get('/tungsten-trioxide-powder/', function() {
    (new ProductController())->show('tungsten-trioxide-powder');
});
$router->get('/tungstic-acid/', function() {
    (new ProductController())->show('tungstic-acid');
});
$router->get('/cobalt-oxide/', function() {
    (new ProductController())->show('cobalt-oxide');
});
$router->get('/cobalt-acetate/', function() {
    (new ProductController())->show('cobalt-acetate');
});
$router->get('/ammonium-paratungstate/', function() {
    (new ProductController())->show('ammonium-paratungstate');
});

// =============================================================================
// Form Submission & Confirmation Routes
// =============================================================================
$router->post('/contact-submit/', [EnquiryController::class, 'submitContact']);
$router->post('/rfq-submit/', [EnquiryController::class, 'submitRfq']);
$router->get('/enquiry/thank-you/', [EnquiryController::class, 'thankYou']);

// =============================================================================
// Search Engine Optimization (SEO) & System Routes
// =============================================================================
$router->get('/sitemap.xml', [SeoController::class, 'sitemapXml']);
$router->get('/robots.txt', [SeoController::class, 'robotsTxt']);

// Execute Routing Dispatch
$router->dispatch();
