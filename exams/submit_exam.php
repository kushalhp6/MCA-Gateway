<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
require_once '../php/db.php';

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Get the exam ID (assuming it's passed as a hidden field or via GET parameter)
$exam_id = 1;

// Load the JSON file for the exam
$json_data = file_get_contents("./c/exam_$exam_id.json");
$exam_data = json_decode($json_data, true);

// Initialize marks
$total_marks = 0;

// Loop through the questions and calculate the score
foreach ($exam_data['questions'] as $index => $question) {
    $selected_option = isset($_POST["q$index"]) ? (int)$_POST["q$index"] : -1;
    
    if ($selected_option == $question['correct_answer']) {
        $total_marks++;
    }
}

// Insert the result into the exam_results table
$stmt = $conn->prepare("INSERT INTO exam_results (user_id, exam_id, marks) VALUES (?, ?, ?)");
$stmt->bind_param('iii', $user_id, $exam_id, $total_marks);
$stmt->execute();
$stmt->close();

// Display a success message
echo "<script>alert('Exam submitted successfully! You scored $total_marks out of " . count($exam_data['questions']) . ".');</script>";

// Redirect to the dashboard or any other page
header("Location: ");
exit;
?>
