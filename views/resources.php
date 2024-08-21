<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
require_once '../php/db.php';

// Fetch user ID
$user_id = $_SESSION['user_id'];

// Fetch user card access (similar to dash_back.php)
$sql = "SELECT card_id FROM user_card_access WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$access_cards = [];
while ($row = $result->fetch_assoc()) {
    $access_cards[] = $row['card_id'];
}
$stmt->close();

// Determine access
$has_full_access = in_array(11, $access_cards); // Assuming Full Access card ID is 10
$card_access = [];
$months = ['September', 'October', 'November', 'December', 'January', 'February', 'March', 'April', 'May', 'June'];
foreach ($months as $index => $month) {
    $card_id = $index + 1; // Card IDs start from 1 for September
    $card_access[$month] = in_array($card_id, $access_cards);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - MCA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-8">
        <!-- Module 1 Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Module 1</h2>

            <!-- Free Section -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Free Section</h3>
                <ul>
                    <li class="mb-2">
                        <span>Free PDF 1</span>
                        <a href="path_to_pdf1.pdf" class="ml-4 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Download</a>
                    </li>
                    <li>
                        <span>Free PDF 2</span>
                        <a href="path_to_pdf2.pdf" class="ml-4 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Download</a>
                    </li>
                </ul>
            </div>

            <!-- Premium Section -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Premium Section</h3>

                <?php if ($card_access['September'] || $has_full_access): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock1</h4>
                            <a href="path_to_mock1.pdf" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock2</h4>
                            <a href="path_to_mock2.pdf" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock3</h4>
                            <a href="path_to_mock3.pdf" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock4</h4>
                            <a href="path_to_mock4.pdf" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="bg-red-600 p-6 rounded-lg shadow-lg">
                        <p class="mb-4">Unlock the premium section by purchasing the September card.</p>
                        <a href="dashboard.php" class="bg-yellow-400 text-black py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none transition-colors">Unlock Premium Section</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
