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

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4">What is JECA?</h3>
            <p class="text-lg text-justify">
                JECA is an entrance exam conducted for admission into postgraduate programs in Computer Applications (MCA) in various colleges and universities in West Bengal, India. It tests candidates on their knowledge and aptitude in subjects relevant to computer applications and programming.
            </p>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-auto">
    <h3 class="text-2xl font-semibold mb-4">Eligibility Criteria</h3>
    <ul class="list-disc pl-6 space-y-2 text-lg text-justify break-words">
        <li><strong>Educational Qualification:</strong> Bachelor’s degree in any discipline with Mathematics/Physics/Chemistry/Computer Science/Computer Application as a subject at the undergraduate level or at the 10+2 level.</li>
        <li><strong>Minimum Marks:</strong> Generally, at least 50% aggregate marks in the undergraduate degree. Specific requirements may vary by institution.</li>
    </ul>
</div>


        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4">Exam Pattern</h3>
            <ul class="list-disc pl-6 space-y-2 text-lg text-justify">
                <li><strong>Mode:</strong> Pen and paper based test (OMR).</li>
                <li><strong>Duration:</strong> 2 hours.</li>
                <li><strong>Sections:</strong> Mathematics, C, OOPs, Architecture, Unix, Data Structures and Algorithms (DSA), Operating Systems (OS), Networking, Software Engineering, Database Management Systems (DBMS), Machine Learning.</li>
                <li><strong>Question Type:</strong> Multiple-choice questions (MCQs).</li>
                <li><strong>Marking Scheme:</strong>
                    <ul class="list-disc pl-6 space-y-1">
                        <li><strong>Questions 1-80:</strong> Each correct answer earns 1 mark with a penalty for incorrect answers (¼ mark deducted).</li>
                        <li><strong>Questions 81-100:</strong> Each question carries 2 marks with one or more correct answers. No negative marking.</li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4">Preparation Tips</h3>
            <ul class="list-disc pl-6 space-y-2 text-lg text-justify">
                <li><strong>Understand the Syllabus:</strong> Familiarize yourself with the detailed syllabus for each section of the exam.</li>
                <li><strong>Practice Regularly:</strong> Solve previous years' question papers and take mock tests to build confidence and improve speed.</li>
                <li><strong>Time Management:</strong> Practice managing your time efficiently during the exam to ensure you can attempt all questions.</li>
            </ul>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4">Application Process</h3>
            <ul class="list-disc pl-6 space-y-2 text-lg text-justify">
                <li><strong>Registration:</strong> Register for the exam through the official JECA website.</li>
                <li><strong>Application Form:</strong> Fill out the application form with accurate details and submit the required documents.</li>
                <li><strong>Admit Card:</strong> Download and print the admit card once it is released. It is mandatory to bring it to the exam center.</li>
            </ul>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4">Important Dates</h3>
            <ul class="list-disc pl-6 space-y-2 text-lg text-justify">
                <li><strong>Notification:</strong> Usually announced a few months before the exam.</li>
                <li><strong>Application Deadline:</strong> Check the specific deadlines for registration and fee submission.</li>
                <li><strong>Exam Date:</strong> Confirm the date on the official website or notification.</li>
                <li><strong>Result Declaration:</strong> Results are typically announced a few weeks after the exam.</li>
            </ul>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4">Result and Admission</h3>
            <ul class="list-disc pl-6 space-y-2 text-lg text-justify">
                <li><strong>Result:</strong> JECA results are published online. Candidates can check their scores and rank on the official website.</li>
                <li><strong>Counseling:</strong> Based on the results, candidates are called for counseling sessions where they can choose their preferred college and specialization.</li>
            </ul>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8 overflow-hidden">
            <h3 class="text-2xl font-semibold mb-4">Additional Information</h3>
            <ul class="list-disc pl-6 space-y-2 text-lg text-justify">
                <li><strong>Books and Resources:</strong> Refer to online resources specifically tailored for JECA preparation in our Resources Section.</li>
                <li><strong>Coaching Institutes:</strong> Consider enrolling in a coaching institute (MCA-Gateway) if you need structured guidance and additional practice.</li>
            </ul>
        </div>
    </div>
</section>



    <?php include 'partials/footer.php'; ?>
</body>
</html>
