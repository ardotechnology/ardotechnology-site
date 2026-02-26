<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $dir = realpath(__DIR__ . '/../landing');
    echo "Target Dir: " . ($dir ? $dir : 'FALSE') . "\n";

    if (!$dir || !is_dir($dir)) {
        die("Directory not found!\n");
    }

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $count = 0;
    foreach ($iterator as $file) {
        $count++;
        if ($file->isDir())
            continue;
        if ($file->getBasename() === 'index.php') {
            $content = file_get_contents($file->getPathname());
            if (strpos($content, 'v=2') !== false) {
                echo "Found v=2 in " . $file->getPathname() . "\n";
                $newContent = str_replace('v=2', 'v=3', $content);
                file_put_contents($file->getPathname(), $newContent);
            }
        }
    }
    echo "Done. Scanned $count items.\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
