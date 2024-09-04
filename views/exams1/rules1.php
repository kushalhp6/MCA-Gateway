<?php

// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /views/login.php");
    exit;
}

// Database connection
require 'db.php'; // Adjust this path to your actual database connection script

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

// Fetch card ID for 'Module1'
$sql = "SELECT id FROM cards WHERE name = 'Module1'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($module1_card_id);
$stmt->fetch();
$stmt->close();

// Check if the user has 'Module1'
$has_module1_access = in_array($module1_card_id, $access_cards);

// Redirect if the user does not have access
if (!$has_module1_access && !$has_full_access) {
    header("Location: /views/dashboard.php");
    exit;
}

// Exam ID to file mapping
$examMapping = [
    'c_set_2' => 'c/c_set_2.json',
    'c_set_3' => 'c/c_set_3.json',
    'c_set_4' => 'c/c_set_4.json',
    'c_set_5' => 'c/c_set_5.json',
    'c_set_6' => 'c/c_set_6.json',
    'c_set_7' => 'c/c_set_7.json',
    'c_set_8' => 'c/c_set_8.json',
    'c_set_9' => 'c/c_set_9.json',
    'c_set_10' => 'c/c_set_10.json',

    // Add more mappings as needed
];

// Get the exam ID from the query string
$examId = $_GET['exam_id'] ?? '';

// Check if the exam ID exists in the mapping
if (isset($examMapping[$examId])) {
    $jsonFile = $examMapping[$examId];
    $basePath = __DIR__ . "/"; // Points to the current directory 'exams1'
    $fullPath = $basePath . $jsonFile;

    // Load the JSON file
    if (file_exists($fullPath)) {
        $jsonData = file_get_contents($fullPath);
        $examData = json_decode($jsonData, true);

        // Extract the exam details
        $examName = $examData['exam_name'] ?? 'Unknown Exam';
        $marks = $examData['total_marks'] ?? 'Unknown Marks';
    } else {
        // Handle the error if the file does not exist
        echo "Error: Exam file not found.";
        exit;
    }
} else {
    // Handle the error if the exam ID is not found in the mapping
    echo "Error: Invalid exam ID.";
    exit;
}

// Check if the exam has already been submitted
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM exam_results WHERE user_id = ? AND exam_id = ?";
$stmt = $conn->prepare($sql); // $conn should be available here

// Bind the parameters
$stmt->bind_param("is", $userId, $examId);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();
$submission = $result->fetch_assoc();

$isSubmitted = $submission !== false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($examName) ?> - Exam Details</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <!-- Exam Name -->
        <h2 class="text-3xl font-semibold mb-4 text-gray-800"><?= htmlspecialchars($examName) ?></h2>

        <!-- Exam Details -->
        <p class="mb-2 text-lg text-gray-700"><strong>Marks:</strong> <?= htmlspecialchars($marks) ?></p>

        <?php if ($isSubmitted && $submission !== null && $submission['status'] === 'submitted'): ?>
            <!-- Already Submitted Message -->
            <p class="text-lg text-green-600 font-semibold mb-4">You have already submitted this exam.</p>
            <p class="text-lg text-gray-700"><strong>Your Score:</strong> <?= htmlspecialchars($submission['marks']) ?> out of <?= htmlspecialchars($marks) ?></p>

            <!-- Buttons for View Answers and Leaderboard -->
            <div class="flex justify-between mt-4">
                <a href="/views/resources.php" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                    Back to Resources
                </a>
                <a href="view_answers1.php?exam_id=<?= urlencode($examId) ?>" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                    View Answers
                </a>
                <a href="leaderboard1.php?exam_id=<?= urlencode($examId) ?>" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">
                    Leaderboard
                </a>
            </div>
        <?php else: ?>
            <!-- Instructions -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Instructions</h3>
                <ul class="list-disc list-inside text-gray-700">
                    <li>Read each question carefully before answering.</li>
                    <li>There is no negative marking for incorrect answers.</li>
                    <li>Ensure you complete the exam / no time limit.</li>
                    <li>Do not refresh the page during the exam.</li>
                    <li>Click "Submit" once you have completed all the questions.</li>
                </ul>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-4">
                <!-- Back to Resources Button -->
                <a href="/views/resources.php" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                    Back to Resources
                </a>
                
                <!-- Start Exam Button -->
                <a href="exam1.php?exam_id=<?= urlencode($examId) ?>" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                    Start Exam
                </a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
