<div class="container mx-auto px-4 py-8">
    <!-- Module 2 Section -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Module 2</h2>

        <!-- Free Section -->
        <div class="mb-10">
            <h3 class="text-2xl font-semibold mb-4 text-gray-700">Free Section</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <!-- PDF Downloads -->
                <div class="bg-green-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-green-200 transition-all duration-300">
                    <span class="font-medium text-lg text-green-800 mb-2">DSA PDF</span>
                    <a href="/assets/pdfs/data structure.pdf" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Download</a>
                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-green-200 transition-all duration-300">
                    <span class="font-medium text-lg text-green-800 mb-2">Architecture PDF</span>
                    <a href="/assets/pdfs/architecture.pdf" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Download</a>
                </div>
                <div class="bg-green-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-green-200 transition-all duration-300">
                    <span class="font-medium text-lg text-green-800 mb-2">Operating System PDF</span>
                    <a href="/assets/pdfs/Operating System.pdf" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Download</a>
                </div>
            </div>

            <!-- Mock Exams -->
            <div class="mt-8">
                <h4 class="text-xl font-semibold mb-4 text-gray-700">Mock Exams</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-blue-200 transition-all duration-300">
                        <span class="font-medium text-lg text-blue-800 mb-2">DSA Set 1</span>
                        <a href="/views/exams/rules.php?exam_id=dsa_set_1" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">Start Exam</a>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-blue-200 transition-all duration-300">
                        <span class="font-medium text-lg text-blue-800 mb-2">Architecture Set 1</span>
                        <a href="/views/exams/rules.php?exam_id=architecture_set_1" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">Start Exam</a>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-blue-200 transition-all duration-300">
                        <span class="font-medium text-lg text-blue-800 mb-2">OS Set 1</span>
                        <a href="/views/exams/rules.php?exam_id=os_set_1" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">Start Exam</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Section -->
        <div class="mb-10">
            <h3 class="text-2xl font-semibold mb-4 text-gray-700">Premium Section</h3>
            <?php if ($card_access['Module2'] || $has_full_access): ?>

            <!-- DSA Sets -->
            <div class="mb-8">
                <h4 class="text-xl font-semibold mb-4 text-gray-700">DSA Sets</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- DSA Sets -->
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 2</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_2" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 3</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_3" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 4</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_4" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 5</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_5" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 6</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_6" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 7</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_7" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 8</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_8" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 9</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_9" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">DSA Set 10</span>
                        <a href="/views/exams2/rules2.php?exam_id=dsa_set_10" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                </div>
            </div>

            <!-- Architecture Sets -->
            <div class="mb-8">
                <h4 class="text-xl font-semibold mb-4 text-gray-700">Architecture Sets</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Architecture Sets -->
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 2</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_2" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 3</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_3" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 4</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_4" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 5</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_5" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 6</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_6" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 7</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_7" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 8</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_8" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 9</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_9" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Architecture Set 10</span>
                        <a href="/views/exams2/rules2.php?exam_id=architecture_set_10" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                </div>
            </div>

            <!-- OS Sets -->
            <div class="mb-8">
                <h4 class="text-xl font-semibold mb-4 text-gray-700">OS Sets</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- OS Sets -->
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 2</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_2" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 3</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_3" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 4</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_4" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 5</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_5" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 6</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_6" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 7</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_7" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 8</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_8" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 9</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_9" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">OS Set 10</span>
                        <a href="/views/exams2/rules2.php?exam_id=os_set_10" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
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
</div>