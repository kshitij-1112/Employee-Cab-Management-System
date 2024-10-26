<?php
include("db.php"); // Include the database connection file

// Function to authenticate user login
function loginUser($username, $password)
{
    global $conn;

    // Sanitize user inputs
    $username = sanitizeInput($username);
    $password = sanitizeInput($password);

    // Hash the password (you may use a more secure method)
    $hashedPassword = md5($password);

    // Query to check if the user exists
    $query = "SELECT * FROM users WHERE username='$username' AND password='$hashedPassword'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // User found, return user details
        $user = $result->fetch_assoc();
        return $user;
    } else {
        // User not found
        return false;
    }
}

// Function to register a new user
function registerUser($employeeId, $name, $phoneNo, $companyId, $employeeAddress, $username, $password)
{
    global $conn;

    // Sanitize user inputs
    $employeeId = sanitizeInput($employeeId);
    $name = sanitizeInput($name);
    $phoneNo = sanitizeInput($phoneNo);
    $companyId = sanitizeInput($companyId);
    $employeeAddress = sanitizeInput($employeeAddress);
    $username = sanitizeInput($username);
    $password = sanitizeInput($password);

    // Hash the password (you may use a more secure method)
    $hashedPassword = md5($password);

    // Insert new user into the database
    $query = "INSERT INTO users (employeeId, name, phoneNo, companyId, employeeAddress, username, password)
              VALUES ('$employeeId', '$name', '$phoneNo', '$companyId', '$employeeAddress', '$username', '$hashedPassword')";
    $result = $conn->query($query);

    if ($result) {
        // User registration successful
        return true;
    } else {
        // Registration failed
        return false;
    }
}

// Function to check if a user is already logged in
function isLoggedIn()
{
    return isset($_SESSION['user']);
}
?>
