<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /MCA-Gateway/views/login.php");
    exit;
}

// Include the database connection
include_once './db.php'; // Adjust the path if necessary

// Fetch user ID
$user_id = $_SESSION['user_id'];

// Fetch user card access
$sql = "SELECT card_id FROM user_card_access WHERE user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param('i', $user_id);
$execute_result = $stmt->execute();

if ($execute_result === false) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$result = $stmt->get_result();

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

$has_full_access = in_array($full_access_card_id, $access_cards);

// Fetch card ID for 'Module1'
$sql = "SELECT id FROM cards WHERE name = 'Module1'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($module1_card_id);
$stmt->fetch();
$stmt->close();

$has_module1_access = in_array($module1_card_id, $access_cards);

// Redirect if the user does not have access
if (!$has_module1_access && !$has_full_access) {
    header("Location: /MCA-Gateway/views/dashboard.php");
    exit;
}

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

// Get the JSON file name from the query string
$examId = $_POST['exam_id'] ?? '';

if (array_key_exists($examId, $examMapping)) {
    $jsonFile = $examMapping[$examId];
    $basePath = __DIR__ . "/"; // Points to the current directory 'exams1'
    $fullPath = $basePath . $jsonFile;

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
        $totalMarks = 20; // Example total marks, adjust as necessary

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

        // Calculate the time taken
        $timeTaken = isset($_SESSION['time_limit']) && isset($_SESSION['start_time']) ? $_SESSION['time_limit'] - (time() - $_SESSION['start_time']) : 0;

        // Define the status variable
        $status = 'submitted';

        // Prepare the SQL statement with 8 placeholders
        $stmt = $conn->prepare("INSERT INTO exam_results (exam_id, user_id, marks, status, time_taken, correct, incorrect, unattempted) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind the parameters to the SQL query
        $stmt->bind_param("ssissiii", $examId, $_SESSION['user_id'], $marks, $status, $timeTaken, $correct, $incorrect, $unattempted);

        // Execute the query
        $stmt->execute();
        $stmt->close();

        // Display results
        echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
        echo "<h2 class='text-3xl font-semibold mb-4 text-gray-800'>Exam Results</h2>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Marks:</strong> $marks</p>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Correct Answers:</strong> $correct</p>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Incorrect Answers:</strong> $incorrect</p>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Unattempted:</strong> $unattempted</p>";

        // Add View Answers button
        echo "<a href='rules1.php?exam_id=$examId' class='mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700'>View Answers</a>";
        echo "</div>";

    } else {
        echo "Error: Exam file not found.";
    }
} else {
    echo "Error: Invalid exam ID.";
}
?>
