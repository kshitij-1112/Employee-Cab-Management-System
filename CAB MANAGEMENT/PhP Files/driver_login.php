<?php
// driver_login.php

// Include the database connection file
include_once('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs (you can add more validation as needed)
    if (empty($username) || empty($password)) {
        echo 'Please enter both username and password.';
    } else {
        // Query to retrieve driver data from the database
        $query = "SELECT * FROM drivers WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Check if a matching record is found
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Verify the password
                if (password_verify($password, $row['password'])) {
                    echo 'Driver login successful. Redirect to the driver dashboard.';
                    // Redirect to the driver dashboard or perform other actions
                } else {
                    echo 'Incorrect password. Please try again.';
                }
            } else {
                echo 'Driver not found. Please check your username.';
            }
        } else {
            echo 'Error in query: ' . mysqli_error($connection);
        }

        // Close the database connection
        mysqli_close($connection);
    }
} else {
    // Handle cases where the form is not submitted properly
    echo 'Invalid request.';
}
?>
