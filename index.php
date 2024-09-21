<?php
session_start(); // Start the session

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="MCA Gateway offers over 100+ mock tests for JECA aspirants to help them prepare and crack the MCA entrance exam and get into colleges like Jadavpur University. Start preparing now!">
    <meta name="keywords" content="Jeca, mocktests, jeca mocktests, jeca crackers, jeca toppers, Jadavpur University, MCA in Kolkata, MCA entrance, MCA exam, JECA preparation">
    <meta name="author" content="mcagateway.in">
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="mcagateway.in - JECA Mock Tests for Aspirants">
    <meta property="og:description" content="Take over 100+ mock tests for JECA and crack the MCA entrance exam with mcagateway.in. Perfect platform for JECA aspirants aiming for MCA programs in Kolkata.">
    <meta property="og:image" content="/assets/images/image.svg">
    <meta property="og:url" content="https://mcagateway.in">
    <meta property="og:type" content="website">
    
    <title>MCA Gateway - JECA Mock Tests and Preparation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- hero section -->
    <?php 
    include 'views/partials/navbar.php'; 

    include './sections/hero.php'; ?>

    <!-- 1st call to action -->
    <?php include './sections/cta1.php'; ?>


    <!-- features section -->
    <?php include './sections/features.php'; ?>

<!-- testimony section -->
<?php include './sections/testimonials.php'; ?>

<!-- call to action -->
<?php include './sections/cta2.php'; ?>

<!-- FAQ section -->
<?php include './sections/faq.php'; ?>


    <?php include 'views/partials/footer.php'; ?>
</body>
</html>
