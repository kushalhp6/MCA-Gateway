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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - MCA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <?php include 'partials/navbar.php'; 
?>
<?php include 'modules/module1.php'; 
include 'modules/module2.php';
include 'modules/module3.php';
include 'modules/module4.php';
include 'modules/mock.php';
?>
    
</body>
</html>
