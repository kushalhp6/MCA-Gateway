<?php
session_start(); // Start the session
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $whatsapp = htmlspecialchars(trim($_POST['whatsapp']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/signup.php?error=invalid_email");
        exit();
    }

    // Validate WhatsApp number format (10 digits)
    if (!preg_match("/^\d{10}$/", $whatsapp)) {
        header("Location: ../views/signup.php?error=invalid_whatsapp");
        exit();
    }

    // Check if the email already exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    if ($stmt === false) {
        header("Location: ../views/signup.php?error=db_error");
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists
        header("Location: ../views/signup.php?error=email_exists");
        exit();
    }

    // Email does not exist, proceed with registration
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, whatsapp, password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        header("Location: ../views/signup.php?error=db_error");
        exit();
    }
    $stmt->bind_param("ssss", $name, $email, $whatsapp, $hashed_password);

    if ($stmt->execute()) {
        // Registration successful, redirect to login
        header("Location: ../views/login.php?message=signup_success");
        exit();
    } else {
        // Registration failed due to database error
        header("Location: ../views/signup.php?error=signup_failed");
        exit();
    }

    // Clean up
    $stmt->close();
    $conn->close();
}
?>
