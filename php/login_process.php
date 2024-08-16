<?php
session_start(); // Start the session
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Prepare SQL query to fetch user data
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['loggedin'] = true;

            // Redirect to dashboard or home
            header("Location: ../views/dashboard.php");
            exit();
        } else {
            // Incorrect password
            header("Location: ../views/login.php?error=invalid_password");
            exit();
        }
    } else {
        // No user found
        header("Location: ../views/login.php?error=invalid_email");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
