<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay - MCA Gateway</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <?php include 'partials/navbar.php'; 
?>
    <div class="container mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- QR Code Section -->
        <div class="flex justify-center items-center">
            <img src="../assets/images/QR.jpg" alt="PhonePe QR Code" class="w-64 h-64">
        </div>

        <!-- Instructions Section -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6">Payment Instructions</h2>
            <p class="mb-4">
                1. Scan the QR code using your PhonePe app or any payment app.
            </p>
            <p class="mb-4">
                2. Ensure the account name is <span class="font-bold">Subhabrata Bhattacharjee</span>.
            </p>
            <p class="mb-4">
                3. Complete the payment.
            </p>
            <p class="mb-4">
                4. After the payment, send an email with the following details:
                <ul class="list-disc list-inside pl-4">
                    <li>Your Name</li>
                    <li>Your Email</li>
                    <li>Payment Amount</li>
                    <li>Screenshot of the payment</li>
                    <li>What module u r paying for</li>
                </ul>
            </p>
            <p class="mb-4">
                5. Click the "Send" button below to open your default email client and send the email to us. Please wait for us to verify and process your payment.
            </p>
            <a href="mailto:shyamalhp001@gmail.com?subject=Payment%20Verification&body=Please%20include%20your%20name%2C%20email%2C%20payment%20amount%2C%20and%20screenshot%20of%20the%20payment%20in%20this%20email." class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none transition-colors">
                Send
            </a>
        </div>
    </div>
    <?php include 'partials/footer.php'; 
?>
</body>
</html>
