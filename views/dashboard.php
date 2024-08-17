<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// User is logged in, proceed with displaying the dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MCA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <!-- Dashboard content here -->
        <a href="../php/logout.php" class="text-red-600 hover:text-red-800">Logout</a>
    </div>
</body>
</html>
