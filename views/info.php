<?php
session_start(); // Start the session
include 'partials/navbar.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Info - MCA Gateway</title>
</head>
<body>
<section class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold">JECA Exam Information</h2>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold mb-4">Exam Details</h3>
            <ul class="space-y-2 text-lg">
                <li><strong>Duration:</strong> 2 Hours</li>
                <li><strong>No. of MCQs:</strong> 100</li>
                <li><strong>Full Marks:</strong> 120</li>
            </ul>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mt-8">
            <h3 class="text-2xl font-semibold mb-4">Instructions</h3>
            <ol class="list-decimal pl-6 space-y-2 text-lg">
                <li>All questions are of objective type with four answer options for each.</li>
                <li>
                    <strong>Category-1:</strong> Carries 1 mark each, and only one option is correct. In case of an incorrect answer or multiple answers, ¼ mark will be deducted.
                </li>
                <li>
                    <strong>Category-2:</strong> Carries 2 marks each, and one or more options may be correct. If all correct answers are marked and no incorrect answer is marked, then score = 2 × (number of correct answers marked ÷ actual number of correct answers). If any wrong option is marked or a combination with a wrong option is marked, the answer will be considered wrong, and zero marks will be awarded.
                </li>
                <li>Questions must be answered on the OMR sheet by darkening the appropriate bubble marked A, B, C, or D.</li>
                <li>Use only Black/Blue ink ballpoint pen to mark the answers by filling in the respective bubbles completely.</li>
                <li>Write the question booklet number and your roll number carefully in the specified locations of the OMR Sheet. Also, fill in the appropriate bubbles.</li>
                <li>Write your name (in block letters), examination center name, and signature in the appropriate boxes on the OMR Sheet.</li>
                <li>The OMR sheet may become invalid if there is any mistake in filling the correct bubbles for the question booklet number/roll number or if there is any discrepancy in the name/signature of the candidate or the examination center's name. The OMR Sheet may also become invalid due to folding, stray marks, or damage. The candidate is solely responsible for such invalidation.</li>
                <li>Candidates are not allowed to carry any written or printed material, calculator, pen, log-table, wristwatch, or any communication device like mobile phones or Bluetooth devices inside the examination hall. Any candidate found with such prohibited items will be reported, and their candidature will be summarily canceled.</li>
                <li>Rough work must be done on the question booklet itself. Additional blank pages are provided in the question booklet for rough work.</li>
                <li>Hand over the OMR Sheet to the invigilator before leaving the Examination Hall.</li>
            </ol>
        </div>
    </div>
</section>



    <?php include 'partials/footer.php'; ?>
</body>
</html>
