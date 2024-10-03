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
        /* Dropdown Position and Style */
        .dropdown {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }
        .btn-secondary {
            background-color: transparent; /* Transparent background */
            border: none; /* Remove border */
            padding: 0; /* Adjust padding if necessary */
        }

        .rounded-circle {
            margin-right: 10px; /* Space between the image and username */
            border-radius: 50%; /* Ensure the image stays rounded */
        }

        .dropdown-menu {
            background: linear-gradient(135deg, #2A2F44, #5B4C69); /* Keep your original gradient */
            color: white;
            padding: 10px; /* Adjust padding if needed */
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
            <table id="bills-table">
                <!-- The table will be populated by JavaScript -->
            </table>
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
<div class="row">
    <div class="col">
        <input type="text" id="report-section" class="form-control" placeholder="🔎 Search . . .">
    </div>
</div>
        </div>
    </div>
    <div class="bills-section_length" id="bills_section_length"><label>Show <select name="bills_section_length" aria-controls="bills-section" class=""><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option></select> entries</label></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lldb.js"></script>
</body>
</html>
