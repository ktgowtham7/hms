<?php
// Database connection parameters
$servername = "localhost"; // Server name (default: localhost)
$username = "root"; // MySQL username (default: root)
$password = ""; // MySQL password (default: empty)
$dbname = "hospital"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Extract data from the POST request (assuming form fields are named accordingly)
$doctorId = $_POST['doctorId'];
$name = $_POST['name'];
$department = $_POST['department']; // Added department field
$email = $_POST['email'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// SQL INSERT query to insert data into the "doctor" table
$sql = "INSERT INTO doctor (doctorId, name, department, email, dob, address, phone)
        VALUES ('$doctorId', '$name', '$department', '$email', '$dob', '$address', '$phone')";

// Execute the INSERT query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
