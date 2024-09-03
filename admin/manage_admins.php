<?php
session_start();

// Check if the user is logged in and is an admin
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

// Handle search request
$user = null;
if (isset($_POST['search_email'])) {
    $search_email = $_POST['search_email'];
    
    // Search for user by email
    $sql = "SELECT id, name, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $search_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

// Handle create/remove admin action
if (isset($_POST['action']) && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    if ($_POST['action'] === 'create') {
        // Add user to admin
        $sql = "INSERT IGNORE INTO admin (email) SELECT email FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        if ($stmt->execute()) {
            echo "<p class='text-green-500'>Admin created successfully.</p>";
        } else {
            echo "<p class='text-red-500'>Error creating admin: " . $stmt->error . "</p>";
        }
    } elseif ($_POST['action'] === 'remove') {
        // Remove user from admin
        $sql = "DELETE FROM admin WHERE email = (SELECT email FROM users WHERE id = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        if ($stmt->execute()) {
            echo "<p class='text-red-500'>Admin removed successfully.</p>";
        } else {
            echo "<p class='text-red-500'>Error removing admin: " . $stmt->error . "</p>";
        }
    }
}

// Check if the user is already an admin
$is_admin = false;
if ($user) {
    $sql = "SELECT * FROM admin WHERE email = (SELECT email FROM users WHERE id = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $is_admin = $result->num_rows > 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admins</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Manage Admins</h1>
    
    <!-- Search Form -->
    <form method="POST" class="mb-6">
        <input type="text" name="search_email" placeholder="Enter user email" class="p-2 border border-gray-300 rounded-lg" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
    </form>
    
    <!-- User Details and Admin Management -->
    <?php if ($user): ?>
        <h2 class="text-xl font-semibold mb-4">User Details</h2>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            
            <h3 class="text-lg font-semibold mt-4">Admin Management</h3>
            <div class="mt-4">
                <?php if ($is_admin): ?>
                    <form method="POST" class="inline">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="action" value="remove">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Remove Admin</button>
                    </form>
                <?php else: ?>
                    <form method="POST" class="inline">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="action" value="create">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Create Admin</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php elseif (isset($_POST['search_email'])): ?>
        <p class="text-red-500">No user found with that email address.</p>
    <?php endif; ?>
</div>

</body>
</html>
