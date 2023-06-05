<?php
session_start();

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Portfolio</title>
</head>

<body>
    <?php include 'templates/navbar.php' ?>

    <section id="info-section" class="section align-left">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="section-title">Introduction</h2>
                    <p class="section-text">Hi! I'm Justin Kroeze, a software developer with a passion for creating
                        innovative websites and utilizing PHP. I love the process of turning ideas into reality and
                        crafting seamless user experiences.</p>
                    <p class="section-text">In addition to my programming pursuits, I enjoy indulging in the world of
                        gaming, exploring virtual landscapes and unraveling complex game mechanics. I also have a knack
                        for football, where I embrace teamwork, strategy, and friendly competition. And when I'm looking
                        for a different kind of challenge, you'll often find me at the bowling alley, honing my
                        precision and technique.</p>
                    <p class="section-text">As a dedicated developer, I continually seek opportunities to expand my
                        knowledge and collaborate with like-minded individuals. I thrive on solving problems, embracing
                        new technologies, and delivering high-quality solutions that exceed expectations.</p>
                </div>
                <div class="col-md-6">
                    <img src="https://www.zdnet.com/a/img/resize/3d25b9c29ef51104aa28d7e31f4d44c8c871804c/2022/09/21/c8347dc2-f35d-4af1-921d-5a7e1b408f5c/zd-2023-premium-learn-to-code.jpg?auto=webp&width=1280"
                        alt="Profile Image" class="img-fluid">
                </div>
            </div>

        </div>
    </section>

    <section id="projects-section" class="section bg-light align-right">
        <div class="container">
            <h2 class="section-title">Projects</h2>
            <p class="project-info text-end">Here you can find some of the projects I've been working on during my
                carreer as a software developer, some of them are from when I just got started, so the quality might not
                always be amazing. But it's those projects that indicate how I have evolved my web-development skills.
            </p>
            <?php $i = 2;
            foreach ($cards as $card) { ?>
                <?php if ($i == 2) {
                    $i = 0; ?>
                    <div class="row">
                        <?php
                } else {
                    $i++;
                }
                ?>
                    <div class="col-md-6">
                        <div class="card">
                            <img src="<?php echo $card["img_link"] ?>" class="card-img-top" alt="Project Image">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $card['title'] ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $card["description"] ?>
                                </p>
                                <a href="<?php echo $card['git_link'] ?>" class="btn btn-primary" target="_blank"><i
                                        class="fa-brands fa-github"></i></a>
                                <a href="<?php echo $card['web_link'] ?>" class="btn btn-primary" target="_blank"><i
                                        class="fa-solid fa-arrow-up-right-from-square"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php if ($i == 1) { ?>
                    </div>
                <?php }
            } ?>
        </div>
    </section>


    <section id="skills-section" class="section align-left">
        <div class="container">
            <h2 class="section-title">Skills</h2>
            <p>Here you can find a more or less accurate representation of my skills, ofcourse the percentages may vary,
                since I dont exactly know how much knowledge of each language I have.</p>
            <div class="skill-bars">
                <?php
                foreach ($skills as $skill) { ?>
                    <div class="skill">
                        <div class="skill-name">
                            <?php echo $skill['language'] ?>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" style="width:<?php echo $skill['percentage'] ?>%"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>


    <section id="contact-section" class="section bg-light align-right">
        <div class="container">
            <h2 class="section-title">Contact (Coming Soon)</h2>
            <div class="row">
                <div class="col-md-6 align-left">
                    <a href="https://www.linkedin.com/in/justin-kroeze-304386266/" target="_blank"><i
                            class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/kroezej/?theme=dark" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/KroezeJustin" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://github.com/KroezeJ" target="_blank"><i class="fab fa-github"></i></a>
                    <p class="contact-details">
                        Address: <a href="https://maps.google.com/?q=Wulk+8,Middenmeer" target="_blank">Wulk 8,
                            Middenmeer</a><br>
                        Phone: <a href="tel:+31637358543">+31 6 373 585 43</a><br>
                        Email: <a href="mailto:jkroeze1610@gmail.com">jkroeze1610@gmail.com</a>
                    </p>

                </div>
                <div class="col-md-6">
                    <form id="contact-form" method="post" action="send-email.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required
                                disabled></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" disabled>Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'templates/footer.php' ?>
</body>

</html>