<?php
$servername = "localhost";
$username = "u244372497_mca_gateway"; // Use your database username
$password = "|9d+/?~tR"; // Use your database password
$dbname = "u244372497_mca_gateway"; // Use your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
