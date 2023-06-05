<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>