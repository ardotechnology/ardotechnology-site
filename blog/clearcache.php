<?php
// blog/clearcache.php

// Security: Optional password protection or IP restriction
// Uncomment lines below to enable simple password protection
// $password = "ardo123"; 
// if (!isset($_GET['pwd']) || $_GET['pwd'] !== $password) {
//     die("Acceso denegado.");
// }

define('BLOG_ROOT', __DIR__);
define('CACHE_DIR', BLOG_ROOT . '/cache');

if (!is_dir(CACHE_DIR)) {
    echo "El directorio de caché no existe.";
    exit;
}

$files = glob(CACHE_DIR . '/*');
$count = 0;

foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file);
        $count++;
    }
}

echo "<h1>Caché Limpiada</h1>";
echo "<p>Se han eliminado <strong>$count</strong> archivos de caché.</p>";
echo "<a href='index.php'>Volver al Blog</a>";
?>