<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'hospital'); // Update database name here
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch doctor data based on email
    $query = "SELECT * FROM doctors WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Doctor found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to dash.html
            $_SESSION["loggedin"] = true; // Set session variable to indicate logged-in status
            header("Location: dash.html");
            exit();
        } else {
            // Password is incorrect, show error message or redirect back to login
            header("Location: login.html"); // Redirect back to login page
            exit();
        }
    } else {
        // No doctor found with the given email, show error message or redirect back to login
        header("Location: login.html"); // Redirect back to login page
        exit();
    }

    // Close statement and connection
    $stmt->close();
    mysqli_close($conn);
}
?>
