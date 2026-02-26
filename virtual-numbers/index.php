<?php
$basePath = '../';
require_once $basePath . 'includes/SeoHelper.php';

$seoConfig = SeoHelper::load('landing-virtual-numbers');

$customHead = '
<link rel="stylesheet" href="' . $basePath . 'telefonia/promo/styles.css?v=2">
<link rel="stylesheet" href="css/styles_mexico.css?v=2"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<style>
    /* Specific overrides to blend styles_mexico with premium styles */
    .hero { padding-top: 100px; } /* Adjust for fixed header */
    body { font-family: "Manrope", sans-serif; } 
    
    /* Ensure Premium Colors override */
    :root {
        --primary-color: #0ea5e9;
        --secondary-color: #0284c7;
        --accent-color: #38bdf8;
    }
    
    /* Fix Header Visibility - Override styles_mexico.css white header */
    header {
        background-color: rgba(3, 38, 66, 0.95) !important;
        backdrop-filter: blur(10px) !important;
    }

    .btn-primary {
        background: var(--primary-color) !important;
        border: none !important;
        color: white !important;
    }
    
    .btn-primary:hover {
        background: var(--secondary-color) !important;
        color: white !important;
    }
</style>
';

include 'header.php';
include 'hero.php';
include 'body.php';
include $basePath . 'includes/contact.php';

// Custom scripts for this page
echo '<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>';
echo '<script src="js/coverage-map.js"></script>';

include $basePath . 'includes/footer.php';
?>