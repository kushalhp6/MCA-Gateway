<?php
$servername = "localhost";
$username = "root"; // Use your database username
$password = ""; // Use your database password
$dbname = "mca_gateway"; // Use your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
