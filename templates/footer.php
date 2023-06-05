<footer class="footer bg-black">
    <div class="container">
        <p class="footer-text">&copy;
            <?php echo date("Y"); ?> Justin Kroeze. All rights reserved. 
            <?php if (isset($_SESSION['user_id'])) { ?>
                <a href="../actions/logout.php">Logout</a>
            <?php } else { ?>
            <a href="login.php">Admin Login</a> 
            <?php } ?>
        </p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>