<?php
// Load the JSON file
$exam_id = 1; // Assuming this is for exam 1
$json_data = file_get_contents("./c/exam_$exam_id.json");
$exam_data = json_decode($json_data, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam <?php echo $exam_id; ?></title>
</head>
<body>
    <h1>Exam <?php echo $exam_id; ?></h1>
    <form action="submit_exam.php" method="post">
        <?php // Display questions
foreach ($exam_data['questions'] as $index => $question) {
    echo "<div>";
    echo "<p>Q" . ($index + 1) . ". " . nl2br($question['question']) . "</p>";
    
    foreach ($question['options'] as $key => $option) {
        echo "<input type='radio' name='q$index' value='$key'> $option<br>";
    }
    echo "</div><br>";
} ?>
        <button type="submit">Submit Exam</button>
    </form>
</body>
</html>
