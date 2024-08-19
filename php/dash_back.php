<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include database connection
require_once 'db.php';

// Fetch user ID
$user_id = $_SESSION['user_id'];

// Fetch user card access
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

// Fetch all cards and check access
$months = ['September', 'October', 'November', 'December', 'January', 'February', 'March', 'April', 'May'];
$card_access = [];
foreach ($months as $index => $month) {
    $card_id = $index + 1; // Assuming card IDs start from 1 for September
    $card_access[$month] = in_array($card_id, $access_cards);
}

// Add logic for Full Access card if needed
$full_access_card_id = 10; // Assuming Full Access card ID is 10
$has_full_access = in_array($full_access_card_id, $access_cards);

$response = [
    'card_access' => $card_access,
    'has_full_access' => $has_full_access
];

echo json_encode($response);
?>
