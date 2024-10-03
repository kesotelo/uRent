<?php
session_start();
include_once 'connect.php';

$pendingRequestQuery = "SELECT COUNT(*) as pending_count FROM tenant_requests WHERE status = 'Pending'";
$pendingResult = $conn->query($pendingRequestQuery);
$pendingRequestCount = 0;

if ($pendingResult->num_rows > 0) {
    $pendingRow = $pendingResult->fetch_assoc();
    $pendingRequestCount = $pendingRow['pending_count'];
}

// Add this logic in your lldb.php to handle "Done" button clicks
if (isset($_POST['done_request'])) {
    $request_id = $_POST['request_id'];  // Get the request ID from the form

    // Update the tenant request status to 'Done' in the database
    $update_status_query = "UPDATE tenant_requests SET status = 'Done' WHERE id = '$request_id'";
    if (mysqli_query($conn, $update_status_query)) {
        echo "<script>alert('Request marked as done.'); window.location='lldb.php';</script>";
    } else {
        echo "<script>alert('Error updating request status.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .icon-container {
            position: relative;
            display: inline-block;
        }
        .fa-envelope {
            font-size: 24px;
            color: white; 
        }
        .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 50%;
            font-size: 12px;
        }

        .status-dropdown {
            display: inline-block;
            position: relative;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .badge {
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 50%;
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
        <li class="menu-item">
            <a href="lldb.php" class="active">
                <img src="dashboard.png" alt="Dashboard Icon" class="menu-icon">
                Dashboard
            </a>
        </li>
        <li class="menu-item">
            <a href="llmb.php">
                <img src="report.png" alt="Report Icon" class="menu-icon">
                Report
            </a>
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
        <h2>Dashboard</h2>
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
                                <input name="username" required type="text" class="form-control">
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
                                <small>Username <span class="text-danger">*</span></small>
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

        <!-- Top Cards Section -->
        <div class="top-cards">
            <div class="card">
                <h3>Rent Received</h3>
                <p>₱<?php echo '___';  ?></p>
                <p><?php echo '__'; ?> Unpaid</p>
            </div>
            <div class="card">
                <h3>Overdue Rent</h3>
                <p>₱<?php echo '___';  ?></p>
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

            <div class="tenant-requests">
            <h3 style="display: flex; align-items: center;">
                Tenant Requests
                <div class="icon-container" style="margin-left: 10px;">
                    <i class="fas fa-envelope"></i>
                    <?php if ($pendingRequestCount > 0) { ?>
                        <span class="badge"><?php echo $pendingRequestCount; ?></span>
                    <?php } ?>
                </div>
            </h3>

            <?php
            // Fetch all tenant requests
            $request_query = mysqli_query($conn, "SELECT * FROM tenant_requests WHERE status = 'pending'");


            if (mysqli_num_rows($request_query) > 0) {
                while ($row = mysqli_fetch_assoc($request_query)) {
                    echo "<div class='request-container'>";
                    echo "<p><strong>Room:</strong> " . $row['room_number'] . "</p>";
                    echo "<p><strong>Tenant:</strong> " . $row['tenant_name'] . "</p>";
                    echo "<p><strong>Request:</strong> " . $row['request'] . "</p>";
                    echo "<p><strong>Date:</strong> " . $row['request_date'] . "</p>";
                    echo "<form method='POST' action='mark_done.php'>";
                    echo "<input type='hidden' name='request_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' class='btn btn-success'>Mark as Done</button>";
                    echo "</form>";
                    echo "</div><hr>";
                }
            } else {
                echo "<p>No pending requests at the moment.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateStatus(requestId, newStatus) {
            // Send an AJAX request to update the status
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + requestId + '&status=' + newStatus
            })
            .then(response => response.text())
            .then(data => {
                // Optionally handle the response or refresh the page
                location.reload(); // Reload the page to reflect the updated status
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    <script src="scripts.js"></script>
</body>
</html>
