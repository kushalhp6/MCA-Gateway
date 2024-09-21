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
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - MCA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white ">
<?php include 'partials/navbar.php'; ?>

<!-- Module 1 -->
<?php include 'modules/module1.php'; ?>

<!-- Module 2 -->
<?php include 'modules/module2.php'; ?>

<!-- Module 3 -->
<?php include 'modules/module3.php'; ?>

<!-- Module 4 -->
<?php include 'modules/module4.php'; ?>

<!-- Mock Section -->
<?php include 'modules/mock.php'; ?>

<?php include 'partials/footer.php'; ?>
</body>
</html>
