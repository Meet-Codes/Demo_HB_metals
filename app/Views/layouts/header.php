<?php
use App\Support\Helpers;
$currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
?>

<!-- Top Industrial Dispatch & Information Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-left">
            <span class="top-bar-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span>Works: Shapar, Rajkot (Gujarat, India)</span>
            </span>
            <span class="top-bar-item" style="opacity:0.8;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>Mon–Sat: 9:00 AM – 6:30 PM IST</span>
            </span>
        </div>
        <div class="top-bar-right">
            <span class="top-bar-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <a href="tel:<?= Helpers::e($settings['phone'] ?? '+919898449394') ?>">+91 <?= Helpers::e($settings['phone_display'] ?? '98984 49394') ?></a>
            </span>
            <span class="top-bar-item">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <a href="mailto:<?= Helpers::e($settings['email'] ?? 'info@hbmetals.co.in') ?>"><?= Helpers::e($settings['email'] ?? 'info@hbmetals.co.in') ?></a>
            </span>
        </div>
    </div>
</div>

<!-- Main Sticky Liquid-Glass Navigation Bar -->
<header class="site-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <!-- Brand Identity -->
            <a href="<?= Helpers::url('/') ?>" class="site-brand" aria-label="HB Metals India Home">
                <img src="<?= Helpers::asset('/assets/images/logo.png') ?>" alt="HB Metals India" class="brand-logo" width="160" height="49">
            </a>

            <!-- Primary Navigation Links -->
            <nav class="primary-nav" id="primary-navigation" role="navigation" aria-label="Main Navigation">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="<?= Helpers::url('/') ?>" class="nav-link <?= $currentUri === '/' ? 'active' : '' ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Helpers::url('/about-us/') ?>" class="nav-link <?= str_starts_with($currentUri, '/about-us') ? 'active' : '' ?>">About Us</a>
                    </li>
                    <li class="nav-item has-dropdown">
                        <a href="<?= Helpers::url('/our-products/') ?>" class="nav-link <?= str_starts_with($currentUri, '/our-products') || str_starts_with($currentUri, '/product-category') ? 'active' : '' ?>" aria-haspopup="true" aria-expanded="false">
                            Products <span aria-hidden="true" style="font-size:0.65em; margin-left:2px; opacity:0.8;">▼</span>
                        </a>
                        <div class="nav-dropdown" role="menu">
                            <a href="<?= Helpers::url('/product-category/magnesium-products/') ?>">
                                <span>Magnesium Products</span>
                                <span class="cas-tag-dark" style="font-size:0.68rem;">Mg</span>
                            </a>
                            <a href="<?= Helpers::url('/product-category/sodium-tungstate/') ?>">
                                <span>Sodium Tungstate &amp; Salts</span>
                                <span class="cas-tag-dark" style="font-size:0.68rem;">Na₂WO₄</span>
                            </a>
                            <a href="<?= Helpers::url('/product-category/tungsten-powder/') ?>">
                                <span>Tungsten Powder</span>
                                <span class="cas-tag-dark" style="font-size:0.68rem;">W</span>
                            </a>
                            <a href="<?= Helpers::url('/product-category/tungsten-oxide/') ?>">
                                <span>Tungsten Oxide</span>
                                <span class="cas-tag-dark" style="font-size:0.68rem;">WO₃</span>
                            </a>
                            <a href="<?= Helpers::url('/product-category/ammonium-paratungstate/') ?>">
                                <span>Ammonium Paratungstate</span>
                                <span class="cas-tag-dark" style="font-size:0.68rem;">APT</span>
                            </a>
                            <a href="<?= Helpers::url('/product-category/metal-oxides/') ?>">
                                <span>Metal Oxides (Cobalt)</span>
                                <span class="cas-tag-dark" style="font-size:0.68rem;">CoO</span>
                            </a>
                            <a href="<?= Helpers::url('/product-category/metallic-salts/') ?>">
                                <span>Metallic Salts</span>
                                <span class="cas-tag-dark" style="font-size:0.68rem;">Pure</span>
                            </a>
                            <a href="<?= Helpers::url('/our-products/') ?>" class="nav-dropdown-all">
                                <span>View All 14 Products</span>
                                <span>→</span>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Helpers::url('/capabilities/') ?>" class="nav-link <?= str_starts_with($currentUri, '/capabilities') ? 'active' : '' ?>">Capabilities</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Helpers::url('/quality/') ?>" class="nav-link <?= str_starts_with($currentUri, '/quality') ? 'active' : '' ?>">Quality</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Helpers::url('/technical-resources/') ?>" class="nav-link <?= str_starts_with($currentUri, '/technical-resources') ? 'active' : '' ?>">Technical Resources</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Helpers::url('/contact-us/') ?>" class="nav-link <?= str_starts_with($currentUri, '/contact-us') ? 'active' : '' ?>">Contact</a>
                    </li>
                </ul>
            </nav>

            <!-- Actions Right -->
            <div class="header-actions">
                <a href="<?= Helpers::url('/request-a-quote/') ?>" class="btn btn-primary btn-quote" data-open-rfq>Request a Quote</a>
                <button type="button" class="menu-toggle-btn" aria-controls="primary-navigation" aria-expanded="false" aria-label="Toggle Navigation Menu">
                    ☰
                </button>
            </div>
        </div>
    </div>
</header>
