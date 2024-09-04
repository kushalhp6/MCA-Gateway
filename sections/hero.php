<div class="relative bg-gray-800 min-h-screen flex items-center">
    <div class="absolute inset-0 bg-black opacity-60"></div> <!-- Solid overlay for contrast -->

    <div class="relative z-10 flex flex-col md:flex-row items-center w-full p-8 max-w-7xl mx-auto">
        <!-- Left Side: Professor's Image -->
        <div class="w-full md:w-1/2 flex justify-center mb-8 md:mb-0">
            <img src="/assets/images/bg2.png" alt="Shubhabrata Bhattacharjee" class="h-96 md:h-[30rem] object-contain">
        </div>

        <!-- Right Side: Text and Call-to-Action -->
        <div class="w-full md:w-1/2 text-white p-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to MCA Gateway</h1>
            <p class="text-xl md:text-2xl font-semibold mb-6">
                Hi, I'm Subhabrata Bhattacharjee, your lead instructor. Welcome to MCA-Gateway, where you can ace <span class="text-yellow-400 text-3xl">JECA</span> with our <span class="text-yellow-400 text-3xl">comprehensive study materials</span>, <span class="text-yellow-400 text-3xl">100+ Mock Tests</span>, <span class="text-yellow-400 text-3xl">live classes</span>, and much more.
            </p>
            
            <?php if ($loggedIn): ?>
                <p class="text-xl mb-6">Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
                <a href="/views/dashboard.php" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300">Go to your Dashboard</a>
            <?php else: ?>
                <p class="text-xl mb-6">Join us to unlock your full potential.</p>
                <a href="/views/signup.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300">Get Started</a>
            <?php endif; ?>
        </div>
    </div>
</div>
