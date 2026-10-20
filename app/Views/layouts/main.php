<?php
use App\Support\Helpers;

$pageTitle = !empty($meta_title) ? $meta_title : ($settings['seo_default_title'] ?? 'HB Metals India');
$pageDesc = !empty($meta_description) ? $meta_description : ($settings['seo_default_description'] ?? 'HB Metals India - Metal Powders & Tungsten Compounds');
$canonical = !empty($canonical_url) ? $canonical_url : Helpers::url($_SERVER['REQUEST_URI'] ?? '/');
$robots = !empty($robots_directive) ? $robots_directive : 'index, follow';

// =============================================================================
// Contextual Background Motion Video Mapping (Authentic Match per Business Domain)
// =============================================================================
$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestUri = rtrim($requestUri, '/') ?: '/';

$pageVideoData = [
    'video' => '/assets/videos/home-metallurgy.mp4',
    'badge' => 'HB-CORE // METALLURGICAL REACTOR // 1650°C',
    'title' => 'PRECISION PYROMETALLURGY & ALLOY SYNTHESIS',
    'tag' => 'STAGE 01: INDUCTION CRUCIBLE'
];

if ($requestUri === '/' || $requestUri === '' || $requestUri === '/index.php') {
    $pageVideoData = [
        'video' => '/assets/videos/home-metallurgy.mp4',
        'badge' => 'HB-CORE // METALLURGICAL REACTOR // 1650°C',
        'title' => 'PRECISION PYROMETALLURGY & ALLOY SYNTHESIS',
        'tag' => 'STAGE 01: INDUCTION CRUCIBLE'
    ];
} elseif (str_contains($requestUri, 'about-us')) {
    $pageVideoData = [
        'video' => '/assets/videos/about-plant.mp4',
        'badge' => 'HB-PLANT // RAJKOT MANUFACTURING INFRASTRUCTURE // EST. 2013',
        'title' => 'INDUSTRIAL INFRASTRUCTURE & REFINING FOUNDRY',
        'tag' => 'STAGE 02: FACILITY OVERVIEW'
    ];
} elseif (str_contains($requestUri, 'capabilities')) {
    $pageVideoData = [
        'video' => '/assets/videos/capabilities-robotics.mp4',
        'badge' => 'HB-AUTOMATION // HIGH-PRECISION ROBOTIC PROCESSING & SCREENING',
        'title' => 'AUTOMATED PRECISION SIZING & PULVERIZATION',
        'tag' => 'STAGE 03: ROBOTIC PROCESSING'
    ];
} elseif (str_contains($requestUri, 'quality')) {
    $pageVideoData = [
        'video' => '/assets/videos/quality-microscope.mp4',
        'badge' => 'HB-LAB // SCANNING ELECTRON & PURITY SPECTROMETRY // 99.8%+',
        'title' => 'SPECTROMETRIC PURITY ANALYSIS & COA VERIFICATION',
        'tag' => 'STAGE 04: QUALITY INSPECTION'
    ];
} elseif (str_contains($requestUri, 'our-products') || str_contains($requestUri, 'product-category')) {
    $pageVideoData = [
        'video' => '/assets/videos/products-chemical.mp4',
        'badge' => 'HB-CATALOGUE // TUNGSTEN COMPOUNDS & CHEMICAL SYNTHESIS',
        'title' => 'CHEMICAL SYNTHESIS & METALLURGICAL SALTS',
        'tag' => 'STAGE 05: CHEMICAL SYNTHESIS'
    ];
} elseif (str_contains($requestUri, 'request-a-quote')) {
    $pageVideoData = [
        'video' => '/assets/videos/logistics-terminal.mp4',
        'badge' => 'HB-SUPPLY // GLOBAL FREIGHT & COMMERCIAL DISPATCH TERMINAL',
        'title' => 'INTERNATIONAL EXPORT LOGISTICS & BULK SUPPLY',
        'tag' => 'STAGE 06: GLOBAL LOGISTICS'
    ];
} elseif (str_contains($requestUri, 'technical-resources') || str_contains($requestUri, 'faq')) {
    $pageVideoData = [
        'video' => '/assets/videos/technical-dropper.mp4',
        'badge' => 'HB-DOCS // TITRATION & ANALYTICAL CHEMISTRY ARCHIVES',
        'title' => 'LABORATORY REAGENTS & TITRATION CERTIFICATES',
        'tag' => 'STAGE 07: TECHNICAL PROTOCOLS'
    ];
} elseif (str_contains($requestUri, 'contact-us') || str_contains($requestUri, 'privacy-policy') || str_contains($requestUri, 'terms-and-conditions') || str_contains($requestUri, 'sitemap')) {
    $pageVideoData = [
        'video' => '/assets/videos/facility-corridor.mp4',
        'badge' => 'HB-HQ // SHAPAR EXECUTIVE CORRIDOR & DIRECT LIAISON',
        'title' => 'CORPORATE HEADQUARTERS & TECHNICAL LIAISON',
        'tag' => 'STAGE 08: FACILITY ACCESS'
    ];
} else {
    // Individual product detail pages
    $pageVideoData = [
        'video' => '/assets/videos/products-sparks.mp4',
        'badge' => 'HB-SPEC // ELEMENTAL POWDER DYNAMICS & PYROTECHNIC MATRIX',
        'title' => 'PYROPHORIC INCANDESCENCE & POWDER DISPERSION',
        'tag' => 'STAGE 09: MATERIAL SCIENCE'
    ];
}

