<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <style>
        body{
            background-color: rgb(148, 140, 140); /* Dark blue background */

        }
        .container {
            max-width: 500px;
            margin: 1px auto;
            padding: 20px;
            background-color:  white;/* Set background color to white */
            border: 1px solid #ccc;
            border-radius: 5px;
            color: rgb(2,46,135);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: rgb(2,46,135);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e2e8e2; color:black;
        }
    </style>
    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var date = document.getElementById("date").value;
            var time = document.getElementById("time").value;
            var specialization = document.getElementById("specialization").value;
            var reason = document.getElementById("reason").value;

            if (name == "" || email == "" || phone == "" || date == "" || time == "" || specialization == "" || reason == "") {
                alert("All fields are required");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Book Appointment</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization:</label>
                <select id="specialization" name="specialization" required>
                    <option value="">Select Specialization</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="Neurologist">Neurologist</option>
                    <option value="Orthopedic Surgeon">Orthopedic Surgeon</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Visit:</label>
                <textarea id="reason" name="reason" rows="4" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>

        <?php
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

        // Process form data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $date = $_POST["date"];
            $time = $_POST["time"];
            $specialization = $_POST["specialization"];
            $reason = $_POST["reason"];

            // Insert data into database
            $sql = "INSERT INTO appointments (name, email, phone, date, time, specialization, reason)
                    VALUES ('$name', '$email', '$phone', '$date', '$time', '$specialization', '$reason')";

            if ($conn->query($sql) === TRUE) {
                // Show popup notification
                echo "<script>alert('Appointment booked successfully!');</script>";
                // Redirect to index.html
                echo "<script>window.location = 'index.html';</script>";
                exit; // Make sure to exit after redirection
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
