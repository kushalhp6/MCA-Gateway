<?php
session_start(); // Start the session

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

include 'views/partials/navbar.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - MCA Gateway</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to MCA Gateway</h1>
        <?php if ($loggedIn): ?>
            <p>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
            <a href="/MCA-Gateway/views/dashboard.php">Go to your Dashboard</a>
        <?php else: ?>
            <p>Welcome to our platform. <a href="/MCA-Gateway/views/signup.php">Sign up</a> or <a href="/MCA-Gateway/views/login.php">log in</a> to get started.</p>
        <?php endif; ?>
    </div>
    <?php include 'views/partials/footer.php'; ?>
</body>
</html>
