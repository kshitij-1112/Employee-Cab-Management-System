<?php
// Include the database connection
include('db.php');

// Retrieve the ID of the latest booking
$sql = "SELECT booking_id FROM booking ORDER BY booking_id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $latest_booking_id = $row['booking_id'];

    // Delete the latest booking
    $delete_sql = "DELETE FROM booking WHERE booking_id = $latest_booking_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Booking canceled successfully.";
    } else {
        echo "Error canceling booking: " . $conn->error;
    }
} else {
    echo "No bookings found to cancel.";
}

// Close the database connection
$conn->close();
?>
