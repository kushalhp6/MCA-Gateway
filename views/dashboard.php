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
$sql = "SELECT name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($user_name);
$stmt->fetch();
$stmt->close();

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
    <title>Dashboard - MCA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <?php include 'partials/navbar.php'; ?>

    <div class="container mx-auto px-4 py-8">

        <!-- Conditional Welcome and Cost Information -->
        <?php if (!$has_full_access): ?>
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
                <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white py-4 px-6 rounded-lg shadow-lg font-semibold text-lg">
                    <p class="mb-2 text-2xl">Total Prep Costs: <span class="font-bold">₹6000</span></p>
                    <p class="text-lg">Buy at Once and Save <span class="bg-yellow-300 text-black px-2 py-1 rounded-lg font-bold">₹1000</span>!</p>
                </div>
            </div>
        <?php endif; ?>

        
        <!-- Top Buttons for Payment
        <div class="flex justify-between mb-8">
            <a href="path/to/monthly_payment.php" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none">Pay Monthly</a>
            <a href="path/to/full_payment.php" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none">Pay Full Access</a>
        </div> -->

        

        <!-- Dashboard Cards -->
<div id="dashboard-cards" class="grid grid-cols-1 md:grid-cols-3 gap-6">

<!-- Full Access Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $has_full_access ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">Full Access</h3>
    <ul class="list-disc list-inside mb-4">
        <li>All Module Notes</li>
        <li>All Records</li>
        <li>All Module-wise Tests</li>
        <li>All Full Syllabus Tests</li>
        <li>All Live Classes</li>
    </ul>
    <?php if ($has_full_access): ?>
        <a href="resources.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <div class="flex gap-4">
        <a href="pay.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">Pay 5000</button></a>
            <button class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 focus:outline-none transition-colors">1000 Discount</button>
        </div>
    <?php endif; ?>
</div>

<!-- September Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['September'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">September</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['September'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a> 
    <?php endif; ?>
</div>

<!-- October Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['October'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">October</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['October'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['September'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>


<!-- November Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['November'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">November</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['November'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['October'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- December Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['December'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">December</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['December'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['November'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- January Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['January'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">January</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['January'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['December'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- February Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['February'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">February</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['February'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['January'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- March Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['March'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">March</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['March'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['February'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- April Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['April'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">April</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['April'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['March'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- May Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['May'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">May</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['May'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a> 
    <?php else: ?>
        <?php if ($card_access['May'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Access the Full Mock tests only Card -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['June'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">Full Syllabus Tests</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>Class Records</li>
        <li>Module-wise Online Tests in C</li>
        <li>Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['June'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">Try Mock Tests</button></a> 
    <?php else: ?>
        <?php if ($card_access['May'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Pay 667</button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

</div>

    </div>
</body>
</html>
