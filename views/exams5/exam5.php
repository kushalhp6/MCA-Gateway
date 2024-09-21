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

// Fetch card ID for 'Mock'
$sql = "SELECT id FROM cards WHERE name = 'Mock'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($mock_card_id);
$stmt->fetch();
$stmt->close();

// Check if the user has 'Mock'
$has_mock_access = in_array($mock_card_id, $access_cards);

// Redirect if the user does not have access
if (!$has_mock_access && !$has_full_access) {
    header("Location: /views/dashboard.php");
    exit;
}

// Get the exam ID from the query string
$examId = $_GET['exam_id'] ?? '';

// Base Path for the JSON files
$basePath = __DIR__ . "/"; // Points to the current directory 'exams5'

$examMapping = [
    'mock_1' => 'json/mock_1.json',
    'mock_2' => 'json/mock_2.json',
    'mock_3' => 'json/mock_3.json',
    'mock_4' => 'json/mock_4.json',
    'mock_5' => 'json/mock_5.json',
    'mock_6' => 'json/mock_6.json',
    'mock_7' => 'json/mock_7.json',
    'mock_8' => 'json/mock_8.json',
    'mock_9' => 'json/mock_9.json',
    'mock_10' => 'json/mock_10.json',
    'mock_11' => 'json/mock_11.json',
    'mock_12' => 'json/mock_12.json',    // Add more mappings as needed
];

// Determine the file path based on the exam ID
if ($examId && array_key_exists($examId, $examMapping)) {
    $fileName = $examMapping[$examId];
    $fullPath = $basePath . $fileName;

    // Load the JSON file
    if (file_exists($fullPath)) {
        $jsonData = file_get_contents($fullPath);
        $examData = json_decode($jsonData, true);

        // Extract the exam details
        $examName = $examData['exam_name'] ?? 'Unknown Exam';
        $marks = $examData['total_marks'] ?? 0;
        $timeLimit = $examData['time_limit'] ?? 0;
        $questions = $examData['questions'] ?? [];

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
            header("Location: submit_exam5.php?exam_id=" . urlencode($examId));
            exit;
        }

        // Divide questions into Section A (Single Select) and Section B (Multiple Select)
        $sectionAQuestions = array_filter($questions, function ($q) {
            return $q['type'] === 'single';
        });
        
        $sectionBQuestions = array_filter($questions, function ($q) {
            return $q['type'] === 'multiple';
        });

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
            header("Location: rules5.php?exam_id=" . urlencode($examId));
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

    let remainingTime = <?= $remainingTime ?>;

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
    
    // Set to keep track of answered questions
    var answeredQuestions = new Set();

    // Function to toggle index section visibility
    function toggleIndex() {
        var indexSection = document.getElementById('questionIndex');
        var toggleButton = document.getElementById('toggleButton');

        if (indexSection.classList.contains('hidden')) {
            indexSection.classList.remove('hidden');
            toggleButton.innerText = 'Hide Index';
        } else {
            indexSection.classList.add('hidden');
            toggleButton.innerText = 'Expand Index';
        }
    }

    // Function to update the index button style when a question is answered
    function updateIndexButton(questionIndex) {
        // Add the current question to the set of answered questions
        answeredQuestions.add(questionIndex);

        // Update all buttons based on whether they have been answered
        var buttons = document.querySelectorAll('.index-btn');
        buttons.forEach(button => {
            var index = parseInt(button.id.split('_')[1]);
            if (answeredQuestions.has(index)) {
                button.classList.add('bg-green-500', 'text-white');
            } else {
                button.classList.remove('bg-green-500', 'text-white');
            }
        });
    }

    // Ensure that when the page loads, the index is collapsed by default
    window.onload = function() {
        document.getElementById('questionIndex').classList.add('hidden');
    }




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

    // Initialize the first question 
    window.onload = () => {
        startTimer();
        showQuestion(0);
    }
    </script>
</head>
<body class="bg-gray-50">

<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <!-- Exam Name -->
    <h2 class="text-3xl font-semibold mb-4 text-gray-800"><?= htmlspecialchars($examName) ?></h2>

    <!-- Timer -->
    <p id="timer" class="mb-4 text-lg text-red-700"></p>

    <!-- Button to Expand/Collapse the Index -->
    <div class="mb-6">
        <button id="toggleButton" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors" onclick="toggleIndex()">Expand Index</button>
    </div>

    <!-- Expandable/Collapsible Index Section -->
    <div id="questionIndex" class="flex flex-wrap gap-2 max-h-40 overflow-scroll hidden">
        <?php foreach ($questions as $index => $question): ?>
            <button id="indexButton_<?= $index ?>" type="button" class="index-btn bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition-colors" onclick="showQuestion(<?= $index ?>)">
                <?= $index + 1 ?>
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Questions Form -->
    <form id="examForm" action="submit_exam5.php" method="POST">
        <!-- Section A: Single-Select MCQs -->
        <?php foreach ($sectionAQuestions as $index => $question): ?>
            <div class="question mb-6">
            <h2>Section A - MCQs</h2>
                <p class="text-lg text-gray-700 mb-2"><strong>Question <?= $index + 1 ?>:</strong></p>
                <div class="text-gray-700 mb-2"><?= nl2br(htmlspecialchars_decode($question['question'])) ?></div>
                <?php foreach ($question['options'] as $key => $option): ?>
                    <label class="block text-gray-600">
                        <input type="radio" name="sectionA[<?= $index ?>]" value="<?= htmlspecialchars($key) ?>" class="mr-2" onchange="updateIndexButton(<?= $index ?>)">
                        <?= htmlspecialchars($option) ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <!-- Section B: Multiple-Select Questions -->
        <?php foreach ($sectionBQuestions as $index => $question): ?>
            <div class="question mb-6">
            <h2>Section B - Multiple-Select Questions</h2>
                <p class="text-lg text-gray-700 mb-2"><strong>Question <?= $index + 1 ?>:</strong></p>
                <div class="text-gray-700 mb-2"><?= nl2br(htmlspecialchars_decode($question['question'])) ?></div>
                <?php foreach ($question['options'] as $key => $option): ?>
                    <label class="block text-gray-600">
                        <input type="checkbox" name="sectionB[<?= $index ?>][]" value="<?= htmlspecialchars($key) ?>" class="mr-2" onchange="updateIndexButton(<?= $index ?>)">
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
