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


// Get the exam ID from the query string
$examId = $_GET['exam_id'] ?? '';

// Base Path for the JSON files
$basePath = __DIR__ . "/"; // Points to the current directory 'exams1'

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
        $timeLimit = $examData['time_limit'] ?? 0;
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
            header("Location: rules1.php?exam_id=" . urlencode($examId));
            exit;
        }

        // If session time is not set, start the timer
        if (!isset($_SESSION['start_time'])) {
            $_SESSION['start_time'] = time();
            $_SESSION['time_limit'] = $timeLimit * 60; // Convert minutes to seconds
        }

        // Calculate remaining time
        $elapsedTime = time() - $_SESSION['start_time'];
        $remainingTime = $_SESSION['time_limit'] - $elapsedTime;

        if ($remainingTime <= 0) {
            // Time's up - end the exam
            header("Location: submit_exam1.php?exam_id=" . urlencode($examId));
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
    let remainingTime = <?= $remainingTime ?>;
    let currentQuestionIndex = 0;

    // Start the exam timer
    function startTimer() {
        const timerElement = document.getElementById('timer');
        const timer = setInterval(() => {
            if (remainingTime <= 0) {
                clearInterval(timer);
                alert("Time's up!");
                document.getElementById('examForm').submit();
            } else {
                remainingTime--;
                let minutes = Math.floor(remainingTime / 60);
                let seconds = remainingTime % 60;
                timerElement.textContent = `${minutes}m ${seconds}s`;
            }
        }, 1000);
    }

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
        startTimer();
        showQuestion(0);
    }
</script>


</head>
<body class="bg-gray-50">

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <!-- Exam Name -->
    <h2 class="text-3xl font-semibold mb-4 text-gray-800"><?= htmlspecialchars($examName) ?></h2>

    <!-- Timer -->
    <p id="timer" class="mb-4 text-lg text-red-700"></p>

    <!-- Index Section -->
    <div class="mb-6 flex flex-wrap gap-2">
        <?php foreach ($questions as $index => $question): ?>
            <button type="button" class="index-btn bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors" onclick="showQuestion(<?= $index ?>)">
                <?= $index + 1 ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Questions Form -->
    <form id="examForm" action="submit_exam1.php" method="POST">
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
