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



// Exam ID to file mapping
$examMapping = [
    'set_22' => 'json/set_2022.json',
    'set_23' => 'json/set_2023.json',
    'set_24' => 'json/set_2024.json',


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
                <a href="view_answers6.php?exam_id=<?= urlencode($examId) ?>" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                    View Answers
                </a>
            </div>
        <?php else: ?>
            <!-- Instructions -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Instructions</h3>
                <ul class="list-disc list-inside text-gray-700">
                    <li>Read each question carefully before answering.</li>
                    <li>There is negative marking for incorrect answers.</li>
                    <li>In secton A(q1-q80), .25 will be deducted for each incorrect attempt.</li>
                    <li>In section B(q81-q100), one or more options might be correct, no negative marking.</li>
                    <li>Partial marks is given only for correct attempts, any incorrect click and u get zero.</li>
                    <li>Ensure you complete the exam before timer goes off.</li>
                    <li>Once The Timer Goes off, exam will be auto-submitted.</li>
                    <li>Do not refresh the page during the exam.</li>
                    <li>Do not close the tab during exam.</li>
                    <li>Do not exit tab.</li>
                    <li>Do not logout during the exam.</li>
                    <li>Click "Submit" once you have completed all the questions.</li>
                    <li class="font-bold text-red-600">Start Only when u r ready, this is a one time attempt only.</li>
                    </ul>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-4">
                <!-- Back to Resources Button -->
                <a href="/views/resources.php" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                    Back to Resources
                </a>
                
                <!-- Start Exam Button -->
                <a href="exam6.php?exam_id=<?= urlencode($examId) ?>" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">
                    Start Exam
                </a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
