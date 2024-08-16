<nav>
    <a href="/MCA-Gateway/index.php">Home</a>
    <a href="/MCA-Gateway/views/about.php">About</a>
    <a href="/MCA-Gateway/views/contact.php">Contact</a>
    <a href="/MCA-Gateway/views/info.php">Info</a>
    
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <a href="/MCA-Gateway/views/dashboard.php">Dashboard</a>
        <a href="/MCA-Gateway/views/resources.php">Resources</a>
        <a href="/MCA-Gateway/php/logout.php">Logout</a>
    <?php else: ?>
        <a href="/MCA-Gateway/views/login.php">Login</a>
        <a href="/MCA-Gateway/views/signup.php">Signup</a>
    <?php endif; ?>
</nav>
