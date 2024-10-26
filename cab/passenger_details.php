<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .booking-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .booking {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }

        .booking h3 {
            margin-bottom: 10px;
        }

        .booking p {
            margin: 5px 0;
        }

        .booking form {
            display: flex;
            align-items: center;
        }

        .booking form label {
            margin-right: 10px;
            font-weight: bold;
        }

        .booking form input[type="text"] {
            padding: 5px;
            border: 1px solid #cccccc;
            border-radius: 3px;
        }

        .booking form button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .booking form button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <h2>Passenger Details</h2>
    <div class="booking-container">
        <?php
        // Include the database connection
        include('db.php');

        // Start the session
        session_start();

        // Check if driver ID is set in the session
        if(isset($_SESSION['driver_id'])) {
            // Retrieve driver ID from session
            $driver_id = $_SESSION['driver_id'];

            // SQL query to fetch booking details using driver ID
            $sql = "SELECT * FROM booking WHERE driver_id = $driver_id";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are bookings for this driver
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<div class="booking">';
                    echo "<h3>Booking ID: " . $row["booking_id"]. "</h3>";
                    echo "<p>Pickup Date & Time: " . $row["pickup_datetime"]. "</p>";
                    echo "<p>Pickup Location: " . $row["pickup_location"]. "</p>";
                    echo "<p>Drop-off Time: " . $row["dropoff_time"]. "</p>";
                    echo "<p>Drop-off Location: " . $row["dropoff_location"]. "</p>";
                    echo '<form method="post" action="">
                        <label for="otp">Enter OTP:</label>
                        <input type="text" id="otp" name="otp" required>
                        <input type="hidden" name="booking_id" value="' . $row["booking_id"] . '">
                        <button type="submit" name="confirm_ride">Confirm Ride</button>
                    </form>';
                    echo '</div>';

                    // Check if the form is submitted and if OTP is provided
                    if(isset($_POST['confirm_ride']) && isset($_POST['otp'])) {
                        // Sanitize and retrieve form data
                        $otp = sanitizeInput($_POST['otp']);
                        $booking_id = $_POST['booking_id'];

                        // Check if the provided OTP matches with the booking OTP
                        $otp_sql = "SELECT * FROM booking WHERE booking_id = $booking_id AND otp = $otp";
                        $otp_result = $conn->query($otp_sql);

                        // Check if a matching record is found
                        if ($otp_result->num_rows > 0) {
                            // OTP matches, display alert and confirm ride
                            echo "<script>alert('Ride Confirmed!');</script>";
                        } else {
                            // Invalid OTP, display alert
                            echo "<script>alert('Invalid OTP. Please try again.');</script>";
                        }
                    }
                }
            } else {
                echo "<p>No bookings found for this driver.</p>";
            }
        } else {
            echo "<p>Driver ID not found in session.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
