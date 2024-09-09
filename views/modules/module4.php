<div class="container mx-auto px-4 py-8">
    <!-- Module 4 Section -->
    <div class="mb-12">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Module 4</h2>

        <!-- Free Section -->
        <div class="mb-10">
            <h3 class="text-2xl font-semibold mb-4 text-gray-700">Free Section</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4">
                <!-- PDF Downloads -->
                <div class="bg-green-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-green-200 transition-all duration-300">
                    <span class="font-medium text-lg text-green-800 mb-2">Software Engineering PDF</span>
                    <a href="/assets/pdfs/software engineering.pdf" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Download</a>
                </div>
            </div>

            <!-- Mock Exams -->
            <div class="mt-8">
                <h4 class="text-xl font-semibold mb-4 text-gray-700">Mock Exams</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-blue-200 transition-all duration-300">
                        <span class="font-medium text-lg text-blue-800 mb-2">Software Engineering Set 1</span>
                        <a href="/views/exams/rules.php?exam_id=se_set_1" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">Start Exam</a>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-blue-200 transition-all duration-300">
                        <span class="font-medium text-lg text-blue-800 mb-2">Machine Learning Set 1</span>
                        <a href="/views/exams/rules.php?exam_id=ml_set_1" class="bg-blue-600 text-white py-2 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300">Start Exam</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Section -->
        <div class="mb-10">
            <h3 class="text-2xl font-semibold mb-4 text-gray-700">Premium Section</h3>
            <?php if ($card_access['Module4'] || $has_full_access): ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-1 gap-4">
                <!-- PDF Downloads -->
                <div class="bg-green-100 p-4 rounded-lg shadow-md flex flex-col items-center transform hover:scale-105 hover:bg-green-200 transition-all duration-300">
                    <span class="font-medium text-lg text-green-800 mb-2">Machine Learning PDF</span>
                    <a href="/assets/pdfs/machine learning.pdf" class="bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition-colors duration-300">Download</a>
                </div>
            </div>

            <!-- Software Engineering Sets -->
            <div class="mb-8 mt-4">
                <h4 class="text-xl font-semibold mb-4 text-gray-700">Software Engineering Sets</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Software Engineering Sets -->
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 2</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_2" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 3</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_3" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 4</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_4" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 5</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_5" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 6</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_6" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 7</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_7" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 8</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_8" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 9</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_9" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Software Engineering Set 10</span>
                        <a href="/views/exams4/rules4.php?exam_id=se_set_10" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                </div>
            </div>

            <!-- Machine Learning Sets -->
            <div class="mb-8">
                <h4 class="text-xl font-semibold mb-4 text-gray-700">Machine Learning Sets</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Machine Learning Sets -->
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 2</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_2" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 3</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_3" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 4</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_4" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 5</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_5" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 6</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_6" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 7</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_7" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 8</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_8" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 9</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_9" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:shadow-xl transition-transform transform hover:scale-105 flex justify-between items-center">
                        <span class="text-lg font-bold text-white">Machine Learning Set 10</span>
                        <a href="/views/exams4/rules4.php?exam_id=ml_set_10" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">Start Exam</a>
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