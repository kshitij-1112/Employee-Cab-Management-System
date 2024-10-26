<?php
// Include the database connection and other necessary configurations
include('db.php');

// Start the session
session_start();

// Check if the form is submitted
if (isset($_POST['login'])){
    // Sanitize and retrieve form data
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Your SQL query to check login credentials (replace with your logic)
    $sql = "SELECT * FROM employee WHERE username = '$username' AND password = '$password'";
    
    // Execute the query
    $result = $conn->query($sql);

    // Check if a matching record is found
    if ($result->num_rows > 0) {
        // Fetch the user data
        $user_data = $result->fetch_assoc();
        
        // Store user data in session variables
        $_SESSION['employee_id'] = $user_data['employee_id'];
        // Add other user-related data to session if needed
        
        // Redirect to schedule.html or any other page after successful login
        header("Location: schedule.html");
        exit(); // Ensure that the script stops execution after the redirect
    } else {
        echo "Invalid login credentials";
    }

    // Close the database connection
    $conn->close();
}
?>
