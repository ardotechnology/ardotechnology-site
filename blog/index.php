<?php
// /blog/index.php

// 1. Configuration & Setup
// -------------------------------------------------------------------------
define('BLOG_ROOT', __DIR__);
define('DATA_DIR', BLOG_ROOT . '/data/posts');
define('CACHE_DIR', BLOG_ROOT . '/cache');
define('INCLUDES_DIR', BLOG_ROOT . '/includes');
define('MAIN_INCLUDES_DIR', dirname(__DIR__) . '/includes');

// Dynamic Base URL Detection
// Production: Hardcoded to ensure correct paths
if (strpos($_SERVER['HTTP_HOST'], 'ardo.technology') !== false) {
    $baseUrl = '/blog/';
} else {
    $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
    $baseUrl = rtrim($scriptDir, '/') . '/';
}

// Ensure cache directory exists
if (!is_dir(CACHE_DIR)) {
    mkdir(CACHE_DIR, 0755, true);
}

// 2. Helper Functions
// -------------------------------------------------------------------------
function get_all_posts()
{
    $files = glob(DATA_DIR . '/*.json');
    $posts = [];
    foreach ($files as $file) {
        $json = json_decode(file_get_contents($file), true);
        if ($json) {
            $posts[] = $json;
        }
    }
    // Sort by date descending
    usort($posts, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    return $posts;
}

function get_post($slug)
{
    if (!preg_match('/^[a-z0-9-]+$/', $slug)) {
        return null;
    }
    $file = DATA_DIR . '/' . $slug . '.json';
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    }
    return null;
}

function render_view($view, $data = [])
{
    extract($data);
    global $pageTitle, $pageDescription, $basePath, $baseUrl; // Make $baseUrl available

    // Fallbacks for header.php
    // Since we are deep in /ardocrm/ardotechnology/blog/, we need to point back to /ardocrm/ardotechnology/
    // Actually, header.php likely expects $basePath to be relative to it, or absolute.
    // Let's assume header.php uses $basePath for styles. 
    // If $baseUrl is /ardocrm/ardotechnology/blog/, then styles are at ../
    // Production: We are at /blog/, so root is one level up '/'.
    // However, if header.php uses absolute paths or we want to be safe, '/' is often best for web root.
    // $basePath = '/';
    $basePath = '../'; // Local fallback & Production relative path

    ob_start();
    include MAIN_INCLUDES_DIR . '/header.php';

    // Simple Router View Logic
    if ($view === 'list') {
        echo '<section class="hero-internal" style="position: relative; padding: 60px 0 60px; display: flex; align-items: center; background: #fff;">';
        echo '<div class="container">';
        echo '<div style="text-align: center; max-width: 900px; margin: 0 auto;">';
        echo '<p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">CONOCIMIENTO</p>';
        echo '<h1 class="text-huge" style="color: var(--ardo-midnight); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2rem; line-height: 1.1;">Blog <span class="text-cyan">Tecnológico</span>.</h1>';
        echo '<p style="color: var(--ardo-text-muted); font-size: 1.2rem; max-width: 700px; margin: 0 auto; line-height: 1.6;">Últimas noticias sobre telefonía VoIP, Cloud PBX y tecnología empresarial.</p>';
        echo '</div>';
        echo '</div>';
        echo '</section>';

        echo '<section style="padding-bottom: 100px; background: var(--ardo-surface);">';
        echo '<div class="container">';
        echo '<div class="bento-grid" style="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: -3rem; position: relative; z-index: 2;">';
        if (empty($posts)) {
            echo '<p style="grid-column: 1 / -1; text-align: center;">No hay entradas publicadas aún.</p>';
        } else {
            foreach ($posts as $post) {
                // Pass $baseUrl to the include scope
                include INCLUDES_DIR . '/post-card.php';
            }
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';
    } elseif ($view === 'single') {
        $post = $data['post'];
        $thumbnail = isset($post['thumbnail']) ? $post['thumbnail'] : '';

        echo '<div style="background: var(--ardo-surface); min-height: 100vh;">'; // Wrapper

        // Single Post Header (Hero-ish)
        echo '<div style="background: #fff; padding: 60px 0 40px; border-bottom: 1px solid var(--ardo-border);">';
        echo '<div class="container">'; // Removed max-width restriction
        echo '<a href="' . $baseUrl . '" class="text-mono-label" style="text-decoration: none; color: var(--ardo-text-muted); margin-bottom: 2rem; display: inline-block;">&larr; VOLVER AL BLOG</a>';
        echo '<h1 style="font-size: clamp(2rem, 4vw, 3rem); font-weight: 900; color: var(--ardo-midnight); line-height: 1.1; margin-bottom: 1rem;">' . htmlspecialchars($post['title']) . '</h1>';
        echo '<div style="display: flex; align-items: center; gap: 1rem; color: var(--ardo-text-muted); font-size: 0.9rem;">';
        echo '<span>' . htmlspecialchars($post['date']) . '</span>';
        echo '<span>•</span>';
        echo '<span>Por ' . htmlspecialchars($post['author']) . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Content
        echo '<div class="container" style="padding-top: 40px; padding-bottom: 80px;">';
        if ($thumbnail) {
            echo '<div class="glass-panel" style="padding: 0.5rem; border-radius: 1rem; margin-bottom: 3rem; box-shadow: var(--ardo-shadow-md);">';
            echo '<div style="border-radius: 0.5rem; overflow: hidden; max-height: 500px;">'; // Added max-height to prevent huge vertical images
            echo '<img src="' . htmlspecialchars($thumbnail) . '" alt="' . htmlspecialchars($post['title']) . '" style="width: 100%; height: 100%; object-fit: cover; display: block;">';
            echo '</div>';
            echo '</div>';
        }

        echo '<div class="blog-content" style="font-size: 1.25rem; line-height: 1.8; color: var(--ardo-text-main); font-weight: 400; max-width: 100%;">'; // Ensure content flows
        echo $post['content'];
        echo '</div>';
        echo '</div>';

        echo '</div>'; // End wrapper
    } else {
        echo '<div style="padding: 150px 20px; text-align: center;">';
        echo '<h1>404 Not Found</h1>';
        echo '<p>La entrada que buscas no existe.</p>';
        echo '<a href="' . $baseUrl . '" style="color: blue; text-decoration: underline;">Volver al inicio del blog</a>';
        echo '</div>';
    }

    include MAIN_INCLUDES_DIR . '/footer.php';
    return ob_get_clean();
}

// 3. Routing Logic
// -------------------------------------------------------------------------
// 3. Routing Logic
// -------------------------------------------------------------------------
// Support both PATH_INFO (standard) and 'route' query param (shared hosting fallback)
$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_GET['route']) ? $_GET['route'] : '');
$path = trim($path_info, '/');

