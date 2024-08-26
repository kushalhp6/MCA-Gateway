<?php
// Start the session
session_start();

// Include the database connection
include_once './db.php'; // Adjust the path if necessary

// Exam ID to file mapping
$examMapping = [
    'c_set_1' => 'c_set_1.json',
    'c_set_2' => 'c_set_2.json',
    // Add more mappings as needed
];

// Get the JSON file name from the query string
$examId = $_GET['exam_id'] ?? '';

// Adjust the path to the JSON file
$basePath = __DIR__ . "/c/"; // Adjust this path to your actual file structure
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
    $marks = ($correct / count($questions)) * $totalMarks;
    // Calculate the time taken
    $timeTaken = $_SESSION['time_limit'] - (time() - $_SESSION['start_time']);


    // Define the status variable
$status = 'submitted';

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO exam_results (exam_id, user_id, marks, status, time_taken, correct, incorrect, unattempted) VALUES (?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die('Prepare failed: ' . $conn->error);
}

// Bind the parameters to the SQL query
$stmt->bind_param("ssiiiii", $examId, $_SESSION['user_id'], $marks, $status, $timeTaken, $correct, $incorrect, $unattempted);

// Execute the query
$stmt->execute();
$stmt->close();



    
    // Clear session data
    session_unset();
    session_destroy();

    // Display results
    echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
    echo "<h2 class='text-3xl font-semibold mb-4 text-gray-800'>Exam Results</h2>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Marks:</strong> $marks</p>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Correct Answers:</strong> $correct</p>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Incorrect Answers:</strong> $incorrect</p>";
    echo "<p class='text-lg text-gray-700 mb-2'><strong>Unattempted:</strong> $unattempted</p>";
    echo "</div>";
} else {
    echo "Error: Exam file not found.";
}
?>
