<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

try {
    $conn = new PDO("mysql:host=localhost;dbname=portfoliojustin", "KroezeJ", "aapies20");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM projects";
$statement = $conn->prepare($sql);
$statement->execute();
$cards = $statement->fetchAll();

$sql = "SELECT * FROM skills";
$statement = $conn->prepare($sql);
$statement->execute();
$skills = $statement->fetchAll();

$sql = "SELECT * FROM users";
$statement = $conn->prepare($sql);
$statement->execute();
$users = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Portfolio - adminpanel</title>
</head>

<body>
    <?php include 'templates/navbar.php' ?>

    <div class="container">
        <?php
        if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']);
        } ?>
        <h2>Projects <a href="add_project.php"><i class="fa-solid fa-circle-plus"></i></a></h2>
        <table class="table text-white">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Web Link</th>
                    <th>Github</th>
                    <th class="fixed-width-col">Edit</th>
                    <th class="fixed-width-col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cards as $card) { ?>
                    <tr>
                        <td>
                            <?php echo $card['title'] ?>
                        </td>
                        <td>
                            <?php
                            $description = $card['description'];
                            if (strlen($description) > 50) {
                                $description = substr($description, 0, 50) . '...';
                            }
                            echo $description;
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo $card['img_link'] ?>">
                                <?php
                                $imgLink = $card['img_link'];
                                if (strlen($imgLink) > 50) {
                                    $imgLink = substr($imgLink, 0, 50) . '...';
                                }
                                echo $imgLink;
                                ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $card['web_link'] ?>">
                                <?php
                                $webLink = $card['web_link'];
                                if (strlen($webLink) > 50) {
                                    $webLink = substr($webLink, 0, 50) . '...';
                                }
                                echo $webLink;
                                ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo $card['git_link'] ?>">
                                <?php
                                $gitLink = $card['git_link'];
                                if (strlen($gitLink) > 50) {
                                    $gitLink = substr($gitLink, 0, 50) . '...';
                                }
                                echo $gitLink;
                                ?>
                            </a>
                        </td>
                        <td><a href="edit.php?table=projects&id=<?php echo $card['id'] ?>">Edit</a></td>
                        <td><a href="actions/delete.php?table=projects&id=<?php echo $card['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Skills <a href="add_skill.php"><i class="fa-solid fa-circle-plus"></i></a></h2>
        <table class="table text-white">
            <thead>
                <tr>
                    <th>Language</th>
                    <th>Percentage</th>
                    <th class="fixed-width-col">Edit</th>
                    <th class="fixed-width-col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($skills as $skill) { ?>
                    <tr>
                        <td>
                            <?php echo $skill['language'] ?>
                        </td>
                        <td>
                            <?php echo $skill['percentage'] ?>
                        </td>
                        <td><a href="edit.php?table=skills&id=<?php echo $skill['id'] ?>">Edit</a></td>
                        <td><a href="actions/delete.php?table=skills&id=<?php echo $skill['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Admins <a href="add_admin.php"><i class="fa-solid fa-circle-plus"></i></a></h2>
        <table class="table text-white">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th class="fixed-width-col">Edit</th>
                    <th class="fixed-width-col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td>
                            <?php echo $user['username'] ?>
                        </td>
                        <td>
                            <?php echo $user['password'] ?>
                        </td>
                        <td><a href="edit.php?table=users&id=<?php echo $user['id'] ?>">Edit</a></td>
                        <td><a href="actions/delete.php?table=users&id=<?php echo $user['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php include 'templates/footer.php' ?>
</body>

</html>