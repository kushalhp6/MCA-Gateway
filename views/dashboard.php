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

// Fetch user card access
$sql = "SELECT card_id FROM user_card_access WHERE user_id = ?";
$stmt = $conn->prepare($sql);

// Check if the prepare was successful
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('i', $user_id);
$execute_result = $stmt->execute();

// Check if the execute was successful
if ($execute_result === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$result = $stmt->get_result();

// Check if the get_result was successful
if ($result === false) {
    die('Get result failed: ' . htmlspecialchars($stmt->error));
}

$access_cards = [];
while ($row = $result->fetch_assoc()) {
    $access_cards[] = $row['card_id'];
}

$stmt->close();


// Fetch card ID for 'Full Access'
$sql = "SELECT id FROM cards WHERE name = 'Full Access'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($full_access_card_id);
$stmt->fetch();
$stmt->close();

// Check if the user has 'Full Access'
$has_full_access = in_array($full_access_card_id, $access_cards);


$card_access = [];
$card_names = ['Module1', 'Module2', 'Module3', 'Module4', 'Mock'];

foreach ($card_names as $card_name) {
    // Get the card_id based on the card name
    $sql = "SELECT id FROM cards WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $card_name);
    $stmt->execute();
    $stmt->bind_result($card_id);
    $stmt->fetch();
    $stmt->close();

    $card_access[$card_name] = in_array($card_id, $access_cards);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="MCA Gateway offers over 100+ mock tests for JECA aspirants to help them prepare and crack the MCA entrance exam and get into colleges like Jadavpur University. Start preparing now!">
    <meta name="keywords" content="Jeca, mocktests, jeca mocktests, jeca crackers, jeca toppers, Jadavpur University, MCA in Kolkata, MCA entrance, MCA exam, JECA preparation">
    <meta name="author" content="mcagateway.in">
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="mcagateway.in - JECA Mock Tests for Aspirants">
    <meta property="og:description" content="Take over 100+ mock tests for JECA and crack the MCA entrance exam with mcagateway.in. Perfect platform for JECA aspirants aiming for MCA programs in Kolkata.">
    <meta property="og:image" content="/assets/images/image.svg">
    <meta property="og:url" content="https://mcagateway.in">
    <meta property="og:type" content="website">
    
    <title>Dashboard - MCA Gateway</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <?php include 'partials/navbar.php'; ?>

    <div class="container mx-auto px-4 py-8">
    <div class="text-center mb-8">
                <h1 class="text-3xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h1>
            </div>

        <!-- Conditional Welcome and Cost Information -->
        <?php if (!$has_full_access): ?>
            <div class="text-center mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-teal-500 text-white py-4 px-6 rounded-lg shadow-lg font-semibold text-lg">
                    <p class="mb-2 text-2xl">Total Prep Costs: <span class="line-through mr-2">₹2999</span> <span class="text-green-300">₹999</span></p>
                    <p class="text-lg">Buy at Once and Save <span class="bg-yellow-300 text-black px-2 py-1 rounded-lg font-bold">₹2000</span>!</p>
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
        <li>All Module-wise Tests</li>
        <li>All Full Syllabus Tests</li>
        <li>All Live Classes</li>
        <li>All Doubt Clearing sessions</li>
        <li>All Records</li>

    </ul>
    <?php if ($has_full_access): ?>
        <a href="resources.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <div class="flex gap-4 items-center">
            <a href="pay.php">
                <button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">
                    <span class="line-through mr-2">₹2999</span> <span class="text-green-300 line-through">₹999</span>
                </button>
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Mock -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['Mock'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">Full Syllabus Tests</h3>
    <ul class="list-disc list-inside mb-4">
        <li>All Module Notes</li>
        <li>All Module-wise Tests</li>
        <li>All Full Syllabus Tests</li>
    </ul>
    <?php if ($card_access['Mock'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">Try Mock Tests</button></a> 
    <?php else: ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors"><span class="line-through">Pay 999</span></button></a>
    <?php endif; ?>
</div>


<!-- Module1 -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['Module1'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">Module1</h3>
    <ul class="list-disc list-inside mb-4">
        <li>C Programming Live Classes</li>
        <li>OOPs Live Classes</li>
        <li>Unix Live Classes</li>
        <li>All Class Records</li>
        <li>C, OOPs and unix tests</li>
        <li>C, OOPs and unix Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['Module1'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors"><span class="line-through">Pay 2000</span></button></a> 
    <?php endif; ?>
</div>

<!-- Module2 -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['Module2'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">Module2</h3>
    <ul class="list-disc list-inside mb-4">
        <li>DSA Live Classes</li>
        <li>Architecture Live Classes</li>
        <li>OS Live Classes</li>
        <li>All Class Records</li>
        <li>DSA, Architecture and OS tests</li>
        <li>DSA, Architecture and OS Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['Module2'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['Module1'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors"><span class="line-through">Pay 2000</span></button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>


<!-- Module3 -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['Module3'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">Module3</h3>
    <ul class="list-disc list-inside mb-4">
        <li>Networking  Live Classes</li>
        <li>DBMS Live Classes</li>
        <li>All Class Records</li>
        <li>Networking and DBMS tests</li>
        <li>Networking and DBMS Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['Module3'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['Module2'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors"><span class="line-through">Pay 2000</span></button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- Module4 -->
<div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 <?php echo $card_access['Module4'] ? '' : 'opacity-50'; ?>">
    <h3 class="text-xl font-semibold mb-4">Module4</h3>
    <ul class="list-disc list-inside mb-4">
        <li>Software Engineering Live Classes</li>
        <li>Machine Learning Live Classes</li>
        <li>All Class Records</li>
        <li>Software Engineering and Machine Learning tests</li>
        <li>Software Engineering and Machine Learning Syllabus-wise Notes</li>
    </ul>
    <?php if ($card_access['Module4'] || $has_full_access): ?>
        <a href="resources.php"><button class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</button></a>
    <?php else: ?>
        <?php if ($card_access['Module3'] || $has_full_access): ?>
            <a href="pay.php"><button class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors"><span class="line-through">Pay 2000</span></button></a>
        <?php else: ?>
            <button class="bg-gray-600 text-white py-2 px-4 rounded-md cursor-not-allowed transition-colors" disabled>Locked</button>
        <?php endif; ?>
    <?php endif; ?>
</div>



</div>

    </div>
</body>
</html>
