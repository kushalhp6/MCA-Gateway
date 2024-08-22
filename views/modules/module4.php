<div class="container mx-auto px-4 py-8">
        <!-- Module 1 Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Module 1</h2>

            <!-- Free Section -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Free Section</h3>
                <ul>
                    <li class="mb-2">
                        <span>Free PDF 1</span>
                        <a href="path_to_pdf1.pdf" class="ml-4 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Download</a>
                    </li>
                    <li>
                        <span>Free PDF 2</span>
                        <a href="path_to_pdf2.pdf" class="ml-4 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none transition-colors">Download</a>
                    </li>
                </ul>
            </div>

            <!-- Premium Section -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Premium Section</h3>

                <?php if ($card_access['Module4'] || $has_full_access): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock1</h4>
                            <a href="../exams/exam.php" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock2</h4>
                            <a href="path_to_mock2.pdf" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock3</h4>
                            <a href="path_to_mock3.pdf" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                        <div class="bg-gray-800 p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            <h4 class="text-lg font-bold mb-2">C Mock4</h4>
                            <a href="path_to_mock4.pdf" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">View</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="bg-red-600 p-6 rounded-lg shadow-lg">
                        <p class="mb-4">Unlock the premium section by purchasing the September card.</p>
                        <a href="dashboard.php" class="bg-yellow-400 text-black py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none transition-colors">Unlock Premium Section</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>