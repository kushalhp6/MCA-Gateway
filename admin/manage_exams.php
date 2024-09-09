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
$search_email = '';
$results = [];
if (isset($_POST['search'])) {
    $search_email = $_POST['email'];

    // Fetch user exams by email
    $sql = "SELECT er.*, u.email 
            FROM exam_results er
            JOIN users u ON er.user_id = u.id
            WHERE u.email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $search_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }
    $stmt->close();
}

// Handle delete request
if (isset($_POST['delete'])) {
    $exam_result_id = $_POST['id'];

    // Delete the selected exam result
    $sql = "DELETE FROM exam_results WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $exam_result_id);
    $stmt->execute();
    $stmt->close();

    // Redirect after delete to avoid form resubmission
    header("Location: manage_exams.php?email=" . urlencode($search_email));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Exams</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6 text-center">Manage Exams</h1>

        <!-- Search Form -->
        <form method="POST" class="mb-4">
            <div class="flex justify-center">
                <input type="email" name="email" class="border border-gray-300 p-2 rounded-lg" placeholder="Enter user's email" value="<?= htmlspecialchars($search_email) ?>" required>
                <button type="submit" name="search" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
            </div>
        </form>

        <!-- Exam Results Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Exam ID</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Marks</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Correct</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Incorrect</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Unattempted</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Submission Time</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    <?php if (!empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['exam_id']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['marks']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['correct']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['incorrect']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['unattempted']) ?></td>
                                <td class="py-3 px-4 text-sm"><?= htmlspecialchars($row['submission_time']) ?></td>
                                <td class="py-3 px-4 text-sm">
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this exam result?');">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <button type="submit" name="delete" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-3 px-4">No exam results found for this user.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
