<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Address</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="number"],
        input[type="text"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }

        .success {
            color: green;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Employee Address</h2>
        <?php
        // Include the database connection
        include('db.php');

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
            // Retrieve form data
            $employee_id = $_POST["employee_id"];
            $new_address = $_POST["new_address"];

            // Update the address in the employee table
            $sql = "UPDATE employee SET employee_address = '$new_address' WHERE employee_id = $employee_id";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success'>Address updated successfully.</p>";
            } else {
                echo "<p class='error'>Error updating address: " . $conn->error . "</p>";
            }

            // Close the database connection
            $conn->close();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="employee_id">Employee ID:</label><br>
            <input type="number" id="employee_id" name="employee_id" required><br>
            <label for="new_address">New Address:</label><br>
            <input type="text" id="new_address" name="new_address" required><br><br>
            <button type="submit" name="update">Update Address</button>
        </form>
    </div>
</body>
</html>
