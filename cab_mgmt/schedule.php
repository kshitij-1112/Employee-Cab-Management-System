<?php
include("db.php"); // Include the database connection file

// Function to schedule a new cab
function scheduleCab($employeeId, $pickupDateTime, $pickupLocation, $dropoffTime, $dropoffLocation)
{
    global $conn;

    // Sanitize user inputs
    $employeeId = sanitizeInput($employeeId);
    $pickupDateTime = sanitizeInput($pickupDateTime);
    $pickupLocation = sanitizeInput($pickupLocation);
    $dropoffTime = sanitizeInput($dropoffTime);
    $dropoffLocation = sanitizeInput($dropoffLocation);

    // Insert scheduling details into the database
    $query = "INSERT INTO schedules (employeeId, pickupDateTime, pickupLocation, dropoffTime, dropoffLocation)
              VALUES ('$employeeId', '$pickupDateTime', '$pickupLocation', '$dropoffTime', '$dropoffLocation')";
    $result = $conn->query($query);

    if ($result) {
        // Scheduling successful
        return true;
    } else {
        // Scheduling failed
        return false;
    }
}

// Function to retrieve schedule details
function getScheduleDetails($employeeId)
{
    global $conn;

    // Sanitize user input
    $employeeId = sanitizeInput($employeeId);

    // Query to retrieve schedule details for a specific user
    $query = "SELECT * FROM schedules WHERE employeeId='$employeeId'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Return schedule details
        return $result->fetch_assoc();
    } else {
        // No schedule found
        return false;
    }
}
?>
