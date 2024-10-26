<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            color: red;
        }

        .cancel-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .cancel-link a {
            color: #007bff;
            text-decoration: none;
        }

        .cancel-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Booking Details</h2>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <?php
        // Include the database connection
        include('db.php');

        // Retrieve booking details from the database
        $sql = "SELECT * FROM booking ORDER BY booking_id DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>Pickup Date & Time</td><td>{$row['pickup_datetime']}</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Pickup Location</td><td>{$row['pickup_location']}</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Drop-off Time</td><td>{$row['dropoff_time']}</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Drop-off Location</td><td>{$row['dropoff_location']}</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Driver ID</td><td>{$row['driver_id']}</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>OTP</td><td>{$row['otp']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2' class='no-data'>No booking details found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>

    <div class="cancel-link">
        <a href="cancel_booking.php">Cancel Booking</a>
    </div>
</body>
</html>
