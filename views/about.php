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
    <title>About Us - MCA Gateway</title>
</head>
<body>
<section class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div class="md:pr-8">
                <h2 class="text-4xl font-bold mb-6">Welcome to MCA Gateway</h2>
                <p class="text-lg mb-6">MCA Gateway is your ultimate companion for excelling in MCA entrance exams like <span class="font-semibold text-xl">JECA</span>. We are committed to providing aspiring students with the best resources, guidance, and support to achieve their academic goals.</p>
                <a href="/views/signup.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-500 transition duration-300">Join Us Today</a>
            </div>
            <div class="flex justify-center">
                <img src="/assets/images/bg5.JPG" alt="MCA Gateway" class="w-96 h-auto rounded-lg shadow-lg"> <!-- Adjusted size -->
            </div>
        </div>
    </div>
</section>



<section class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div class="flex justify-center">
                <img src="/assets/images/bg 4.JPG" alt="Vision & Mission" class="w-96 h-auto rounded-lg shadow-lg">
            </div>
            <div class="md:pl-8">
                <h3 class="text-3xl font-bold mb-6">Our Vision & Mission</h3>
                <p class="text-lg mb-6">Our vision is to become the leading platform for MCA aspirants, empowering them with the resources and knowledge needed to excel in their entrance exams.</p>
                <p class="text-lg mb-6">We strive to make quality education accessible to all students, guiding them through every step of their journey towards securing a place in top institutions.</p>
            </div>
        </div>
    </div>
</section>


<section class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div class="md:pr-8">
                <h3 class="text-3xl font-bold mb-6">Our Story</h3>
                <p class="text-lg mb-6">MCA Gateway was founded by a team of passionate educators and former MCA aspirants who recognized the need for a comprehensive and accessible resource hub for students preparing for MCA entrance exams.</p>
                <p class="text-lg mb-6">Our journey began with a simple idea: to create a platform that would not only provide high-quality study materials but also offer personalized guidance and support to students.</p>
            </div>
            <div class="flex justify-center">
                <img src="/assets/images/bg6.JPG" alt="Vision & Mission" class="w-96 h-auto rounded-lg shadow-lg">
            </div>
        </div>
    </div>
</section>


<section class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold">Meet Our Founders</h3>
            <p class="text-lg mt-4">The dedicated team behind MCA Gateway</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Founder 1 -->
            <div class="text-center">
                <img src="/assets/images/lead.JPG" alt="Founder 1" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-xl font-semibold">Subhabrata Bhattacharjee</h4>
                <p class="text-lg text-gray-400">Lead Instructor (15 years Exp)</p>
            </div>

            <!-- Founder 2 -->
            <div class="text-center">
                <img src="/assets/images/lead2.JPG" alt="Founder 2" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-xl font-semibold">Kushal Dalal</h4>
                <p class="text-lg text-gray-400">Lead Developer</p>
            </div>
            <!-- Founder 3 -->
            <div class="text-center">
                <img src="/assets/images/dev.jpg" alt="Founder 3" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-xl font-semibold">Santonu Naskar</h4>
                <p class="text-lg text-gray-400">Developer</p>
            </div>
            <!-- Founder 4 -->
            <div class="text-center">
                <img src="/assets/images/ins.jpg" alt="Founder 3" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-xl font-semibold">Sudipta Halder</h4>
                <p class="text-lg text-gray-400">Instructor</p>
            </div>
            <!-- Founder 5 -->
            <div class="text-center">
                <img src="/assets/images/ins2.jpg" alt="Founder 3" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-xl font-semibold">Mainak Mitra</h4>
                <p class="text-lg text-gray-400">Instructor</p>
            </div>
            <!-- Founder 6 -->
            <div class="text-center">
                <img src="/assets/images/ins3.jpg" alt="Founder 3" class="w-40 h-40 rounded-full mx-auto mb-4 shadow-lg object-cover">
                <h4 class="text-xl font-semibold">Subhankar Bera</h4>
                <p class="text-lg text-gray-400">Instructor</p>
            </div>
        </div>
    </div>
</section>





    <?php include 'partials/footer.php'; ?>
</body>
</html>
