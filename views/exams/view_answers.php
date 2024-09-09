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

    // Exam ID to file mapping
    $examMapping = [
        'c_set_1' => 'c_set_1.json',
        'oops_set_1' => 'oops_set_1.json',
        'unix_set_1' => 'unix_set_1.josn',
        'dsa_set_1'  => 'dsa_set_1.json',
        'architecture_set_1' => 'architecture_set_1.json',
        'os_set_1' => 'os_set_1.json',
        'network_set_1' => 'network_set_1.json',
        'dbms_set_1' => 'dbms_set_1.json',


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

    // Adjust the path to the JSON file
    $basePath = __DIR__ . "/json/"; // Adjust this path to your actual file structure
    $fullPath = $basePath . basename($examId) . ".json"; // Ensure the correct extension is added

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
