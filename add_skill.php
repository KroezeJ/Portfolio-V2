<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $language = $_POST['language'];
    $percentage = $_POST['percentage'];

    // Insert skill into the database
    $sql = "INSERT INTO skills (language, percentage)
            VALUES (:language, :percentage)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':language', $language);
    $statement->bindParam(':percentage', $percentage);

    try {
        $statement->execute();
        header("Location: adminpanel.php");
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error adding skill: " . $e->getMessage();
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

    <section id="add-skill-section" class="section">
        <div class="container">
            <h2 class="section-title">Add Skill</h2>
            <form action="add_skill.php" method="POST">
                <div class="mb-3">
                    <label for="language" class="form-label">Language</label>
                    <input type="text" class="form-control" id="language" name="language" required>
                </div>
                <div class="mb-3">
                    <label for="percentage" class="form-label">Percentage</label>
                    <input type="number" class="form-control" id="percentage" name="percentage" min="1" max="100" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Skill</button>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $_SESSION['error'];  unset($_SESSION['error']);?>
                    </div>
                <?php } ?>
            </form>
        </div>
    </section>

    <?php include 'templates/footer.php' ?>

</body>

</html>
