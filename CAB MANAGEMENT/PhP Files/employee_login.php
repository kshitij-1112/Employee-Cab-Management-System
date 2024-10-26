<?php
// employee_login.php

// Include the database connection file
include_once('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs (you can add more validation as needed)
    if (empty($username) || empty($password)) {
        echo 'Please enter both username and password.';
    } else {
        // Hash the password (use a secure hashing algorithm)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query to check if the user exists in the database
        $query = "SELECT * FROM employees WHERE username = '$username'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Check if a row is returned
            if (mysqli_num_rows($result) == 1) {
                // Fetch the user data
                $user = mysqli_fetch_assoc($result);

                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Password is correct, you can proceed with login
                    echo 'Login successful. Redirect to the employee dashboard.';
                    // Redirect to employee dashboard or perform other actions
                } else {
                    echo 'Incorrect password.';
                }
            } else {
                echo 'User not found.';
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
