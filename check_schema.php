<?php
$pdo = new PDO('mysql:host=localhost;dbname=bbmis', 'root', '');
$stmt = $pdo->query('SHOW COLUMNS FROM blood_inventory');
$cols = $stmt->fetchAll(PDO::FETCH_COLUMN);
echo implode(', ', $cols) . PHP_EOL;

echo PHP_EOL . 'inventory_log:' . PHP_EOL;
$stmt2 = $pdo->query('SHOW COLUMNS FROM inventory_log');
$cols2 = $stmt2->fetchAll(PDO::FETCH_COLUMN);
echo implode(', ', $cols2) . PHP_EOL;
?>