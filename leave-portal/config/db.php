<?php
// Database connection
$host = "localhost";
$user = "root";   // default for XAMPP
$pass = "";       // default empty
$db   = "leave";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
