<?php
// Database connection parameters
$servername = "localhost";  // Use "localhost" since you're using XAMPP
$username = "root";         // Default username for XAMPP
$password = "";             // Default password for XAMPP
$database = "emp_cab_mgmt"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitizeInput($input)
{
    global $conn;
    return mysqli_real_escape_string($conn, $input);
}
?>
