<?php
$basePath = '../../';
require_once $basePath . 'includes/SeoHelper.php';

$seoConfig = SeoHelper::load('landing-chetumal');

$customHead = '<meta name="geo.region" content="MX-ROO" />
<meta name="geo.placename" content="Chetumal" />
<meta name="geo.position" content="18.5002;-88.2961" />
<meta name="ICBM" content="18.5002, -88.2961" />






<!-- Tailwind & Fonts -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet" />
<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

<style>
    .headline-font { font-family: "Inter", sans-serif; font-weight: 900; letter-spacing: -0.03em; }
    .mono-font { font-family: "JetBrains Mono", monospace; }
    .body-font { font-family: "Inter", sans-serif; }
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(15, 34, 35, 0.1);
    }
    .grid-bg {
        background-color: #ffffff;
        background-size: 32px 32px;
        background-image: linear-gradient(to right, rgba(15, 34, 35, 0.03) 1px, transparent 1px),
                          linear-gradient(to bottom, rgba(15, 34, 35, 0.03) 1px, transparent 1px);
    }
    /* Override global header if needed or ensure compatibility */
</style>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#00eeff",
                    "obsidian": "#0f2223",
                    "slate-gray": "#64748b",
                    "background-light": "#ffffff",
                    "background-dark": "#0f2223",
                },
                fontFamily: {
                    "display": ["Inter", "sans-serif"],
                    "mono": ["JetBrains Mono", "monospace"]
                },
                borderRadius: {
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                },
            },
        },
    }
</script>
';

include $basePath . 'includes/header.php';
include 'hero.php';
include 'body.php';
include $basePath . 'includes/contact.php';
include $basePath . 'includes/footer.php';
?>