<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
require_once '../php/db.php';

// Fetch user information
$user_id = $_SESSION['user_id'];
$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($user_name);
$stmt->fetch();
$stmt->close();

// including footer
// include 'partials/navbar.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MCA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-900 text-white">
        <?php
        include 'partials/navbar.php'; 
?>
    <div class="container mx-auto px-4 py-8">

    <!-- Top Buttons for Payment -->
    <div class="flex justify-between mb-8">
            <a href="path/to/monthly_payment.php" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">Pay Monthly</a>
            <a href="path/to/full_payment.php" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none">Pay Full Access</a>
        </div>
        
        <!-- Welcome Message -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
        </div>
        
        <!-- Dashboard Cards -->
        <div id="dashboard-cards" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Cards will be inserted here by JavaScript -->
        </div>
    </div>

    <script>
        // Fetch card access data
        fetch('../php/dash_back.php')
            .then(response => response.json())
            .then(data => {
                const cardContainer = document.getElementById('dashboard-cards');
                const months = ['September', 'October', 'November', 'December', 'January', 'February', 'March', 'April', 'May'];
                const fullAccessCardId = 10; // Assuming Full Access card ID is 10

                // Add month cards
                months.forEach((month, index) => {
                    const cardId = index + 1; // Card IDs start from 1 for September
                    if (data.card_access[month] || data.has_full_access) {
                        cardContainer.innerHTML += `
                            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                                <h3 class="text-xl font-semibold mb-4">${month}</h3>
                                <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">View</button>
                            </div>
                        `;
                    } else {
                        cardContainer.innerHTML += `
                            <div class="bg-gray-800 p-6 rounded-lg shadow-lg opacity-50">
                                <h3 class="text-xl font-semibold mb-4">${month}</h3>
                                <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed" disabled>Locked</button>
                            </div>
                        `;
                    }
                });

                // Add Full Access card
                if (data.has_full_access) {
                    cardContainer.innerHTML += `
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold mb-4">Full Access</h3>
                            <button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none">Unlock</button>
                        </div>
                    `;
                } else {
                    cardContainer.innerHTML += `
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg opacity-50">
                            <h3 class="text-xl font-semibold mb-4">Full Access</h3>
                            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed" disabled>Locked</button>
                        </div>
                    `;
                }
            })
            .catch(error => console.error('Error fetching card data:', error));
    </script>
</body>
</html>
