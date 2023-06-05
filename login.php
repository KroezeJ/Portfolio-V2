<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <link rel="stylesheet" href="css/login.css">
    <title>Portfolio</title>
</head>

<body>
    <?php include 'templates/navbar.php' ?>

    <section class="login">
        <div class="container">
            <h2 class="section-title">Login</h2>
            <form class="login-form" method="post" action="actions/loginpost.php">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </section>


    <?php include 'templates/footer.php' ?>
</body>

</html>