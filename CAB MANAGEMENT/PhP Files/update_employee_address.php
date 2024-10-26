<?php
include("db.php"); // Include the database connection file

// Function to update employee address
function updateEmployeeAddress($employeeId, $newAddress)
{
    global $conn;

    // Sanitize user inputs
    $employeeId = sanitizeInput($employeeId);
    $newAddress = sanitizeInput($newAddress);

    // Update employee address in the database
    $query = "UPDATE employees SET employeeAddress='$newAddress' WHERE employeeId='$employeeId'";
    $result = $conn->query($query);

    if ($result) {
        // Update successful
        return true;
    } else {
        // Update failed
        return false;
    }
}

// Sanitize user inputs to prevent SQL injection
function sanitizeInput($input)
{
    global $conn;
    $input = mysqli_real_escape_stri
