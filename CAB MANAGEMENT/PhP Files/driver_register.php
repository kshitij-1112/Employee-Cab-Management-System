<?php
// driver_register.php

// Include the database connection file
include_once('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the registration form
    $driverId = $_POST['driverId'];
    $name = $_POST['name'];
    $cabNumber = $_POST['cabNumber'];
    $contactNumber = $_POST['contactNumber'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate inputs (you can add more validation as needed)
    if (empty($driverId) || empty($name) || empty($cabNumber) || empty($contactNumber) || empty($username) || empty($password)) {
        echo 'Please fill in all the required fields.';
    } else {
        // Hash the password (use a secure hashing algorithm)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query to inse
