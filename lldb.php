<?php
include_once 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard</title>
    <link rel="stylesheet" href="styles.css">
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

        .dropdown-menu {
            background: linear-gradient(135deg, #2A2F44, #5B4C69);
            color: white;
            border: 1px solid #4a5f86;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

    </style>
</head>
<body>
    <div class="sidebar">
        <div class="URent">
            <img src="urentlogo.png" alt="logo Image">
            <p class="logo-text">URent</p>
        </div>
        <ul>
            <li><a href="lldb.php" class="active">Dashboard</a></li>
            <li><a href="llmb.php">Report</a></li>
            <li><a href="tenants.php">Tenants</a></li>
        </ul>
    </div>

    <div class="main-content">
    <h2>Tenants</h2>
        <!-- Dropdown in the top right corner -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="user icon.png" alt="Profile Image" alt width= "35" height="35" class="rounded circle">
                <p><?php echo $_SESSION['user'];?></p>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#accountModal">Profile</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a></li>
                <li><a class="dropdown-item" href="lllogout.php">Sign Out</a></li>
            </ul>
        </div>

        <!-- Account Modal -->
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
                                <small>Last Name <span class="text-danger">*</span></small>
                                <input name="lastname" required type="text" class="form-control">
                            </div>
                            <div class="col">
                                <small>First Name <span class="text-danger">*</span></small>
                                <input name="firstname" required type="text" class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <small>Contact No. <span class="text-danger">*</span></small>
                                <input name="contact" required type="number" class="form-control">
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
                        <button type="submit" id="update_account" name="update_account" class="button">Update Account</button>
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
                <form>
                <div class="mb-2">
                        <label for="newPassword" class="form-label">Current Password <span class="text-danger">*</span></label>
                        <input id="newPassword" name="password" type="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="newPassword" class="form-label">New Password <span class="text-danger">*</span></label>
                        <input id="newPassword" name="password" type="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="newPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input id="newPassword" name="password" type="password" class="form-control" required>
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

        <!-- Top Cards Section -->
        <div class="top-cards">
            <div class="card">
                <h3>Rent Received</h3>
                <p>₱<?php echo '___'; // Placeholder ?></p>
                <p><?php echo '__'; ?> Unpaid</p>
            </div>
            <div class="card">
                <h3>Overdue Rent</h3>
                <p>₱<?php echo '___'; // Placeholder ?></p>
                <p><?php echo '__'; ?> Overdue</p>
            </div>
            <div class="card">
                <h3>Utility Expenses</h3>
                <p>₱<?php echo '___'; // Placeholder ?></p>
                <p><?php echo '__'; ?> Unpaid</p>
            </div>
        </div>

        <div class="content-container">
            <!-- Charts Section -->
            <div class="chart-section">
                <div class="chart-row">
                    <div class="chart-container">
                        <canvas id="electricityUsageChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="waterUsageChart"></canvas>
                    </div>
                </div>
                <div class="chart-row">
                    <div class="chart-container">
                        <canvas id="utilitiesCostChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="estimatedChangeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tenant Requests Section -->
            <div class="tenant-requests">
                <h3>Tenant Request</h3>
                <ul>
                    <li>ROOM 1 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                    <li>ROOM 2 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                    <li>ROOM 3 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                    <li>ROOM 4 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
