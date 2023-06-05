<?php
session_start();

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$table = $_GET['table'];
$id = $_GET['id'];

if ($id == "" || $table == "") {
    header("Location: adminpanel.php");
    exit();
}

switch ($table) {
    case 'projects':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $img_link = $_POST['img_link'];
            $git_link = $_POST['git_link'];
            $web_link = $_POST['web_link'];

            $sql = "UPDATE projects SET title = :title, description = :description, img_link = :img_link, git_link = :git_link, web_link = :web_link WHERE id = :id";
            $statement = $conn->prepare($sql);
            $statement->execute([':title' => $title, ':description' => $description, ':img_link' => $img_link, ':git_link' => $git_link, ':web_link' => $web_link, ':id' => $id]);
            header("Location: adminpanel.php");
        }
        $sql = "SELECT * FROM projects WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->execute([':id' => $id]);
        $project = $statement->fetch();
        break;
    case 'skills':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $language = $_POST['language'];
            $percentage = $_POST['percentage'];

            $sql = "UPDATE skills SET language = :language, percentage = :percentage WHERE id = :id";
            $statement = $conn->prepare($sql);
            $statement->execute([':language' => $language, ':percentage' => $percentage, ':id' => $id]);
            header("Location: adminpanel.php");
        }
        $sql = "SELECT * FROM skills WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->execute([':id' => $id]);
        $skill = $statement->fetch();
        break;
    case 'users':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "UPDATE skills SET username = :username, password = :password WHERE id = :id";
            $statement = $conn->prepare($sql);
            $statement->execute([':username' => $username, ':password' => $password, ':id' => $id]);
            header("Location: adminpanel.php");
        }
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->execute([':id' => $id]);
        $user = $statement->fetch();
        break;
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

    <div class="container">
    <form action="edit.php?table=<?php echo $table ?>&id=<?php echo $id ?>" method="POST">
        <?php
        switch ($table) {
            case 'projects':
                ?>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $project['title'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo $project['description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="img_link" class="form-label">Image Link</label>
                    <input type="text" class="form-control" id="img_link" name="img_link" value="<?php echo $project['img_link'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="git_link" class="form-label">GitHub Link</label>
                    <input type="text" class="form-control" id="git_link" name="git_link" value="<?php echo $project['git_link'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="web_link" class="form-label">Web Link</label>
                    <input type="text" class="form-control" id="web_link" name="web_link" value="<?php echo $project['web_link'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Add Project</button>
                <?php
                break;

            case 'skills':
                ?>
                <div class="mb-3">
                    <label for="language" class="form-label">Language</label>
                    <input type="text" class="form-control" id="language" name="language" value="<?php echo $skill['language'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="percentage" class="form-label">Percentage</label>
                    <input type="number" class="form-control" id="percentage" name="percentage" min="1" max="100" value="<?php echo $skill['percentage'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Skill</button>
                <?php
                break;

            case 'users':
                ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Admin</button>
                <?php
                break;
        }
        ?>

        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php } ?>
    </form>
    </div>


    <?php include 'templates/footer.php' ?>
</body>

</html>