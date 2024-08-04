<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hospital Bill</title>
<style>
    /* CSS styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        color: #333;
    }
    form {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="number"],
    input[type="date"],
    button {
        padding: 8px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Hospital Bill</h2>
    <form id="billForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="patientId">Patient ID:</label>
        <input type="text" id="patientId" name="patientId" required>
        
        <label for="patientName">Patient Name:</label>
        <input type="text" id="patientName" name="patientName" required>
        
        <label for="mobileNumber">Mobile Number:</label>
        <input type="text" id="mobileNumber" name="mobileNumber" required>
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        
        <table id="servicesTable">
            <tr>
                <th>Service Name</th>
                <th>Cost</th>
            </tr>
            <tr>
                <td><input type="text" name="service_name[]" required></td>
                <td><input type="number" name="service_cost[]" required></td>
            </tr>
        </table>
        <button type="button" onclick="addService()">Add Service</button>
        <input type="submit" value="Calculate Total">
    </form>

    <!-- Display total cost -->
    <div id="totalCost"></div>

   
    <button onClick="window.print()">Print </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script>
        function addService() {
            var table = document.getElementById("servicesTable");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = '<input type="text" name="service_name[]" required>';
            cell2.innerHTML = '<input type="number" name="service_cost[]" required>';
        }

        function calculateTotal() {
            var total = 0;
            var serviceCostInputs = document.getElementsByName("service_cost[]");
            for (var i = 0; i < serviceCostInputs.length; i++) {
                total += parseFloat(serviceCostInputs[i].value) || 0;
            }
            document.getElementById("totalCost").textContent = "Total Cost: ₹" + total.toFixed(2);
        }

        function printPDF() {
            var doc = new jsPDF();

            // Add header
            doc.setFontSize(18);
            doc.text("Hospital Bill", 105, 15, { align: "center" });

            // Add patient details
            doc.setFontSize(12);
            doc.text("Patient ID: " + document.getElementById("patientId").value, 20, 30);
            doc.text("Patient Name: " + document.getElementById("patientName").value, 20, 40);
            doc.text("Mobile Number: " + document.getElementById("mobileNumber").value, 20, 50);
            doc.text("Date: " + document.getElementById("date").value, 20, 60);

            // Add services table
            var servicesTable = document.getElementById("servicesTable");
            var data = [];
            for (var i = 1; i < servicesTable.rows.length; i++) {
                var rowData = servicesTable.rows[i].cells;
                var serviceName = rowData[0].getElementsByTagName("input")[0].value;
                var serviceCost = rowData[1].getElementsByTagName("input")[0].value;
                data.push([serviceName, serviceCost]);
            }

            doc.autoTable({
                startY: 70,
                head: [["Service Name", "Cost"]],
                body: data,
                theme: 'grid',
                styles: { cellPadding: 2, fontSize: 10, valign: 'middle', halign: 'center' },
                columnStyles: { 0: { cellWidth: 80 }, 1: { cellWidth: 40 } },
            });

            // Calculate and add total cost
            var totalCost = document.getElementById("totalCost").textContent;
            doc.text(totalCost, 20, doc.autoTable.previous.finalY + 10);

            // Save PDF and open in new tab
            var pdfBlob = doc.output('blob');
            var pdfUrl = URL.createObjectURL(pdfBlob);
            window.open(pdfUrl);
        }

        // Calculate total on form submission
        document.getElementById("billForm").addEventListener("submit", function(event) {
            calculateTotal();
            event.preventDefault(); // Prevent form submission
        });
    </script>
</div>
</body>
</html>
