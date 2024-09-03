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

// Handle user deletion
if (isset($_GET['delete_user_id'])) {
    $delete_user_id = intval($_GET['delete_user_id']);
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param('i', $delete_user_id);
    $stmt->execute();
    $stmt->close();
}

// Search functionality
$search_email = isset($_GET['search_email']) ? $_GET['search_email'] : '';

$sql = "SELECT users.id, users.name, users.email, users.whatsapp, users.created_at 
        FROM users
        WHERE users.email LIKE ?";
$stmt = $conn->prepare($sql);
$search_email_param = "%" . $search_email . "%";
$stmt->bind_param('s', $search_email_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8 px-4">
    <!-- Search Form -->
    <div class="mb-6">
        <form method="GET" action="manage_users.php" class="flex items-center">
            <input 
                type="text" 
                name="search_email" 
                placeholder="Search by email..." 
                class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/3" 
                value="<?= htmlspecialchars($search_email) ?>"
            />
            <button 
                type="submit" 
                class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none"
            >
                Search
            </button>
        </form>
    </div>

    <h1 class="text-2xl font-bold mb-6 text-center">Manage Users</h1>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Name</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Email</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold uppercase">WhatsApp</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Created At</th>
                    <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['whatsapp']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['created_at']) ?></td>
                            <td class="py-3 px-4 text-sm">
                                <a href="manage_users.php?delete_user_id=<?= $row['id'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this user?');"
                                   class="text-red-600 hover:text-red-800"
                                >
                                    Delete
                                </a>
                            </td>
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
