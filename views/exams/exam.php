<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /MCA-Gateway/views/login.php");
    exit;
}


// Get the exam ID from the query string
$examId = $_GET['exam_id'] ?? '';

// Base Path for the JSON files
$basePath = __DIR__ . "/c/";

// Exam ID to file mapping
$examMapping = [
    'c_set_1' => 'c_set_1.json',
    'c_set_2' => 'c_set_2.json',
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
            header("Location: submit_exam.php?exam_id=" . urlencode($examId));
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
    
    <script type="text/javascript" >
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script>
    
    <script>
        let remainingTime = <?= $remainingTime ?>;
        let currentQuestionIndex = 0;

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

        function showQuestion(index) {
            const questions = document.querySelectorAll('.question');
            questions.forEach((question, i) => {
                question.style.display = i === index ? 'block' : 'none';
            });
        }

        function nextQuestion() {
            if (currentQuestionIndex < document.querySelectorAll('.question').length - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            }
        }

        function prevQuestion() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                showQuestion(currentQuestionIndex);
            }
        }

        window.onload = () => {
            startTimer();
            showQuestion(currentQuestionIndex);
        }
    </script>
</head>
<body class="bg-gray-50">

    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <!-- Exam Name -->
        <h2 class="text-3xl font-semibold mb-4 text-gray-800"><?= htmlspecialchars($examName) ?></h2>

        <!-- Timer -->
        <p id="timer" class="mb-4 text-lg text-red-700"></p>

        <!-- Questions Form -->
        <form id="examForm" action="submit_exam.php" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question mb-6" style="display: none;">
                    <p class="text-lg text-gray-700 mb-2"><strong>Question <?= $index + 1 ?>:</strong> <?= htmlspecialchars($question['question']) ?></p>
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
