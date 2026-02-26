<?php
// db_check.php
require_once 'config.php';

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

    echo "=== Database Check (PDO) ===\n";

    // Check Tables
    $tables = ['tblswitches_cdr_cache', 'tblswitches_sync_status', 'tblcustomfields', 'tblcustomfieldsvalues'];
    foreach ($tables as $table) {
        $stmt = $pdo->prepare("SHOW TABLES LIKE ?");
        $stmt->execute([$table]);
        echo "Table $table: " . ($stmt->fetch() ? "EXISTS" : "MISSING") . "\n";
    }

    // Check CDR Cache for Client 3
    $client_id = 3;
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tblswitches_cdr_cache WHERE client_id = ?");
    $stmt->execute([$client_id]);
    $res = $stmt->fetch();
    echo "CDR Cache count for Client $client_id: " . ($res ? $res['count'] : "ERROR") . "\n";

    // Check Sync Status
    $stmt = $pdo->prepare("SELECT * FROM tblswitches_sync_status WHERE client_id = ?");
    $stmt->execute([$client_id]);
    $sync = $stmt->fetch();
    if ($sync) {
        echo "Last Synced: " . $sync['last_synced_at'] . " | Total Cached: " . $sync['total_cached'] . "\n";
    } else {
        echo "Sync Status: NOT FOUND for Client $client_id\n";
    }

    // Check Switches User ID
    $stmt = $pdo->prepare("SELECT v.value FROM tblcustomfieldsvalues v JOIN tblcustomfields f ON f.id = v.fieldid WHERE f.slug = 'switches_userid' AND v.relid = ?");
    $stmt->execute([$client_id]);
    $val = $stmt->fetch();
    echo "Switches User ID for Client $client_id: " . ($val ? $val['value'] : "NOT SET") . "\n";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
echo "=== End of Check ===\n";
