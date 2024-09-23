<!DOCTYPE html>
<?php
include_once 'connect.php';
session_start();

// Query to get tenant data
$query = "SELECT * FROM tenant";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenants</title>
    <link rel="stylesheet" href="tenant.css">
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
                <li><a href="lldb.php">Dashboard</a></li>
                <li><a href="llmb.php">Report</a></li>
                <li><a href="tenants.php" class="active">Tenants</a></li>
                <li><a href="messagell.php">Messages</a></li>  
            </ul>
        </div>
        <div class="main-content">
            <!-- Dropdown in the top right corner -->
            <div class="top-bar">
            <div class="dropdown" style="display: flex; align-items: center;">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="background: transparent; width: 75px">
                    <img src="user icon.png" alt="Profile Image" alt width= "35" height="35" class="rounded circle">
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
            <div class="add-tenants-container">
                <button class="add-tenants-btn" onclick="showPopup('add-tenant')">Add Tenants</button>
            </div>
            <h2>Tenants</h2>
            <div class="tenant-grid">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="tenant-room">
                        <p>Room <?php echo $row['room_num']; ?></p>
                        <p><?php echo $row['username']; ?></p>
                        <button onclick="showPopup('info', '<?php echo $row['room_num']; ?>', '<?php echo $row['username']; ?>', '<?php echo $row['email']; ?>', '<?php echo $row['phone_num']; ?>')">Information</button>
                        <button onclick="showPopup('electricity', '<?php echo $row['room_num']; ?>')">Electricity</button>
                        <button onclick="showPopup('water', '<?php echo $row['room_num']; ?>')">Water</button>
                        <button onclick="showPopup('rental', '<?php echo $row['room_num']; ?>')">Rental</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Existing popups -->
    <div id="info-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('info')">&times;</span>
            <h3>Room Information</h3>
            <p><strong>Tenant Name:</strong> <span id="tenant-name-info"></span></p>
            <p><strong>Email:</strong> <span id="tenant-email-info"></span></p>
            <p><strong>Phone Number:</strong> <span id="tenant-phone-info"></span></p>
            <p><strong>Room Number:</strong> <span id="tenant-room-info"></span></p>
        </div>
    </div>

    <!-- Add Tenant Popup -->
    <div id="add-tenant-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('add-tenant')">&times;</span>
            <h3>Add New Tenant</h3>
            <form id="add-tenant-form">
                <label for="tenant-name">Tenant Name:<span class="text-danger">*</span></label>
                <input type="text" id="tenant-name" name="tenant-name" required autocomplete="off">
                <label for="Email">Email:<span class="text-danger">*</span></label>
                <input type="text" id="Email" name="Email" required autocomplete="off">
                <label for="tenant-phone">Phone Number:<span class="text-danger">*</span></label>
                <input type="number" id="tenant-phone" name="tenant-phone" required autocomplete="off">
                <label for="tenant-room">Room Number:<span class="text-danger">*</span></label>
                <input type="number" id="tenant-room" name="tenant-room" required autocomplete="off">
                <button type="submit">Add Tenant</button>
            </form>
        </div>
    </div>

    <!-- Electricity Popup -->
    <div id="electricity-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('electricity')">&times;</span>
            <h3>Electricity Bill Calculator</h3>
            <p>Current Reading: <span id="current-reading">1234</span></p>
            <p>Previous Reading: <span id="previous-reading">1200</span></p>
            <p>Peso/kWh: <input type="number" id="peso-per-kwh" /></p>
            <p>Total: ₱<span id="total-bill">0.00</span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <!-- Water Popup -->
    <div id="water-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('water')">&times;</span>
            <h3>Water Bill Calculator</h3>
            <p>Current Reading: <span id="water-current-reading">500</span></p>
            <p>Previous Reading: <span id="water-previous-reading">450</span></p>
            <p>Peso/CuM: <input type="number" id="peso-per-cum" /></p>
            <p>Total: ₱<span id="water-total-bill">0.00</span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <!-- Rental Popup -->
    <div id="rental-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('rental')">&times;</span>
            <h3>Rental Bill Calculator</h3>
            <p>Rent Amount: <input type="number" id="rent-amount" value="0" /></p>
            <p>Total: ₱<span id="rent-total-bill">0.00</span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <!-- Receipt Popup -->
    <div id="receipt-popup" class="popup">
        <div class="receipt-container">
            <span class="close-btn" onclick="closePopup('receipt')">&times;</span>
            <div class="header">
                <h2>URent</h2>
                <p>Address</p>
                <p>City</p>
                <p>Phone number</p>
            </div>

            <div class="receipt-details">
                <div class="row">
                    <p><strong>Receipt No:</strong> #<span id="receipt-no"></span></p>
                    <p><strong>Date:</strong> <span id="receipt-date"></span></p>
                </div>
                <div class="row">
                    <p><strong>Bill To:</strong> <span id="receipt-tenant-name"></span></p>
                    <p><strong>Room:</strong> <span id="receipt-room"></span></p>
                </div>
            </div>

            <p><strong>Balance:</strong> As of <span id="balance-date"></span> ₱<span id="previous-balance">0.00</span></p>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Previous Bill</th>
                        <th>Current Bill</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="receipt-items"></tbody>
            </table>

            <div class="totals">
                <p><strong>Total Amount:</strong> ₱<span id="receipt-total">0.00</span></p>
            </div>

            <div class="footer">
                <p>Thank you for your payment!</p>
                <p>If you have any questions, please contact us at contact num.</p>
            </div>

            <button onclick="markAsPaid()">Paid</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="tenants.js"></script>
    
</body>
</html>
