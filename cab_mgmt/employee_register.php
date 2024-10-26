<?php
// Include the database connection and other necessary configurations
include('db.php');

// Check if the form is submitted
if (isset($_POST['register'])) {
    // Sanitize and retrieve form data
    $employeeId = sanitizeInput($_POST['employeeId']);
    $name = sanitizeInput($_POST['name']);
    $companyId = sanitizeInput($_POST['companyId']);
    $employeeAddress = sanitizeInput($_POST['employeeAddress']);
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Your SQL query to insert data into the employee table
    $sql = "INSERT INTO employee (employee_id, employee_name, company_id, employee_address, username, password) 
            VALUES ('$employeeId', '$name', '$companyId', '$employeeAddress', '$username', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully";

        // Redirect to the schedule.html page
        //header("Location: schedule.html");
        exit(); // Make sure to stop further execution after redirection
    } else {
        echo "Error adding record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
