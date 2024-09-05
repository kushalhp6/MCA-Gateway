<?php
session_start(); // Start the session

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home - MCA Gateway</title>
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
