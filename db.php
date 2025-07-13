<?php
$host = 'localhost';
$db   = 'bankja214_digital_bank';
$user = 'bankja214_contohuser';
$pass = 'oi?GISOMEq=K';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

function generateRandomString($length = 4) {
    return sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length)-1));
}
?>
