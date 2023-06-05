<?php

session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$table = $_GET['table'];
$id = $_GET['id'];

if ($id == $_SESSION['user_id']) {
    $_SESSION['error'] = "You cannot delete yourself!";
    header("Location: ../adminpanel.php");
    exit();
} else {
    $sql = "DELETE FROM $table WHERE id = :id";
    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $id]);
    header("Location: ../adminpanel.php");
}


?>