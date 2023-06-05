<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert user into the database
    $sql = "INSERT INTO users (username, password)
            VALUES (:username, :password)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);

    try {
        $statement->execute();
        header("Location: adminpanel.php");
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error adding user: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Portfolio</title>
</head>

<body>
    <?php include 'templates/navbar.php' ?>

    <section id="add-user-section" class="section">
        <div class="container">
            <h2 class="section-title">Add Admin</h2>
            <form action="add_admin.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Admin</button>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']);?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </section>

    <?php include 'templates/footer.php' ?>

</body>

</html>