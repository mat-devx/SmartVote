<?php
// Simple standalone script to verify the seeded user exists in the sqlite DB
// Run: php scripts/check_user.php

$dbPath = __DIR__ . '/../database/database.sqlite';
if (!file_exists($dbPath)) {
    echo "ERROR: database file not found: $dbPath\n";
    exit(2);
}

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $stmt = $pdo->prepare('SELECT id, name, email, password, created_at FROM users WHERE email = ? LIMIT 1');
    $stmt->execute(['admin@example.com']);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row ?: new stdClass(), JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
