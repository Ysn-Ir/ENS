<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ens";
$port = 3306;

try {
    $connection = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
