<!-- // PHP script to handle forgot password (php/forgot_password_process.php) -->
<?php
include 'db.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $token = bin2hex(random_bytes(50)); // Generate a unique token

    // Prepare SQL query to check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Store token in the database with expiration time
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, NOW() + INTERVAL 1 HOUR)");
        $stmt->bind_param("is", $user_id, $token);
        $stmt->execute();

        // Send email with reset link
        $reset_link = "http://localhost/MCA-Gateway/views/reset_password.php?token=" . $token;
        mail($email, "Password Reset Request", "Click the following link to reset your password: $reset_link");

        echo "A password reset link has been sent to your email.";
    } else {
        echo "No account found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>
