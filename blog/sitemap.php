<?php
// /blog/sitemap.php
header("Content-Type: application/xml; charset=utf-8");

define('BLOG_ROOT', __DIR__);
define('DATA_DIR', BLOG_ROOT . '/data/posts');
$baseUrl = 'https://ardo.technology/ardotechnology/blog/'; // Update this to real domain in production if needed

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo $baseUrl; ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <?php
    $files = glob(DATA_DIR . '/*.json');
    foreach ($files as $file) {
        $json = json_decode(file_get_contents($file), true);
        if ($json) {
            $slug = $json['slug'];
            $date = $json['date'];
            echo "    <url>\n";
            echo "        <loc>" . $baseUrl . $slug . "</loc>\n";
            echo "        <lastmod>" . $date . "</lastmod>\n";
            echo "        <changefreq>monthly</changefreq>\n";
            echo "        <priority>0.5</priority>\n";
            echo "    </url>\n";
        }
    }
    ?>
</urlset>