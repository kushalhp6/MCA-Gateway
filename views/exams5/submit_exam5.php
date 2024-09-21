<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Submitted Details</title>
</head>
<body>
<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /views/login.php");
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

// Fetch card IDs for access
$cards = ['Full Access', 'Mock'];
$card_ids = [];

foreach ($cards as $card_name) {
    $sql = "SELECT id FROM cards WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $card_name);
    $stmt->execute();
    $stmt->bind_result($card_id);
    $stmt->fetch();
    $card_ids[$card_name] = $card_id;
    $stmt->close();
}

$has_full_access = in_array($card_ids['Full Access'], $access_cards);
$has_mock_access = in_array($card_ids['Mock'], $access_cards);

// Redirect if the user does not have access
if (!$has_mock_access && !$has_full_access) {
    header("Location: /views/dashboard.php");
    exit;
}

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
    'mock_12' => 'json/mock_12.json',
    // Add other exams here
];

// Get the JSON file name from the query string
$examId = $_POST['exam_id'] ?? '';

if (array_key_exists($examId, $examMapping)) {
    $jsonFile = $examMapping[$examId];
    $basePath = __DIR__ . "/"; // Points to the current directory
    $fullPath = $basePath . $jsonFile;

    // Load the JSON file
    if (file_exists($fullPath)) {
        $jsonData = file_get_contents($fullPath);
        $examData = json_decode($jsonData, true);

        if ($examData === null) {
            die('Error decoding JSON file.');
        }

        // Extract the exam details
        $questions = $examData['questions'] ?? [];
        $totalMarks = $examData['total_marks'] ?? 0;
        $sectionAMarks = 1; // Marks for each single-select question
        $sectionBMarks = 2; // Marks for each multiple-select question

        // Retrieve the user's answers
        $userAnswers = $_POST['sectionA'] ?? []; // For single-select answers
        $userAnswersB = $_POST['sectionB'] ?? []; // For multiple-select answers

        // Initialize counters and marks
        $correct = 0;
        $incorrect = 0;
        $unattempted = 0;
        $marks = 0;

        // Check the user's answers for Section A (single-select)
        foreach ($questions as $index => $question) {
            if ($question['type'] === 'single') {
                if (isset($userAnswers[$index])) {
                    if ($userAnswers[$index] === $question['correct_answer']) {
                        $correct++;
                        $marks += $sectionAMarks; // Full marks for correct answer
                    } else {
                        $incorrect++;
                        $marks -= 0.25; // Apply negative marking
                    }
                } else {
                    $unattempted++;
                }
            }
        }

        // Check the user's answers for Section B (multiple-select)
        foreach ($questions as $index => $question) {
            if ($question['type'] === 'multiple') {
                $correctAnswers = $question['correct_answer'];
                $userAnswerKeys = $userAnswersB[$index] ?? [];

                // Sort answers for comparison
                sort($userAnswerKeys);
                sort($correctAnswers);

                if ($userAnswerKeys === $correctAnswers) {
                    $correct++;
                    $marks += $sectionBMarks; // Full marks for completely correct answer
                } elseif (!empty($userAnswerKeys)) {
                    // Partial marking
                    $partialMarks = ($sectionBMarks / count($correctAnswers)) * count(array_intersect($userAnswerKeys, $correctAnswers));
                    $marks += $partialMarks;
                } else {
                    $unattempted++;
                }
            }
        }

        // Ensure marks are not negative
        if ($marks < 0) {
            $marks = 0;
        }

        // Define the status variable
        $status = 'submitted';

        // Prepare the SQL statement with 7 placeholders
        $stmt = $conn->prepare("INSERT INTO exam_results (exam_id, user_id, marks, status, correct, incorrect, unattempted) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        // Bind the parameters to the SQL query
        $stmt->bind_param("ssissii", $examId, $user_id, $marks, $status, $correct, $incorrect, $unattempted);

        // Execute the query
        $stmt->execute();
        $stmt->close();

        // Unset the timer-related session variables after the exam is submitted
        unset($_SESSION['start_time']);
        unset($_SESSION['time_limit']);

        // Display results
        echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
        echo "<h2 class='text-3xl font-semibold mb-4 text-gray-800'>Exam Results</h2>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Marks:</strong> $marks</p>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Correct Answers:</strong> $correct</p>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Incorrect Answers:</strong> $incorrect</p>";
        echo "<p class='text-lg text-gray-700 mb-2'><strong>Unattempted:</strong> $unattempted</p>";

        // Add View Answers button
        echo "<a href='rules5.php?exam_id=$examId' class='mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700'>View Answers</a>";
        echo "</div>";

    } else {
        echo "Error: Exam file not found.";
    }
} else {
    echo "Error: Invalid exam ID.";
}
?>
</body>
</html>
