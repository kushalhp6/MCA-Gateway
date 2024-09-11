<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Answers</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
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
    'oops_set_2' => 'oops/oops_set_2.json',
    'oops_set_3' => 'oops/oops_set_3.json',
    'oops_set_4' => 'oops/oops_set_4.json',
    'oops_set_5' => 'oops/oops_set_5.json',
    'oops_set_6' => 'oops/oops_set_6.json',
    'oops_set_7' => 'oops/oops_set_7.json',
    'oops_set_8' => 'oops/oops_set_8.json',
    'oops_set_9' => 'oops/oops_set_9.json',
    'oops_set_10' => 'oops/oops_set_10.json',
    'unix_set_2' => 'unix/unix_set_2.json',
    'unix_set_3' => 'unix/unix_set_3.json',
    'unix_set_4' => 'unix/unix_set_4.json',
    'unix_set_5' => 'unix/unix_set_5.json',
    'unix_set_6' => 'unix/unix_set_6.json',
    'unix_set_7' => 'unix/unix_set_7.json',
    'unix_set_8' => 'unix/unix_set_8.json',
    'unix_set_9' => 'unix/unix_set_9.json',
    'unix_set_10' => 'unix/unix_set_10.json',
        // Add more mappings as needed
    ];

    // Get the exam ID from the query string
    $examId = $_GET['exam_id'] ?? '';

    // Fetch the user's exam status from the database
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT status FROM exam_results WHERE exam_id = ? AND user_id = ?");
    $stmt->bind_param("ss", $examId, $userId);
    $stmt->execute();
    $stmt->bind_result($status);
    $stmt->fetch();
    $stmt->close();

    // Check if the exam status is "submitted"
    if ($status !== 'submitted') {
        echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
        echo "<h2 class='text-2xl font-semibold mb-4 text-red-600'>Access Denied</h2>";
        echo "<p class='text-lg text-gray-700'>You can only view the answers after submitting the exam.</p>";
        echo "</div>";
        exit;
    }

    $jsonFile = $examMapping[$examId];
    $basePath = __DIR__ . "/"; // Points to the current directory 'exams1'
    $fullPath = $basePath . $jsonFile;

    // Load the JSON file
    if (file_exists($fullPath)) {
        $jsonData = file_get_contents($fullPath);
        $examData = json_decode($jsonData, true);

        // Extract the exam details
        $questions = $examData['questions'] ?? [];
        $examName = $examData['exam_name'] ?? 'Unknown Exam';

        // Display the exam name
        echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
        echo "<h2 class='text-3xl font-semibold mb-4 text-gray-800'>Answers for: $examName</h2>";

        // Loop through the questions and display each question with its correct answer
        foreach ($questions as $index => $question) {
            $questionText = nl2br(htmlspecialchars_decode($question['question']));
            $correctAnswer = $question['correct_answer'];

            echo "<div class='question mb-6' id='question-$index'>";
            echo "<p class='text-lg text-gray-700 mb-2'><strong>Question " . ($index + 1) . ":</strong></p>";
            echo "<div class='text-gray-700 mb-2'>$questionText</div>";

            foreach ($question['options'] as $key => $option) {
                // Highlight the correct answer
                $class = ($key === $correctAnswer) ? 'text-green-600 font-bold' : 'text-gray-600';
                echo "<p class='$class'>$key. $option</p>";
            }

            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
        echo "<h2 class='text-2xl font-semibold mb-4 text-red-600'>Error</h2>";
        echo "<p class='text-lg text-gray-700'>Exam file not found.</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
