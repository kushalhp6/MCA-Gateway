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
<section class="bg-gray-900 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Founder and Lead Instructor -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-start">
                <img src="/assets/images/lead.JPG" alt="Prof. Subhabrata Bhattacharjee" class="w-32 h-32 rounded-full mb-4 object-cover">
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold mb-2">Founder and Lead Instructor</h3>
                    <p class="text-lg font-bold mb-1">Prof. Subhabrata Bhattacharjee</p>
                    <p class="text-sm text-gray-400 mb-1">Assistant Prof at Techno India Hooghly</p>
                    <p class="text-sm text-gray-400 mb-4">15+ years of teaching experience</p>
                    <p class="text-sm mb-2">Phone: <a href="tel:+918697101010" class="text-blue-400 hover:text-blue-300">+91 8697101010</a></p>
                    <p class="text-sm">Email: <a href="mailto:subhabratab7@gmail.com" class="text-blue-400 hover:text-blue-300">subhabratab7@gmail.com</a></p>
                </div>
            </div>
            
            <!-- Developer and CTO -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-start">
                <img src="/assets/images/cto.JPG" alt="Kushal Dalal" class="w-32 h-32 rounded-full mb-4 object-cover">
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold mb-2">Developer and CTO</h3>
                    <p class="text-lg font-bold mb-1">Kushal Dalal</p>
                    <p class="text-sm text-gray-400 mb-1">MCA student at University of Calcutta</p>
                    <p class="text-sm mb-2">Phone: <a href="tel:+916294134884" class="text-blue-400 hover:text-blue-300">+91 6294134884</a></p>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-start">
                <img src="/assets/images/dev.jpg" alt="Member 3" class="w-32 h-32 rounded-full mb-4 object-cover">
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold mb-2">Assist. Developer</h3>
                    <p class="text-lg font-bold mb-1">Santonu Naskar</p>
                    <p class="text-sm text-gray-400 mb-1">SDE in Accenture Kolkata</p>
                    <p class="text-sm mb-2">Phone: <a href="tel:+918240402210" class="text-blue-400 hover:text-blue-300">+91 8240402210</a></p>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-start">
                <img src="/assets/images/ins.jpg" alt="Member 4" class="w-32 h-32 rounded-full mb-4 object-cover">
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold mb-2">Instructor</h3>
                    <p class="text-lg font-bold mb-1">Sudipta Halder</p>
                    <p class="text-sm text-gray-400 mb-1">Assistant Prof. in Regent College</p>
                    <p class="text-sm mb-2">Phone: <a href="tel:+919903950802" class="text-blue-400 hover:text-blue-300">+91 9903950802</a></p>
                </div>
            </div>
            
            <!-- Card 5 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-start">
                <img src="/assets/images/ins2.jpg" alt="Member 5" class="w-32 h-32 rounded-full mb-4 object-cover">
                <div class="ml-4">
                    <h3 class="text-2xl font-semibold mb-2">Instructor</h3>
                    <p class="text-lg font-bold mb-1">Mainak Mitra</p>
                    <p class="text-sm text-gray-400 mb-1">Assistant Prof. in Techno India University</p>
                    <p class="text-sm mb-2">Phone: <a href="tel:+919123323451" class="text-blue-400 hover:text-blue-300">+91 9123323451</a></p>
                    
                </div>
            </div>
        </div>
    </div>
</section>


<section class="bg-gray-900 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Contact Us</h2>
            <p class="text-lg text-gray-400">Fill out the form below to get in touch with us.</p>
        </div>
        <div class="flex justify-center">
            <form action="mailto:shyamalhp001@gmail.com" method="post" enctype="text/plain" class="w-full max-w-lg bg-gray-800 p-8 rounded-lg shadow-lg">
                <div class="mb-4">
                    <label for="name" class="block text-white text-sm font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" required class="w-full bg-gray-700 text-white p-3 rounded-lg border border-gray-600 focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-white text-sm font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" required class="w-full bg-gray-700 text-white p-3 rounded-lg border border-gray-600 focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-white text-sm font-semibold mb-2">Message</label>
                    <textarea id="message" name="message" rows="4" required class="w-full bg-gray-700 text-white p-3 rounded-lg border border-gray-600 focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-500 transition duration-300">Send Message</button>
            </form>
        </div>
    </div>
</section>

    

    <?php include 'partials/footer.php'; ?>
</body>
</html>
