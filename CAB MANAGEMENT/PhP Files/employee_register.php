<?php
// employee_register.php

// Include the database connection file
include_once('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the registration form
    $employeeId = $_POST['employeeId'];
    $name = $_POST['name'];
    $phoneNo = $_POST['phoneNo'];
    $companyId = $_POST['companyId'];
    $employeeAddress = $_POST['employeeAddress'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs (you can add more validation as needed)
    if (empty($employeeId) || empty($name) || empty($phoneNo) || empty($companyId) || empty($employeeAddress) || empty($username) || empty($password)) {
        echo 'Please fill in all the required fields.';
    } else {
        // Hash the password (use a secure hashing algorithm)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query to insert employee data into the database
        $query = "INSERT INTO employees (employeeId, name, phoneNo, companyId, employeeAddress, username, password) VALUES ('$employeeId', '$name', '$phoneNo', '$companyId', '$employeeAddress', '$username', '$hashedPassword')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            echo 'Registration successful. Redirect to the employee login page.';
            // Redirect to employee login page or perform other actions
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
