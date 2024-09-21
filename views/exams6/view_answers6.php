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

    

    $examMapping = [
        'set_22' => 'json/set_2022.json',
        'set_23' => 'json/set_2023.json',
        'set_24' => 'json/set_2024.json',
        // Add more mappings as needed
    ];

    $examId = $_GET['exam_id'] ?? '';

    // Fetch the user's exam status
    $stmt = $conn->prepare("SELECT status FROM exam_results WHERE exam_id = ? AND user_id = ?");
    $stmt->bind_param("ss", $examId, $user_id);
    $stmt->execute();
    $stmt->bind_result($status);
    $stmt->fetch();
    $stmt->close();

    if ($status !== 'submitted') {
        echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
        echo "<h2 class='text-2xl font-semibold mb-4 text-red-600'>Access Denied</h2>";
        echo "<p class='text-lg text-gray-700'>You can only view the answers after submitting the exam.</p>";
        echo "</div>";
        exit;
    }

    $jsonFile = $examMapping[$examId];
    $fullPath = __DIR__ . "/" . $jsonFile;

    if (file_exists($fullPath)) {
        $jsonData = file_get_contents($fullPath);
        $examData = json_decode($jsonData, true);

        $questions = $examData['questions'] ?? [];
        $examName = $examData['exam_name'] ?? 'Unknown Exam';

        echo "<div class='max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md'>";
        echo "<h2 class='text-3xl font-semibold mb-4 text-gray-800'>Answers for: $examName</h2>";

        foreach ($questions as $index => $question) {
            $questionText = nl2br(htmlspecialchars_decode($question['question']));
            echo "<div class='question mb-6' id='question-$index'>";
            echo "<p class='text-lg text-gray-700 mb-2'><strong>Question " . ($index + 1) . ":</strong></p>";
            echo "<div class='text-gray-700 mb-2'>$questionText</div>";

            // Check the type of question
            if ($question['type'] === 'single') {
                $correctAnswer = $question['correct_answer'];
                foreach ($question['options'] as $key => $option) {
                    $class = ($key === $correctAnswer) ? 'text-green-600 font-bold' : 'text-gray-600';
                    echo "<p class='$class'>$key. $option</p>";
                }
            } elseif ($question['type'] === 'multiple') {
                $correctAnswers = $question['correct_answer'];
                foreach ($question['options'] as $key => $option) {
                    $class = in_array($key, $correctAnswers) ? 'text-green-600 font-bold' : 'text-gray-600';
                    echo "<p class='$class'>$key. $option</p>";
                }
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
