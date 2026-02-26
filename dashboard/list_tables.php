<?php
// list_tables.php
require_once 'config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS);

    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "=== Tables in " . DB_NAME . " ===\n";
    foreach ($tables as $table) {
        if (strpos($table, 'switches') !== false || strpos($table, 'did') !== false) {
            echo "MATCH: $table\n";
        }
    }
    echo "=== Total Tables: " . count($tables) . " ===\n";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
