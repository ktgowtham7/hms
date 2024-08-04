<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get data from POST request
  $patientId = $_POST["patientId"];
  $patientName = $_POST["patientName"];
  $totalAmount = $_POST["totalAmount"];
  $amountPaid = $_POST["amountPaid"];
  $balanceAmount = $_POST["balanceAmount"];
  $modeOfPayment = $_POST["modeOfPayment"];
  $transactionId = $_POST["transactionId"];
  $date = $_POST["date"];

  // Prepare SQL statement
  $sql = "INSERT INTO bill_details (patient_id, patient_name, total_amount, amount_paid, balance_amount, mode_of_payment, transaction_id, date)
          VALUES ('$patientId', '$patientName', '$totalAmount', '$amountPaid', '$balanceAmount', '$modeOfPayment', '$transactionId', '$date')";

  // Execute SQL statement
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Close connection
$conn->close();
?>
