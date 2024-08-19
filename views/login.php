<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login - MCA Gateway</title>
    <style>
        /* Custom style to ensure navbar stays at the top */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000; /* Ensure the navbar is above other content */
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>

    <!-- Login Form -->
<div class="flex items-center justify-center min-h-screen bg-gray-900 px-4">
    <div class="w-full max-w-lg bg-gray-800 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-white">Login</h1>
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'invalid_password') {
                echo '<p class="text-red-500 text-center">Incorrect password. Please try again.</p>';
            } elseif ($error == 'invalid_email') {
                echo '<p class="text-red-500 text-center">Email not found. Please try again.</p>';
            }
        }
        ?>
        <form action="../php/login_process.php" method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter your email">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-400">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-600 bg-gray-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter your password">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Login</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-400">Don't have an account? <a href="signup.php" class="text-blue-400 hover:text-blue-300">Sign up here</a>.</p>
    </div>
</div>

    
    <?php include 'partials/footer.php'; ?>
</body>
</html>
