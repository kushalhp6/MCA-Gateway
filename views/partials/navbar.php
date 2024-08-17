
<!-- Navbar -->
<nav class="bg-gray-800 text-white">
    <div class="container mx-auto px-4 py-2 flex items-center justify-between">
        <!-- Logo -->
        <a href="/MCA-Gateway/index.php" class="text-2xl font-bold">MCA Gateway</a>

        <!-- Hamburger Icon for Mobile -->
        <div class="lg:hidden flex items-center">
            <button id="hamburger-icon" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div id="nav-links" class="hidden lg:flex flex-grow items-center justify-center space-x-4">
            <a href="/MCA-Gateway/index.php" class="hover:bg-gray-700 px-4 py-2 rounded">Home</a>
            <a href="/MCA-Gateway/views/about.php" class="hover:bg-gray-700 px-4 py-2 rounded">About</a>
            <a href="/MCA-Gateway/views/contact.php" class="hover:bg-gray-700 px-4 py-2 rounded">Contact</a>
            <a href="/MCA-Gateway/views/info.php" class="hover:bg-gray-700 px-4 py-2 rounded">Info</a>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="/MCA-Gateway/views/dashboard.php" class="hover:bg-gray-700 px-4 py-2 rounded">Dashboard</a>
                <a href="/MCA-Gateway/views/resources.php" class="hover:bg-gray-700 px-4 py-2 rounded">Resources</a>
                <a href="/MCA-Gateway/php/logout.php" class="hover:bg-gray-700 px-4 py-2 rounded">Logout</a>
            <?php else: ?>
                <a href="/MCA-Gateway/views/login.php" class="hover:bg-gray-700 px-4 py-2 rounded">Login</a>
                <a href="/MCA-Gateway/views/signup.php" class="hover:bg-gray-700 px-4 py-2 rounded">Signup</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-gray-800 text-white">
        <div class="px-4 py-2">
            <a href="/MCA-Gateway/index.php" class="block py-2 px-4 hover:bg-gray-700">Home</a>
            <a href="/MCA-Gateway/views/about.php" class="block py-2 px-4 hover:bg-gray-700">About</a>
            <a href="/MCA-Gateway/views/contact.php" class="block py-2 px-4 hover:bg-gray-700">Contact</a>
            <a href="/MCA-Gateway/views/info.php" class="block py-2 px-4 hover:bg-gray-700">Info</a>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="/MCA-Gateway/views/dashboard.php" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a>
                <a href="/MCA-Gateway/views/resources.php" class="block py-2 px-4 hover:bg-gray-700">Resources</a>
                <a href="/MCA-Gateway/php/logout.php" class="block py-2 px-4 hover:bg-gray-700">Logout</a>
            <?php else: ?>
                <a href="/MCA-Gateway/views/login.php" class="block py-2 px-4 hover:bg-gray-700">Login</a>
                <a href="/MCA-Gateway/views/signup.php" class="block py-2 px-4 hover:bg-gray-700">Signup</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('hamburger-icon').addEventListener('click', function () {
        const navLinks = document.getElementById('nav-links');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>

</body>
</html>
