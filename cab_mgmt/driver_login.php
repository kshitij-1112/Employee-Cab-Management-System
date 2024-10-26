<?php
// Include the database connection and other necessary configurations
include('db.php');

// Check if the form is submitted
if (isset($_POST['login'])) {
    // Sanitize and retrieve form data
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Your SQL query to check login credentials in the driver table
    $sql = "SELECT * FROM driver WHERE username = '$username' AND password = '$password'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if a matching record is found
    if ($result->num_rows > 0) {
        // Redirect to schedule.html upon successful login
        header('Location: passenger_details.html');
        exit();
    } else {
        echo "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>
