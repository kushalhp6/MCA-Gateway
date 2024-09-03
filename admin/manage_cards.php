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

// Admin logic here

$stmt->close();

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

// Handle grant/revoke access
if (isset($_POST['action']) && isset($_POST['user_id']) && isset($_POST['card_id'])) {
    $user_id = $_POST['user_id'];
    $card_id = $_POST['card_id'];
    
    if ($_POST['action'] === 'grant') {
        // Grant access
        $sql = "INSERT INTO user_card_access (user_id, card_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $user_id, $card_id);
        $stmt->execute();
    } elseif ($_POST['action'] === 'revoke') {
        // Revoke access
        $sql = "DELETE FROM user_card_access WHERE user_id = ? AND card_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $user_id, $card_id);
        $stmt->execute();
    }
}

// Fetch all cards
$sql = "SELECT * FROM cards";
$cards_result = $conn->query($sql);

// Fetch user card access if user is found
$user_access = [];
if ($user) {
    $sql = "SELECT card_id FROM user_card_access WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $user_access[] = $row['card_id'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Manage User Cards</h1>
    
    <!-- Search Form -->
    <form method="POST" class="mb-6">
        <input type="text" name="search_email" placeholder="Enter user email" class="p-2 border border-gray-300 rounded-lg" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
    </form>
    
    <!-- User Details and Card Management -->
    <?php if ($user): ?>
        <h2 class="text-xl font-semibold mb-4">User Details</h2>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            
            <h3 class="text-lg font-semibold mt-4">Access Cards</h3>
            <table class="min-w-full bg-white mt-4 border border-gray-300">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4">Card Name</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($card = $cards_result->fetch_assoc()): ?>
                        <tr>
                            <td class="py-2 px-4"><?= htmlspecialchars($card['name']) ?></td>
                            <td class="py-2 px-4">
                                <?php if (in_array($card['id'], $user_access)): ?>
                                    <form method="POST" class="inline">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <input type="hidden" name="card_id" value="<?= $card['id'] ?>">
                                        <input type="hidden" name="action" value="revoke">
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Revoke</button>
                                    </form>
                                <?php else: ?>
                                    <form method="POST" class="inline">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <input type="hidden" name="card_id" value="<?= $card['id'] ?>">
                                        <input type="hidden" name="action" value="grant">
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Grant</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php elseif (isset($_POST['search_email'])): ?>
        <p class="text-red-500">No user found with that email address.</p>
    <?php endif; ?>
</div>

</body>
</html>
