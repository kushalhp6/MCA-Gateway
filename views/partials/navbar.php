<!-- Navbar -->
<nav class="bg-gray-900 text-white border-b border-[#333]">
    <div class="container mx-auto px-4 py-2 flex items-center justify-between">
        <!-- Logo -->
        <a href="/index.php" class="text-2xl font-bold text-[#61afef] hover:text-[#c678dd] transition-colors duration-300">MCA Gateway</a>

        <!-- Hamburger Icon for Mobile -->
        <div class="lg:hidden flex items-center">
            <button id="hamburger-icon" class="text-white focus:outline-none hover:text-[#61afef] transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div id="nav-links" class="hidden lg:flex flex-grow items-center justify-center space-x-4">
            <a href="/index.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Home</a>
            <a href="/views/about.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">About</a>
            <a href="/views/contact.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Contact</a>
            <a href="/views/info.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Info</a>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="/views/dashboard.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Dashboard</a>
                <a href="/views/resources.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Resources</a>
                <a href="/php/logout.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Logout</a>
            <?php else: ?>
                <a href="/views/login.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Login</a>
                <a href="/views/signup.php" class="hover:bg-gray-800 px-4 py-2 rounded transition-colors duration-300">Signup</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-[#1e1e1e] text-white border-t border-[#333] hidden">
        <div class="px-4 py-2">
            <a href="/index.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Home</a>
            <a href="/views/about.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">About</a>
            <a href="/views/contact.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Contact</a>
            <a href="/views/info.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Info</a>

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a href="/views/dashboard.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Dashboard</a>
                <a href="/views/resources.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Resources</a>
                <a href="/php/logout.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Logout</a>
            <?php else: ?>
                <a href="/views/login.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Login</a>
                <a href="/views/signup.php" class="block py-2 px-4 hover:bg-gray-800 transition-colors duration-300">Signup</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('hamburger-icon').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>
