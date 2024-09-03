<div class="relative bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('/assets/images/bg.png');">
        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Dark overlay -->

            <div class="relative z-10 text-center text-white p-6 max-w-3xl mx-auto">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">MCA Gateway</h1>
        
        <?php if ($loggedIn): ?>
            <p class="text-xl mb-4">Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
            <a href="/views/dashboard.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300">Go to your Dashboard</a>
        <?php else: ?>
            <p class="text-xl mb-4">Welcome to our platform. <a href="/views/signup.php" class="text-indigo-400 hover:underline hover:text-blue-600">Sign up</a> or <a href="/views/login.php" class="text-indigo-400 hover:underline hover:text-blue-600">log in</a> to get started.</p>
        <?php endif; ?>
        </div>
    </div>