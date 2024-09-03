<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /views/login.php");
    exit;
}

// Include database connection
require_once '../php/db.php';

// Fetch user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($user_email);
$stmt->fetch();
$stmt->close();

// Check if the user is an admin
$sql = "SELECT * FROM admin WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // If the user is not an admin, redirect to the home page or show an error
    header("Location: /index.php");
    exit;
}

// Admin logic here

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Welcome Admin</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="view_users.php" class="block bg-blue-500 text-white text-center py-3 rounded-lg hover:bg-blue-600">View Users</a>
            <a href="manage_cards.php" class="block bg-green-500 text-white text-center py-3 rounded-lg hover:bg-green-600">Manage Cards</a>
            <a href="manage_users.php" class="block bg-yellow-500 text-white text-center py-3 rounded-lg hover:bg-yellow-600">Manage Users</a>
            <a href="manage_admins.php" class="block bg-red-500 text-white text-center py-3 rounded-lg hover:bg-red-600">Manage Admins</a>
        </div>
    </div>
</div>

</body>
</html>
