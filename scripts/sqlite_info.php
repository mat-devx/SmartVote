<?php
$dbPath = __DIR__ . '/../database/database.sqlite';
echo "DB file: $dbPath\n";
if (!file_exists($dbPath)) {
    echo "Not found\n";
    exit(2);
}
echo "Size: " . filesize($dbPath) . " bytes\n\n";
try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables:\n";
    foreach ($tables as $t) {
        echo " - $t\n";
    }
    echo "\n";
    if (in_array('users', $tables)) {
        $cnt = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
        echo "users rows: $cnt\n";
        $row = $pdo->query("SELECT id,name,email,created_at FROM users LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($row, JSON_PRETTY_PRINT) . "\n";
    }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
