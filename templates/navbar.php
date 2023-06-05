<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container">
        <a class="navbar-brand" href="index.php">Justin Kroeze</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="adminpanel.php">Admin Panel</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#info-section">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#projects-section">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#skills-section">Skills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#contact-section">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>