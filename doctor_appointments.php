<?php
// Start PHP code immediately after the opening PHP tag
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete action
if(isset($_POST['delete'])){
    $id = $_POST['id'];
    // Prepared statement for deletion
    $delete_query = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    $delete_query->bind_param("i", $id);
    if ($delete_query->execute() === TRUE) {
        header("Location: ".$_SERVER['PHP_SELF']); // Redirect to the same page
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $delete_query->close();
}

// Rest of the HTML markup goes here...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Appointments</title>
    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0; /* Light gray background */
}

.container {
    max-width: 800px;
    margin: 50px auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color:Lightblue; /* Green background */
    color: black; /* White text */
    font-weight: bold;
}

td button {
    background-color: #ff6666; /* Red background */
    color: white; /* White text */
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
}

td button:hover {
    background-color: #ff4d4d; /* Darker red background on hover */
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Doctor's Appointments</h2>
        <table border='1'>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Specialization</th>
                <th>Reason for Visit</th> <!-- New column for reason for visit -->
                <th>Action</th> <!-- New column for delete button -->
            </tr>
            <?php
            // Retrieve appointments from the database
            $sql = "SELECT id, name, email, phone, date, time, specialization, reason FROM appointments"; // Include reason field
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["name"]."</td>
                            <td>".$row["email"]."</td>
                            <td>".$row["phone"]."</td>
                            <td>".$row["date"]."</td>
                            <td>".$row["time"]."</td>
                            <td>".$row["specialization"]."</td>
                            <td>".$row["reason"]."</td> <!-- Display reason for visit -->
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='id' value='".$row["id"]."'>
                                    <button type='submit' name='delete'>Delete</button>
                                </form>
                            </td> <!-- Delete button -->
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No appointments found</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
