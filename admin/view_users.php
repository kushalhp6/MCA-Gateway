<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
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
    header("Location: ../index.php");
    exit;
}

// Admin logic here

$stmt->close();

// Fetch user information from the database
$sql = "SELECT u.id, u.name, u.email, u.whatsapp, u.created_at, GROUP_CONCAT(c.name ORDER BY c.id SEPARATOR ', ') AS access_cards 
        FROM users u
        LEFT JOIN user_card_access ua ON u.id = ua.user_id
        LEFT JOIN cards c ON ua.card_id = c.id
        GROUP BY u.id, u.name, u.email, u.whatsapp, u.created_at";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 text-center">User List</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Name</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Email</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">WhatsApp</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Access Cards</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Created At</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['name']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['email']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['whatsapp']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['access_cards']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['created_at']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-3 px-4">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
