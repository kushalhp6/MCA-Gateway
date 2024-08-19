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
    <title>Contact Us - MCA Gateway</title>
</head>
<body>
<section class="bg-[#1e1e1e] text-white py-12">
    <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Half -->
<div class="space-y-8">
    <!-- Founder and Lead Instructor Section -->
    <div class="bg-[#2d2d2d] p-6 rounded-lg shadow-lg flex items-center">
        <img src="path_to_founder_photo.jpg" alt="Prof. Subhabrata Bhattacharjee" class="w-24 h-24 rounded-full mr-6">
        <div>
            <h3 class="text-2xl font-semibold mb-2">Founder and Lead Instructor</h3>
            <p class="text-lg font-bold">Prof. Subhabrata Bhattacharjee</p>
            <p class="text-sm">Assistant Prof at Techno India Hooghly</p>
            <p class="text-sm">15+ years of teaching experience</p>
            <p class="mt-4">Phone: <a href="tel:+910000000000" class="text-blue-400 hover:text-blue-300">+91 00000 00000</a></p>
            <p>Email: <a href="mailto:subhabrata@technohooghly.edu.in" class="text-blue-400 hover:text-blue-300">subhabrata@technohooghly.edu.in</a></p>
        </div>
    </div>

    <!-- Developer and CTO Section -->
    <div class="bg-[#2d2d2d] p-6 rounded-lg shadow-lg flex items-center">
        <img src="path_to_cto_photo.jpg" alt="Kushal Dalal" class="w-24 h-24 rounded-full mr-6">
        <div>
            <h3 class="text-2xl font-semibold mb-2">Developer and CTO</h3>
            <p class="text-lg font-bold">Kushal Dalal</p>
            <p class="text-sm">MCA student at University of Calcutta</p>
            <p class="mt-4">Phone: <a href="tel:+910000000000" class="text-blue-400 hover:text-blue-300">+91 00000 00000</a></p>
            <p>Email: <a href="mailto:kushal@caluniv.ac.in" class="text-blue-400 hover:text-blue-300">kushal@caluniv.ac.in</a></p>
        </div>
    </div>
</div>


        <!-- Right Half: Contact Form -->
        <div class="bg-[#2d2d2d] p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold mb-4 text-center md:text-left">Contact Us</h3>
            <form action="mailto:your-email@example.com" method="post" enctype="text/plain">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-2">Your Name</label>
                    <input type="text" id="name" name="name" class="w-full p-3 rounded bg-[#1e1e1e] border border-gray-600 focus:border-blue-400 focus:ring focus:ring-blue-300 outline-none transition duration-200">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-2">Your Email</label>
                    <input type="email" id="email" name="email" class="w-full p-3 rounded bg-[#1e1e1e] border border-gray-600 focus:border-blue-400 focus:ring focus:ring-blue-300 outline-none transition duration-200">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium mb-2">Your Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full p-3 rounded bg-[#1e1e1e] border border-gray-600 focus:border-blue-400 focus:ring focus:ring-blue-300 outline-none transition duration-200"></textarea>
                </div>
                <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">Send Message</button>
            </form>
        </div>
    </div>
</section>
    

    <?php include 'partials/footer.php'; ?>
</body>
</html>
