<?php
header('Content-Type: text/plain');
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbmis;charset=utf8', 'root', '');
    $stmt = $pdo->query("DESCRIBE alerts");
    $result = $stmt->fetchAll();
    print_r($result);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>