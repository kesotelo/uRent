<?php
include_once 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Bills</title>
    <link rel="stylesheet" href="llmb.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #addTenantForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .dropdown {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }
        .btn-secondary {
            background-color: transparent; 
            border: none;
            padding: 0;
        }

        .rounded-circle {
            margin-right: 10px; 
            border-radius: 50%; 
        }

        .dropdown-menu {
            background: linear-gradient(135deg, #2A2F44, #5B4C69);
            color: white;
            padding: 10px;
        }
        .dropdown-item {
            color: white;
            background: transparent;
        }

        .dropdown-item:hover {
            background-color: #e68e8ece;
            color: #ffffff;
        }
        .modal-content  {
            background: linear-gradient(135deg, #ccd4e0, #7996c7);
        }
        .button {
             background: linear-gradient(135deg, #2B3544, #4a5f86);
             color: white;
        }
        .btn-success{
            background: linear-gradient(135deg, #2A2F44, #5B4C69);
            color: white;
        }
        .btn-success2{
            background: linear-gradient(135deg, #2B3544, #4a5f86);
            color: white;
        }
        .btn-cancel{
            background: linear-gradient(135deg, #2B3544, #4a5f86);
            color: white;
        }
        .dropdowns-container {
            margin: 20px 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .dropdown-label {
            margin-right: 10px;
            font-weight: bold;
        }
        .btn {
            padding: 8px 12px;
            cursor: pointer;
            background: linear-gradient(135deg, #2B3544, #4a5f86);
            color: white;
            border: none;
            border-radius: 4px;
        }
        .btn.cancel {
            background-color: #f44336;
        }   
                /* Additional styling for sorting icons */
                .sortable {
            cursor: pointer;
        }
        .sortable i {
            margin-left: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="URent">
                <img src="urentlogo.png" alt="logo Image">
                <p class="logo-text">URent</p>
            </div>
            <ul>
            <li class="menu-item">
            <a href="lldb.php" >
                <img src="dashboard.png" alt="Dashboard Icon" class="menu-icon">
                Dashboard
            </a>
        </li>
        <li class="dropdownSide">
                <a class="dropdown-toggleSide">
                    <img src="report.png" alt="Report Icon" class="menu-icon">
                    Report <span class="arrowSide">&#9662;</span>
                </a>
                <ul class="dropdown-menuSide">
                    <li>
                        <a class="dropdown-itemSide" data-action="monthly_report">
                            <img src="monthly.png" alt="Monthly Report Icon" class="menu-icon">
                            Monthly Report
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-itemSide" data-action="transaction_report">
                            <img src="transaction.png" alt="Transaction Report Icon" class="menu-icon">
                            Transaction Report
                        </a>
                    </li>
                </ul>
            </li>
        <li class="menu-item">
            <a href="tenants.php">
                <img src="tenant.png" alt="Tenants Icon" class="menu-icon">
                Tenants
            </a>
        </li>
        <li class="menu-item">
            <a href="messagell.php">
                <img src="messages.png" alt="Messages Icon" class="menu-icon">
                Messages
            </a>
        </li>  
    </ul>
</div>
    <div class="main-content">
        <!-- Dropdown in the top right corner -->
        <div class="top-bar">
            <div class="dropdown" style="display: flex; align-items: center;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background: transparent; width: 75px">
                    <img src="user icon.png" alt="Profile Image" alt width= "40" height="40" class="rounded circle">
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <p style="font-weight: bold; text-align: center; font-size: 20px"><?php echo $_SESSION['user'];?></p>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#accountModal">Profile</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a></li>
                    <li><a class="dropdown-item" href="lllogout.php">Sign Out</a></li>
                </ul>
            </div>
     </div>

        <!-- Account Profile Modal -->
        <div class="modal" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="row mb-1">
                            <div class="col">
                                <small>Username <span class="text-danger">*</span></small>
                                <input name="Username" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <small>Email <span class="text-danger">*</span></small>
                                <input name="aemail" id="" cols="30" rows="3" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="update_account" name="update_account" class="button">Update Profile</button>
                  </div>
                  <div class="modal-footer">
                  <hr class="bg-secondary">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-success" data-bs-toggle="modal" data-bs-target="#createAccounts">Create New Account</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Create new Account -->
    <div class="modal fade" id="createAccounts" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Create New User Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class='bx bx-x' ></i>
                    </button>
                </div>
                <form action="server/queries/query.php" method="post">
                    <div class="modal-body pl-4 pr-4">
                        <div class="row mb-2">
                            <div class="col">
                                <small>Userame <span class="text-danger">*</span></small>
                                <input name="username" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <small>Email Address <span class="text-danger">*</span> <span id="emailBadge"></span></small>
                                <input name="email" id="txt_email" required type="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="create_account" name="create-account" class="btn-success2">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Change Password Modal -->
<div class="modal" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action = 'llchangepass.php' method ='post'>
                <div class="mb-2">
                        <label for="newPassword" class="form-label">Current Password <span class="text-danger">*</span></label>
                        <input id="newPassword" name="password" type="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="newPassword" class="form-label">New Password <span class="text-danger">*</span></label>
                        <input id="newPassword" name="newpassword" type="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="newPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input id="newPassword" name="conpassword" type="password" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="button">Update Password</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="main-content2">
        <div id="bills-section" style="display:none;">
            <h2>Monthly Report</h2>
    <!-- Dropdowns for selecting month and year -->
    <label for="yearSelect">Select Year:</label>
    <select id="yearSelect" class="form-select"></select>

    <label for="monthSelect">Select Month:</label>
    <select id="monthSelect" class="form-select">
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>

    <!-- Add Tenant Button -->
    <button id="addTenantButton" class="btn">Add Tenant</button>

    <!-- Monthly Report Table -->
    <table id="bills-table">
        <thead>
            <tr>
            <th class="sortable" onclick="sortTable('tenant_name')">Tenant Name <i class="sort-icon"></i></th>
            <th class="sortable" onclick="sortTable('room_number')">Room Number <i class="sort-icon"></i></th>
                <th>Electricity</th>
                <th>Water</th>
                <th>Rental</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Rows will be populated here by JavaScript -->
        </tbody>
    </table>

    <!-- Overlay and Add Tenant Form -->
    <!-- Add Tenant Form -->
    <div id="overlay"></div>
    <div id="addTenantForm">
        <h3>Add Tenant</h3>
        <label for="tenantName">Tenant Name:</label>
        <input type="text" id="tenantName" required>

        <label for="roomNumber">Room Number:</label>
        <input type="number" id="roomNumber" required>

        <br><br>
        <button id="submitTenant" class="btn">Submit</button>
        <button id="cancelForm" class="btn cancel">Cancel</button>
    </div>
</div>

        <div id="report-section" style="display:none;">
            <h2>Transaction Report</h2>
            <table id="report-table">
    <thead>
        <tr>
            <th>Room Number</th>
            <th>Tenant Name</th>
            <th>Bill Type</th>
            <th>Amount Paid</th>
            <th>Date Paid</th>
            <th>Proof of Payment</th>
        </tr>
    </thead>
    <tbody>
        <!-- Rows will be dynamically inserted here -->
    </tbody>
</table>
<div class="row1">
    <div class="col">
        <input type="text" id="report-section" class="form-control" placeholder="🔎 Search . . .">
    </div>
</div>
        </div>
    </div>
    <div class="bills-section_length" id="bills_section_length"><label>Show <select name="bills_section_length" aria-controls="bills-section" class=""><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option></select> entries</label></div>
    <script>
        
        const yearSelect = document.getElementById("yearSelect");
        const currentYear = new Date().getFullYear();
        for (let year = 2020; year <= currentYear; year++) {
            const option = document.createElement("option");
            option.value = year;
            option.text = year;
            yearSelect.appendChild(option);
        }

        const tableBody = document.getElementById("tableBody");

function loadTransactionReport() {
    const tableBody = document.querySelector("#report-table tbody");
    tableBody.innerHTML = '';

    fetch('fetch_transactions.php')
        .then(response => response.json())
        .then(transactions => {
            transactions.forEach(transaction => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${transaction.room_number}</td>
                    <td>${transaction.tenant_name}</td>
                    <td>${transaction.bill_type}</td>
                    <td>${transaction.amount_paid}</td>
                    <td>${transaction.date_paid}</td>
                    <td>
                        <a href="uploads/${transaction.proof_of_payment}" target="_blank">
                            View PDF
                        </a>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching transactions:', error);
        });
}

document.querySelectorAll('.dropdown-toggleSide').forEach(item => {
    item.addEventListener('click', function() {
        const dropdownMenu = this.nextElementSibling;
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });
});

document.querySelectorAll('.dropdown-itemSide').forEach(function(item) {
    item.addEventListener('click', function() {
        const action = this.getAttribute('data-action');

        document.getElementById('bills-section').style.display = 'none';
        document.getElementById('report-section').style.display = 'none';

        if (action === 'monthly_report') {
            document.getElementById('bills-section').style.display = 'block';
            loadTable();
        } else if (action === 'transaction_report') {
            document.getElementById('report-section').style.display = 'block';
            loadTransactionReport();
        }
    });
});

document.getElementById('bills-section').style.display = 'block';

let currentSort = {
            column: null,
            ascending: true
        };

        function sortTable(column) {
            const table = document.getElementById("bills-table").getElementsByTagName("tbody")[0];
            const rows = Array.from(table.getElementsByTagName("tr"));

            if (currentSort.column === column) {
                currentSort.ascending = !currentSort.ascending;
            } else {
                currentSort.column = column;
                currentSort.ascending = true;
            }

            const columnIndex = column === 'tenant_name' ? 0 : 1;

            rows.sort((a, b) => {
                const cellA = a.cells[columnIndex].innerText.toLowerCase();
                const cellB = b.cells[columnIndex].innerText.toLowerCase();

                if (cellA < cellB) return currentSort.ascending ? -1 : 1;
                if (cellA > cellB) return currentSort.ascending ? 1 : -1;
                return 0;
            });

            table.innerHTML = "";
            rows.forEach(row => table.appendChild(row));

            document.querySelectorAll('.sort-icon').forEach(icon => icon.innerText = '▲▼');
            const currentIcon = document.querySelectorAll(".sortable")[columnIndex].querySelector('.sort-icon');
            currentIcon.innerText = currentSort.ascending ? '▲' : '▼';
        }


        function populateTable() {
    const tableBody = document.getElementById("tableBody");

    // Fetch data from an API endpoint (adjust URL to your server setup)
    fetch('add_tenant.php') // replace with your actual endpoint
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = ''; // Clear existing rows
            data.forEach(item => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${item.tenant_name}</td>
                    <td>${item.room_number}</td>
                    <td>${item.electricity}</td>
                    <td>${item.water}</td>
                    <td>${item.rental}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });
}


        populateTable();
        document.addEventListener('DOMContentLoaded', () => {
    const addTenantButton = document.getElementById('addTenantButton');
    const addTenantForm = document.getElementById('addTenantForm');
    const overlay = document.getElementById('overlay');
    const cancelFormButton = document.getElementById('cancelForm');

    addTenantButton.addEventListener('click', () => {
        addTenantForm.style.display = 'block';
        overlay.style.display = 'block';
    });

    overlay.addEventListener('click', closeForm);
    cancelFormButton.addEventListener('click', closeForm);

    function closeForm() {
        addTenantForm.style.display = 'none';
        overlay.style.display = 'none';
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const submitTenantButton = document.getElementById('submitTenant');

    submitTenantButton.addEventListener('click', () => {
        const tenantName = document.getElementById('tenantName').value;
        const roomNumber = document.getElementById('roomNumber').value;

        if (!tenantName || !roomNumber) {
            alert("Please fill out all fields.");
            return;
        }

        fetch('add_tenant.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `tenant_name=${encodeURIComponent(tenantName)}&room_number=${encodeURIComponent(roomNumber)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Tenant added successfully!');
                document.getElementById('addTenantForm').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
                loadTable();
            } else {
                alert('Error adding tenant: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding tenant.');
        });
    });
});

        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lldbs2ssss.js"></script>
</body>
</html>