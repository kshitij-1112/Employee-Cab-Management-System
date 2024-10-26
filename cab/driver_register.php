<?php
// Include the database connection and other necessary configurations
include('db.php');

// Check if the form is submitted
if (isset($_POST['register'])) {
    // Sanitize and retrieve form data
    $driverId = sanitizeInput($_POST['driverId']);
    $driverName = sanitizeInput($_POST['driverName']);
    $cabNumber = sanitizeInput($_POST['cabNumber']);
    $contactNumber = sanitizeInput($_POST['contactNumber']);
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Your SQL query to insert data into the driver table
    $sql = "INSERT INTO driver (driver_id,driver_name, cab_number, contact_number, username, password) 
            VALUES ('$driverId','$driverName', '$cabNumber', '$contactNumber', '$username', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to schedule.html upon successful registration
        header('Location: driver_login.html');
        exit();
    } else {
        echo "Error adding record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
