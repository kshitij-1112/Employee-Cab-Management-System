<?php
include("db.php"); // Include the database connection file

// Function to schedule a cab
function scheduleCab($employeeId, $pickupDateTime, $pickupLocation, $dropoffTime, $dropoffLocation)
{
    global $conn;

    // Sanitize user inputs
    $employeeId = sanitizeInput($employeeId);
    $pickupDateTime = sanitizeInput($pickupDateTime);
    $pickupLocation = sanitizeInput($pickupLocation);
    $dropoffTime = sanitizeInput($dropoffTime);
    $dropoffLocation = sanitizeInput($dropoffLocation);

    // Insert schedule details into the database
    $query = "INSERT INTO cab_schedule (employeeId, pickupDateTime, pickupLocation, dropoffTime, dropoffLocation) VALUES ('$employeeId', '$pickupDateTime', '$pickupLocation', '$dropoffTime', '$dropoffLocation')";
    $result = $conn->query($query);

    if ($result) {
        // Schedule successful
        return true;
    } else {
        // Schedule failed
        return false;
    }
}

// Sanitize user inputs to prevent SQL injection
function sanitizeInput($input)
{
    global $conn;
    $input = mysqli_real_escape_string($conn, $input);
    return $input;
}
?>
