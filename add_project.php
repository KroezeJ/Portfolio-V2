<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imgLink = $_POST['img_link'];
    $gitLink = $_POST['git_link'];
    $webLink = $_POST['web_link'];
    if (empty($webLink)) {
        $webLink = null;
    }

    // Insert project into the database
    $sql = "INSERT INTO projects (title, description, img_link, git_link, web_link)
            VALUES (:title, :description, :imgLink, :gitLink, :webLink)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':imgLink', $imgLink);
    $statement->bindParam(':gitLink', $gitLink);
    $statement->bindParam(':webLink', $webLink);

    try {
        $statement->execute();
        header("Location: adminpanel.php");
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error adding project: " . $e->getMessage();
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

    <section id="add-project-section" class="section">
        <div class="container">
            <h2 class="section-title">Add Project</h2>
            <form action="add_project.php" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="img_link" class="form-label">Image Link</label>
                    <input type="text" class="form-control" id="img_link" name="img_link" required>
                </div>
                <div class="mb-3">
                    <label for="git_link" class="form-label">GitHub Link</label>
                    <input type="text" class="form-control" id="git_link" name="git_link" required>
                </div>
                <div class="mb-3">
                    <label for="web_link" class="form-label">Web Link</label>
                    <input type="text" class="form-control" id="web_link" name="web_link">
                </div>
                <button type="submit" class="btn btn-primary">Add Project</button>
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