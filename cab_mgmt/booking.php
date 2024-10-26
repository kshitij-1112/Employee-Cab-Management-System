<?php
// Include the database connection and other necessary configurations
include('db.php');

// Check if the form is submitted
if (isset($_POST['schedule'])) {
    // Sanitize and retrieve form data
    $pickupDateTime = sanitizeInput($_POST['pickupDateTime']);
    $pickupLocation = sanitizeInput($_POST['pickupLocation']);
    $dropoffTime = sanitizeInput($_POST['dropoffTime']);
    $dropoffLocation = sanitizeInput($_POST['dropoffLocation']);

    // Your SQL query to insert data into the booking table
    $sql = "INSERT INTO booking (pickup_datetime, pickup_location, dropoff_time, dropoff_location) 
            VALUES ('$pickupDateTime', '$pickupLocation', '$dropoffTime', '$dropoffLocation')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Booking scheduled successfully";
    } else {
        echo "Error scheduling booking: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
