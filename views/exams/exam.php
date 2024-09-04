<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /views/login.php");
    exit;
}

// Database connection
require 'db.php'; // Adjust this path to your actual database connection script


// Get the exam ID from the query string
$examId = $_GET['exam_id'] ?? '';

// Base Path for the JSON files
$basePath = __DIR__ . "/json/";

// Exam ID to file mapping
$examMapping = [
    'c_set_1' => 'c_set_1.json',
    'oops_set_1' => 'oops_set_1.json',
    'unix_set_1' => 'unix_set_1.json',
    

    // Add more mappings as needed
];

// Determine the file path based on the exam ID
if ($examId && array_key_exists($examId, $examMapping)) {
    $fileName = $examMapping[$examId];
    $fullPath = $basePath . $fileName;

    // // Debugging output
    // echo "<p>Base Path: " . htmlspecialchars($basePath) . "</p>";
    // echo "<p>Full Path: " . htmlspecialchars($fullPath) . "</p>";

    // Load the JSON file
    if (file_exists($fullPath)) {
        $jsonData = file_get_contents($fullPath);
        $examData = json_decode($jsonData, true);

        // Extract the exam details
        $examName = $examData['exam_name'] ?? 'Unknown Exam';
        $marks = $examData['total_marks'] ?? 0;
        $questions = $examData['questions'] ?? [];

        // Check if the exam has already been submitted
        $userId = $_SESSION['user_id'];
        $sql = "SELECT status FROM exam_results WHERE user_id = ? AND exam_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $userId, $examId);
        $stmt->execute();
        $result = $stmt->get_result();
        $submission = $result->fetch_assoc();

        // If the status is 'submitted', redirect to the rules page
        if ($submission && $submission['status'] === 'submitted') {
            header("Location: rules.php?exam_id=" . urlencode($examId));
            exit;
        }
    } else {
        // Handle the error if the file does not exist
        echo "Error: Exam file not found.";
        exit;
    }
} else {
    // Handle the error if the exam ID is not valid
    echo "Error: Invalid exam ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($examName) ?> - Exam</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
    // Prevent back navigation
    function preventBack(){window.history.forward();}
    setTimeout("preventBack()", 0);
    window.onunload=function(){null};

    // Initialize variables
    let currentQuestionIndex = 0;

    // Show the selected question and hide others
    function showQuestion(index) {
        const questions = document.querySelectorAll('.question');
        questions.forEach((question, i) => {
            question.style.display = i === index ? 'block' : 'none';
        });
        currentQuestionIndex = index;
    }

    // Navigate to the next question
    function nextQuestion() {
        if (currentQuestionIndex < document.querySelectorAll('.question').length - 1) {
            currentQuestionIndex++;
            showQuestion(currentQuestionIndex);
        }
    }

    // Navigate to the previous question
    function prevQuestion() {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            showQuestion(currentQuestionIndex);
        }
    }

    // Initialize the first question and start the timer when the page loads
    window.onload = () => {
        showQuestion(0);
    }
</script>


</head>
<body class="bg-gray-50">

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <!-- Exam Name -->
    <h2 class="text-3xl font-semibold mb-4 text-gray-800"><?= htmlspecialchars($examName) ?></h2>

    <!-- Index Section -->
    <div class="mb-6 flex flex-wrap gap-2">
        <?php foreach ($questions as $index => $question): ?>
            <button type="button" class="index-btn bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors" onclick="showQuestion(<?= $index ?>)">
                <?= $index + 1 ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Questions Form -->
    <form id="examForm" action="submit_exam.php" method="POST">
        <?php foreach ($questions as $index => $question): ?>
            <div class="question mb-6" id="question-<?= $index ?>" style="display: none;">
            <p class="text-lg text-gray-700 mb-2"><strong>Question <?= $index + 1 ?>:</strong></p>
            <div class="text-gray-700 mb-2"><?= nl2br(htmlspecialchars_decode($question['question'])) ?></div>
                <?php foreach ($question['options'] as $key => $option): ?>
                    <label class="block text-gray-600">
                        <input type="radio" name="answers[<?= $index ?>]" value="<?= htmlspecialchars($key) ?>" class="mr-2">
                        <?= htmlspecialchars($option) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <input type="hidden" name="exam_id" value="<?= htmlspecialchars($examId) ?>">
        <div class="flex justify-between mt-4">
            <button type="button" onclick="prevQuestion()" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">Previous</button>
            <button type="button" onclick="nextQuestion()" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">Next</button>
            <button type="submit" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition-colors">Submit</button>
        </div>
    </form>
</div>



</body>
</html>
