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
                <div class="flex space-x-4">
  <!-- Get Started Button -->
  <a href="/views/signup.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300">
    Go to Dashboard
  </a>

  <!-- Join WhatsApp Group Button -->
  <a href="https://chat.whatsapp.com/IFQGZ5Zd7j9DdR5sqGuawj" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300 flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
      <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"></path>
    </svg> 
    Join WhatsApp Group
  </a>
</div>

            <?php else: ?>
                <p class="text-xl mb-6">Join us to unlock your full potential.</p>
                <div class="flex space-x-4">
  <!-- Get Started Button -->
  <a href="/views/signup.php" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300">
    Get Started
  </a>

  <!-- Join WhatsApp Group Button -->
  <a href="https://chat.whatsapp.com/IFQGZ5Zd7j9DdR5sqGuawj" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300 flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2" viewBox="0 0 16 16">
      <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"></path>
    </svg> 
    Join WhatsApp Group
  </a>
</div>


            <?php endif; ?>


        </div>
    </div>
</div>
