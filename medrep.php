<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Details</title>
  <style>
    /* Global styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    h2 {
      color: #333;
    }

    /* Button styles */
    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-bottom: 10px;
    }

    button:hover {
      background-color: #45a049;
    }

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      border-radius: 5px;
    }

    /* Form styles */
    .modal-content input[type="text"],
    .modal-content input[type="date"],
    .modal-content textarea {
      width: calc(100% - 20px);
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .modal-content input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    .modal-content input[type="submit"]:hover {
      background-color: #45a049;
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border: 1px solid #ddd; /* Add border style for the table */
    }

    th, td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Delete and Update button styles */
    .action-buttons button {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      border-radius: 4px;
    }

    .action-buttons button:hover {
      background-color: #d32f2f;
    }

    /* Search bar styles */
    .search-container {
      float: right;
      margin-bottom: 10px;
    }

    .search-container input[type="text"] {
      padding: 10px;
      margin-right: 5px;
      border-radius: 4px;
      border: 1px solid #ccc;
      background-color: #ccc; /* Grey background color */
    }

    .search-container button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .search-container button:hover {
      background-color: #0056b3;
    }

    /* Custom styling for Medicine and Report sections */
    .details-header {
      background-color: #0056b3; /* Blue background color */
      color: white;
      padding: 20px;
      text-align: center;
      margin-bottom: 20px; /* Add margin to bottom */
    }

    .table-container {
      margin-bottom: 20px; /* Add margin to bottom */
    }
  </style>
</head>
<body>

<h2 class="details-header">Medicine Details</h2>
<div class="search-container">
  <input type="text" placeholder="Search...">
  <button type="button">Search</button>
</div>
<button onclick="openMedicineModal()" style="margin-left: 5%;">Add Medicine Details</button>
<div class="table-container">
  <table id="medicineTable">
    <tr>
      <th>Patient ID</th>
      <th>Date</th>
      <th>Medicine Name</th>
      <th>Dosage</th>
      <th>Frequency</th>
      <th>Action</th>
    </tr>
  </table>
</div>

<div id="medicineModal" class="modal">
  <div class="modal-content">
    <span onclick="closeMedicineModal()" style="float:right">&times;</span>
    <h3 style="text-align: center;">Add Medicine Details</h3>
    <form id="addMedicineForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <input type="hidden" name="addMedicine" value="true">
      <label for="patientId">Patient ID:</label><br>
      <input type="text" id="patientId" name="patientId" required><br>

      <label for="date">Date:</label><br>
      <input type="date" id="date" name="date" required><br>

      <label for="medicineName">Medicine Name:</label><br>
      <input type="text" id="medicineName" name="medicineName" required><br>

      <label for="dosage">Dosage:</label><br>
      <input type="text" id="dosage" name="dosage" required><br>

      <label for="frequency">Frequency:</label><br>
      <input type="text" id="frequency" name="frequency" required><br>

      <input type="submit" value="Submit">
    </form>
  </div>
</div>

<h2 class="details-header">Report Details</h2>
<div class="search-container">
  <input type="text" placeholder="Search...">
  <button type="button">Search</button>
</div>
<button onclick="openReportModal()" style="margin-left: 5%;">Add Report Details</button>
<div class="table-container">
  <table id="reportTable">
    <tr>
      <th>Patient ID</th>
      <th>Date</th>
      <th>Report Name</th>
      <th>Type of Test</th>
      <th>Result</th>
      <th>Action</th>
    </tr>
  </table>
</div>

<div id="reportModal" class="modal">
  <div class="modal-content">
    <span onclick="closeReportModal()" style="float:right">&times;</span>
    <h3 style="text-align: center;">Add Report Details</h3>
    <form id="addReportForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <input type="hidden" name="addReport" value="true">
      <label for="reportPatientId">Patient ID:</label><br>
      <input type="text" id="reportPatientId" name="reportPatientId" required><br>

      <label for="reportDate">Date:</label><br>
      <input type="date" id="reportDate" name="reportDate" required><br>

      <label for="reportName">Report Name:</label><br>
      <input type="text" id="reportName" name="reportName" required><br>

      <label for="typeOfTest">Type of Test:</label><br>
      <input type="text" id="typeOfTest" name="typeOfTest" required><br>

      <label for="result">Result:</label><br>
      <textarea id="result" name="result" rows="4" required></textarea><br>

      <input type="submit" value="Submit">
    </form>
  </div>
</div>

<script>
// JavaScript to open and close medicine modal
function openMedicineModal() {
  document.getElementById("medicineModal").style.display = "block";
}

function closeMedicineModal() {
  document.getElementById("medicineModal").style.display = "none";
}

// JavaScript to handle form submission for medicine
document.getElementById("addMedicineForm").onsubmit = function(event) {
  event.preventDefault(); // Prevent the form from submitting normally
  // Get form data
  var patientId = document.getElementById("patientId").value;
  var date = document.getElementById("date").value;
  var medicineName = document.getElementById("medicineName").value;
  var dosage = document.getElementById("dosage").value;
  var frequency = document.getElementById("frequency").value;
  // Create a new row in the medicine table to display the submitted medicine data
  var table = document.getElementById("medicineTable");
  var newRow = table.insertRow();
  newRow.innerHTML = "<td>" + patientId + "</td><td>" + date + "</td><td>" + medicineName + "</td><td>" + dosage + "</td><td>" + frequency + "</td>";
  newRow.appendChild(createActionButtons(newRow)); // Append action buttons to the row
  // Close the medicine modal
  closeMedicineModal();
};

// JavaScript to open and close report modal
function openReportModal() {
  document.getElementById("reportModal").style.display = "block";
}

function closeReportModal() {
  document.getElementById("reportModal").style.display = "none";
}

// JavaScript to handle form submission for report
document.getElementById("addReportForm").onsubmit = function(event) {
  event.preventDefault(); // Prevent the form from submitting normally
  // Get form data
  var patientId = document.getElementById("reportPatientId").value;
  var date = document.getElementById("reportDate").value;
  var reportName = document.getElementById("reportName").value;
  var typeOfTest = document.getElementById("typeOfTest").value;
  var result = document.getElementById("result").value;
  // Create a new row in the report table to display the submitted report data
  var table = document.getElementById("reportTable");
  var newRow = table.insertRow();
  newRow.innerHTML = "<td>" + patientId + "</td><td>" + date + "</td><td>" + reportName + "</td><td>" + typeOfTest + "</td><td>" + result + "</td>";
  newRow.appendChild(createActionButtons(newRow)); // Append action buttons to the row
  // Close the report modal
  closeReportModal();
};

// Function to create action buttons for each row
function createActionButtons(row) {
  var actionButtons = document.createElement("div");
  actionButtons.classList.add("action-buttons");
  
  var deleteButton = document.createElement("button");
  deleteButton.innerHTML = "Delete";
  deleteButton.onclick = function() {
    var rowIndex = row.rowIndex;
    row.parentNode.removeChild(row);
  };
  actionButtons.appendChild(deleteButton);

  var updateButton = document.createElement("button");
  updateButton.innerHTML = "Update";
  updateButton.onclick = function() {
    var cells = row.getElementsByTagName("td");
    var inputs = [];
    for (var i = 0; i < cells.length; i++) { // Exclude last cell (Action)
      var input = document.createElement("input");
      input.type = "text";
      input.value = cells[i].innerHTML.trim();
      cells[i].innerHTML = "";
      cells[i].appendChild(input);
      inputs.push(input);
    }

    // Save button functionality
    var saveButton = document.createElement("button");
    saveButton.innerHTML = "Save";
    saveButton.onclick = function() {
      for (var i = 0; i < inputs.length; i++) {
        cells[i].innerHTML = inputs[i].value.trim();
      }
      actionButtons.removeChild(saveButton);
      actionButtons.appendChild(updateButton);
    };

    actionButtons.removeChild(updateButton);
    actionButtons.appendChild(saveButton);
  };
  actionButtons.appendChild(updateButton);

  return actionButtons;
}
</script>

</body>
</html>
