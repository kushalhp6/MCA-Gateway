<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /views/login.php");
    exit;
}

// Include the database connection
include_once './db.php'; // Adjust the path if necessary

// Exam ID to file mapping
$examMapping = [
    'c_set_1' => 'c_set_1.json',
    'oops_set_1' => 'oops_set_1.json',
    'unix_set_1' => 'unix_set_1.json',
    // Add more mappings as needed
];

// Get the JSON file name from the query string
$examId = $_POST['exam_id'] ?? '';

// Adjust the path to the JSON file
$basePath = __DIR__ . "/json/"; // Adjust this path to your actual file structure
$fullPath = $basePath . basename($examId) . ".json"; // Ensure the correct extension is added

// Load the JSON file
if (file_exists($fullPath)) {
    $jsonData = file_get_contents($fullPath);
    $examData = json_decode($jsonData, true);

    // Extract the exam details
    $questions = $examData['questions'] ?? [];
    $totalMarks = $examData['total_marks'] ?? 0;

    // Retrieve the user's answers
    $userAnswers = $_POST['answers'] ?? [];

    // Initialize counters
    $correct = 0;
    $incorrect = 0;
    $unattempted = 0;

    // Check the user's answers
    foreach ($questions as $index => $question) {
        if (isset($userAnswers[$index])) {
            if ($userAnswers[$index] === $question['correct_answer']) {
                $correct++;
            } else {
                $incorrect++;
            }
        } else {
            $unattempted++;
        }
    }

    // Calculate marks
    $initialMarks = ($correct / count($questions)) * $totalMarks;

    // Apply penalty for incorrect attempts
    $penalty = $incorrect * 0.25;
    $marks = $initialMarks - $penalty;

    // Define the status variable
    $status = 'submitted';

    // Prepare the SQL statement with 8 placeholders
    $stmt = $conn->prepare("INSERT INTO exam_results (exam_id, user_id, marks, status, correct, incorrect, unattempted) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the parameters to the SQL query
    $stmt->bind_param("ssissii", $examId, $_SESSION['user_id'], $marks, $status, $correct, $incorrect, $unattempted);

    // Execute the query
    $stmt->execute();
    $stmt->close();

    // Clear session data if needed
    // session_unset();
    // session_destroy();

    // Display results
    echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
    echo "<h2 class='text-3xl font-semibold mb-4 text-gray-800'>Exam Results</h2>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Marks:</strong> $marks</p>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Correct Answers:</strong> $correct</p>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Incorrect Answers:</strong> $incorrect</p>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Unattempted:</strong> $unattempted</p>";

    // Add View Answers button
    echo "<a href='rules.php?exam_id=$examId' class='mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700'>View Answers</a>";
    echo "</div>";
} else {
    echo "Error: Exam file not found.";
}
?>
