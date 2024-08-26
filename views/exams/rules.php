<?php

// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /MCA-Gateway/views/login.php");
    exit;
}

// Exam ID to file mapping
$examMapping = [
    'c_set_1' => 'c_set_1.json',
    'c_set_2' => 'c_set_2.json',
    // Add more mappings as needed
];

// Get the exam ID from the query string
$examId = $_GET['exam_id'] ?? '';

// Check if the exam ID exists in the mapping
if (isset($examMapping[$examId])) {
    $jsonFile = $examMapping[$examId];
    $basePath = __DIR__ . "/c/"; // Adjust this path to your actual file structure
    $fullPath = $basePath . basename($jsonFile);

    // Load the JSON file
    if (file_exists($fullPath)) {
        $jsonData = file_get_contents($fullPath);
        $examData = json_decode($jsonData, true);

        // Extract the exam details
        $examName = $examData['exam_name'] ?? 'Unknown Exam';
        $marks = $examData['total_marks'] ?? 'Unknown Marks';
        $time = $examData['time_limit'] ?? 'Unknown Time';
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
        <p class="mb-4 text-lg text-gray-700"><strong>Time:</strong> <?= htmlspecialchars($time) ?> minutes</p>

        <!-- Rules/Instructions -->
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2 text-gray-800">Instructions</h3>
            <ul class="list-disc list-inside text-gray-700">
                <li>Read each question carefully before answering.</li>
                <li>There is no negative marking for incorrect answers.</li>
                <li>Ensure you complete the exam within the given time limit.</li>
                <li>Do not refresh the page during the exam.</li>
                <li>Click "Submit" once you have completed all the questions.</li>
            </ul>
        </div>

        <!-- Start Exam Button -->
        <a href="exam.php?exam_id=<?= urlencode($examId) ?>" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors">
            Start Exam
        </a>
    </div>

</body>
</html>
