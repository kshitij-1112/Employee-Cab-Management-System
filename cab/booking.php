<?php
// Include the database connection and other necessary configurations
include('db.php');

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["schedule"])) {
    // Retrieving form data
    $pickupDateTime = $_POST["pickupDateTime"];
    $pickupLocationType = $_POST["pickupLocation"];
    $dropoffTime = $_POST["dropoffTime"];
    $dropoffLocationType = $_POST["dropoffLocation"];
    
    // Retrieving logged-in employee's ID
    if(isset($_SESSION['employee_id'])) {
        $employee_id = $_SESSION['employee_id'];
    } else {
        echo "Employee ID not found.";
        exit();
    }

    // Function to retrieve address based on location type
    function getAddress($locationType, $locationId, $conn) {
        if ($locationType === "employeeAddress") {
            $result = $conn->query("SELECT employee_address FROM employee WHERE employee_id = $locationId");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["employee_address"];
            } else {
                return "Employee address not found.";
            }
        } elseif ($locationType === "companyAddress") {
            $result = $conn->query("SELECT company_address FROM company WHERE company_id = $locationId");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row["company_address"];
            } else {
                return "Company address not found.";
            }
        } else {
            return "Invalid location type.";
        }
    }
    
    // Retrieving pickup address
    if ($pickupLocationType === "employeeAddress") {
        // Using logged-in employee's ID
        $pickupLocation = getAddress($pickupLocationType, $employee_id, $conn);
    } elseif ($pickupLocationType === "companyAddress") {
        $pickupLocationId = 1; // Assuming you have the company's ID stored somewhere, replace with actual ID
        $pickupLocation = getAddress($pickupLocationType, $pickupLocationId, $conn);
    } else {
        $pickupLocation = "Invalid pickup location type.";
    }
    
    // Retrieving dropoff address
    if ($dropoffLocationType === "employeeAddress") {
        // Using logged-in employee's ID
        $dropoffLocation = getAddress($dropoffLocationType, $employee_id, $conn);
    } elseif ($dropoffLocationType === "companyAddress") {
        $dropoffLocationId = 1; // Assuming you have the company's ID stored somewhere, replace with actual ID
        $dropoffLocation = getAddress($dropoffLocationType, $dropoffLocationId, $conn);
    } else {
        $dropoffLocation = "Invalid dropoff location type.";
    }
    
    // Generating random driver ID
    $result = $conn->query("SELECT driver_id FROM driver ORDER BY RAND() LIMIT 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $driver_id = $row["driver_id"];
    } else {
        echo "No drivers available.";
        exit();
    }
    
    // Generating random OTP
    $otp = rand(1000, 9999);
    
    // Inserting values into the booking table
    $sql = "INSERT INTO booking (pickup_datetime, pickup_location, dropoff_time, dropoff_location, driver_id, otp) VALUES ('$pickupDateTime', '$pickupLocation', '$dropoffTime', '$dropoffLocation', '$driver_id', '$otp')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to display_booking.html after successful booking
        header("Location: display_booking.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
}
?>
