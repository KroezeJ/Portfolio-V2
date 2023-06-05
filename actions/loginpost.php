<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":username", $username);
$stmt->execute();
$user = $stmt->fetch();

if ($user && $password == $user['password']) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: ../adminpanel.php");
} else {
    $_SESSION['error'] = "Username or password is incorrect";
    header("Location: ../login.php");
}
}
?>