// 4. Cache Check & Response
// -------------------------------------------------------------------------
$cache_key = 'page_' . ($path === '' ? 'home' : md5($path));
$cache_file = CACHE_DIR . '/' . $cache_key . '.html';
$cache_time = 3600;

$bypass_cache = isset($_GET['nocache']);

if (!$bypass_cache && file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_time)) {
    echo "<!-- Cached: " . date('Y-m-d H:i:s', filemtime($cache_file)) . " -->";
    readfile($cache_file);
    exit;
}

// 5. Controller Logic
// -------------------------------------------------------------------------
$response_html = '';

if ($path === '' || $path === '/' || $path === 'index.php') {
    // LIST VIEW
    $posts = get_all_posts();
    $pageTitle = "Blog ardo | Noticias y Tecnología";
    $pageDescription = "Últimas noticias sobre telefonía VoIP, Cloud PBX y tecnología empresarial.";

    $response_html = render_view('list', ['posts' => $posts]);

} else {
    // DETAIL VIEW
    $slug = $path;
    $post = get_post($slug);

    if ($post) {
        $pageTitle = isset($post['meta']['title']) ? $post['meta']['title'] : $post['title'];
        $pageDescription = isset($post['meta']['description']) ? $post['meta']['description'] : $post['excerpt'];

        $response_html = render_view('single', ['post' => $post]);
    } else {
        // 404
        header("HTTP/1.0 404 Not Found");
        $pageTitle = "404 - No encontrado";
        $response_html = render_view('404');
    }
}

// 6. Save Cache & Output
// -------------------------------------------------------------------------
if (!$bypass_cache && $response_html) {
    file_put_contents($cache_file, $response_html);
}

echo $response_html;
