<div class="container mx-auto px-4 py-8">
    <!-- Mock Section -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Mock Tests</h2>

        <!-- Free Section -->
<div class="mb-10">
    <h3 class="text-2xl font-semibold mb-4 text-gray-700">Free Section</h3>
    

    <!-- Mock Exams -->
    <div class="mt-8">
        <h4 class="text-xl font-semibold mb-4 text-gray-700">Mock Exams</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-blue-200 transition-all duration-300">
                <span class="font-medium text-lg text-blue-800 mb-2">Mock 1</span>
                <a href="c_set_1_link" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">Start Exam</a>
            </div>
        </div>
    </div>
</div>


        <!-- Premium Section -->
<div class="mb-10">
    <h3 class="text-2xl font-semibold mb-4 text-gray-700">Premium Section</h3>
    <?php if ($card_access['Mock'] || $has_full_access): ?>

    <!-- Mock Sets -->
    <div class="mb-8">
        <h4 class="text-xl font-semibold mb-4 text-gray-700">Mock Sets</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 2</span>
                <a href="c_set_2_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 3</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 4</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 5</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 6</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 7</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 8</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 9</span>
                <a href="c_set_9_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 10</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 11</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
            <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                <span class="text-lg font-bold text-white">Mock Set 12</span>
                <a href="c_set_3_link" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
            </div>
        </div>
    </div>

    
    
</div>
<?php else: ?>
                    <div class="bg-red-600 p-6 rounded-lg shadow-lg">
                        <p class="mb-4">Unlock the premium section by purchasing the Mock.</p>
                        <a href="/views/dashboard.php" class="bg-yellow-400 text-black py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none transition-colors">Unlock Premium Section</a>
                    </div>
                <?php endif; ?>

    </div>
</div>
