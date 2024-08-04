<?php
// Check if the form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $patientId = $_POST["patientId"];
    $patientName = $_POST["patientName"];
    $medicineName = $_POST["medicineName"];
    $dosage = $_POST["dosage"];
    $frequency = $_POST["frequency"];
    $date = $_POST["date"];

    // Connect to your MySQL database
    $servername = "localhost"; // Change this to your MySQL server address
    $username = "root"; // Change this to your MySQL username
    $password = ""; // Change this to your MySQL password
    $dbname = "hospital"; // Change this to your MySQL database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO medicines (patientId, patientName, medicineName, dosage, frequency, date)
    VALUES ('$patientId', '$patientName', '$medicineName', '$dosage', '$frequency', '$date')";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
