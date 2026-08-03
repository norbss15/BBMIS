<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbmis;charset=utf8', 'root', '');
    $stmt = $pdo->query("DESCRIBE donors");
    $result = $stmt->fetchAll();
    echo "<pre>";
    print_r($result);
    echo "</pre>";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>