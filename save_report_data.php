<?php
// Database connection details
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "hospital"; // Change this to your database name

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO reports (patient_id, patient_name, test_name, result, report_date) VALUES (:patientId, :patientName, :testName, :result, :reportDate)");

    // Bind parameters
    $stmt->bindParam(':patientId', $_POST['patientId']);
    $stmt->bindParam(':patientName', $_POST['patientName']);
    $stmt->bindParam(':testName', $_POST['testName']);
    $stmt->bindParam(':result', $_POST['result']);
    $stmt->bindParam(':reportDate', $_POST['date']);

    // Execute the statement
    $stmt->execute();

    echo "Report data saved successfully";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn = null;
?>