// Allow explicit overrides
if (!empty($pageVideo)) { $pageVideoData['video'] = $pageVideo; }
if (!empty($pageVideoBadge)) { $pageVideoData['badge'] = $pageVideoBadge; }
if (!empty($pageVideoTitle)) { $pageVideoData['title'] = $pageVideoTitle; }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title><?= Helpers::e($pageTitle) ?></title>
    <meta name="description" content="<?= Helpers::e($pageDesc) ?>">
    <meta name="robots" content="<?= Helpers::e($robots) ?>">
    <link rel="canonical" href="<?= Helpers::e($canonical) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= Helpers::asset('/assets/images/favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= Helpers::asset('/assets/images/favicon.png') ?>">

    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= Helpers::e($pageTitle) ?>">
    <meta property="og:description" content="<?= Helpers::e($pageDesc) ?>">
    <meta property="og:url" content="<?= Helpers::e($canonical) ?>">
    <meta property="og:site_name" content="HB Metals India">
    <meta property="og:image" content="<?= Helpers::url('/assets/images/logo.png') ?>">

    <!-- CSS Design Tokens & Stylesheets -->
    <link rel="stylesheet" href="<?= Helpers::asset('/assets/css/tokens.css') ?>">
    <link rel="stylesheet" href="<?= Helpers::asset('/assets/css/base.css') ?>">
    <link rel="stylesheet" href="<?= Helpers::asset('/assets/css/layout.css') ?>">
    <link rel="stylesheet" href="<?= Helpers::asset('/assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= Helpers::asset('/assets/css/animations.css') ?>">
    <link rel="stylesheet" href="<?= Helpers::asset('/assets/css/cinematic-video.css') ?>">
    <link rel="stylesheet" href="<?= Helpers::asset('/assets/css/responsive.css') ?>">

    <!-- Organization Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "HB Metals India",
        "url": "<?= Helpers::url('/') ?>",
        "logo": "<?= Helpers::url('/assets/images/logo.png') ?>",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91-<?= Helpers::e($settings['phone'] ?? '9898449394') ?>",
            "contactType": "sales",
            "areaServed": "IN",
            "availableLanguage": ["English", "Hindi", "Gujarati"]
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= Helpers::e($settings['address_line_1'] ?? 'S.No. 41/1 Golden Industrial Estate-B, Plot-1') ?>",
            "addressLocality": "<?= Helpers::e($settings['city'] ?? 'Rajkot') ?>",
            "addressRegion": "<?= Helpers::e($settings['state'] ?? 'Gujarat') ?>",
            "postalCode": "<?= Helpers::e($settings['postal_code'] ?? '360030') ?>",
            "addressCountry": "IN"
        }
    }
    </script>
    <?php
    $isHomePage = ($requestUri === '/' || $requestUri === '' || $requestUri === '/index.php');
    ?>
</head>
<body class="<?= $isHomePage ? 'page-home' : '' ?>">
    <!-- Top & Bottom Anamorphic Movie Framing -->
    <div class="cinematic-letterbox-top" aria-hidden="true"></div>
    <div class="cinematic-letterbox-bottom" aria-hidden="true"></div>

    <!-- Master Fullscreen Video Motion Background Stage -->
    <div id="cinematic-video-stage" aria-hidden="true">
        <video class="cinematic-video-player"
               src="<?= Helpers::asset($pageVideoData['video']) ?>"
               autoplay
               muted
               loop
               playsinline
               webkit-playsinline
               x5-playsinline
               preload="metadata"></video>
        <div class="cinematic-video-vignette"></div>
    </div>

    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header -->
    <?php require __DIR__ . '/header.php'; ?>

    <!-- Breadcrumbs Component -->
    <?php if (!empty($breadcrumbs)): ?>
        <?php require __DIR__ . '/../components/breadcrumbs.php'; ?>
    <?php endif; ?>

    <!-- Main View Content -->
    <main id="main-content" class="site-main" role="main">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <?php require __DIR__ . '/footer.php'; ?>

    <!-- Global RFQ Modal Component -->
    <?php require __DIR__ . '/../components/rfq_modal.php'; ?>

    <!-- Mobile Bottom Navigation Dock (Mobile Only) -->
    <?php require __DIR__ . '/../components/mobile_dock.php'; ?>

    <!-- 3D Graphics Engine for Interactive Molecular Viewer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js" defer></script>

    <!-- JavaScript Bundle -->
    <script src="<?= Helpers::asset('/assets/js/navigation.js') ?>" defer></script>
    <script src="<?= Helpers::asset('/assets/js/forms.js') ?>" defer></script>
    <script src="<?= Helpers::asset('/assets/js/motion.js') ?>" defer></script>
    <script src="<?= Helpers::asset('/assets/js/tilt.js') ?>" defer></script>
    <script src="<?= Helpers::asset('/assets/js/cinematic-video.js') ?>" defer></script>
    <script src="<?= Helpers::asset('/assets/js/molecule-viewer.js') ?>" defer></script>
    <script src="<?= Helpers::asset('/assets/js/morph-hero-slider.js') ?>" defer></script>
    <script src="<?= Helpers::asset('/assets/js/main.js') ?>" defer></script>
</body>
</html>
