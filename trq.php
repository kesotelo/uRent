<?php
session_start();
include_once "connect.php";

// Ensure the user is logged in
if (!isset($_SESSION['unique_id'])) {
    echo "<script>alert('Please log in first.'); window.location='tlogin.php';</script>";
    exit();
}

$user_id = $_SESSION['unique_id']; // Logged in tenant's unique ID

// Fetch the tenant's information based on the session ID
$tenant_query = mysqli_query($conn, "SELECT room_num, username FROM tenant WHERE tenant_id = '$user_id'");
if (mysqli_num_rows($tenant_query) > 0) {
    $tenant = mysqli_fetch_assoc($tenant_query);
    $roomNumber = $tenant['room_num'];
    $username = $tenant['username'];
} else {
    echo "<script>alert('Tenant information not found.'); window.location='tlogin.php';</script>";
    exit();
}

// Fetch the tenant's request history (requests marked as 'done')
$history_query = mysqli_query($conn, "SELECT * FROM tenant_requests WHERE tenant_id = '$user_id' AND status = 'done' ORDER BY request_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Dashboard - Chat</title>
    <link rel="stylesheet" href="request.css">
    <  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

<div class="sidebar">
    <div class="URent">
        <img src="urentlogo.png" alt="logo Image">
        <p class="logo-text">URent</p>
    </div>
    <ul>
        <li>
            <a href="tdb.php">
                <img src="dashboard.png" alt="Dashboard Icon" class="menu-item"> Dashboard
            </a>
        </li>
        <li class="dropdownSide">
            <a href="#" class="dropdown-toggleSide">
                <img src="bill.png" alt="Bills Icon" class="menu-item"> Bills <span class="arrowSide"></span>
            </a>
            <ul class="dropdown-menuSide">
                <li>
                    <a href="twb.php">
                        <img src="water.png" alt="Water Bill Icon" class="submenu-item"> Water Bill
                    </a>
                </li>
                <li>
                    <a href="teb.php">
                        <img src="electricity.png" alt="Electricity Bill Icon" class="submenu-item"> Electricity Bill
                    </a>
                </li>
                <li>
                    <a href="trb.php">
                        <img src="rent.png" alt="Rent Bill Icon" class="submenu-item"> Rent Bill
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdownSide">
            <a href="#" class="dropdown-toggleSide">
                <img src="contact.png" alt="Contact Landlord Icon" class="menu-item"> Contact Landlord <span class="arrowSide"></span>
            </a>
            <ul class="dropdown-menuSide">
                <li>
                    <a href="message.php">
                        <img src="messages.png" alt="Message Icon" class="submenu-item"> Message
                    </a>
                </li>
                <li>
                    <a href="trq.php">
                        <img src="request.png" alt="Tenant Request Icon" class="submenu-item"> Tenant Request
                    </a>
                </li>
            </ul>
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

        <!-- Account Modal -->
        <div class="modal" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="accountModalLabel">Edit Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action = 'tchangeprof.php' method = 'post'>
                        <div class="row mb-1">
                            <div class="col">
                                <small>Username <span class="text-danger">*</span></small>
                                <input name="username" required type="text" class="form-control" autocomplete = "off" >
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <small>Contact No. <span class="text-danger">*</span></small>
                                <input name="phone" required type="number" class="form-control" autocomplete = "off"  >
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <small>Email <span class="text-danger">*</span></small>
                                <input name="email" id="" cols="30" rows="3" class="form-control" autocomplete = "off"  required >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="button" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="button">Update Account</button>
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
                <form action = "tchangepw.php" method = "post">
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
    <!-- Flex container for the header and history toggle -->
    <div class="main-header">
        <h3>Submit a Request to Your Landlord</h3>

        <!-- History Toggle Section -->
        <div class="history-toggle">
            <img src="history.png" alt="History Icon" class="history-icon">
            <span>Request History</span>
        </div>
    </div>

    <form action="submit_request.php" method="post">
        <div class="form-group">
            <label for="roomNumber">Room Number:</label>
            <input type="text" id="roomNumber" name="roomNumber" class="form-control" value="<?php echo $roomNumber; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="tenantName">Tenant Name:</label>
            <input type="text" id="tenantName" name="tenantName" class="form-control" value="<?php echo $username; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="request">Request:</label>
            <textarea id="request" name="request" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>

    <!-- Request History Section (Hidden by default) -->
    <div id="history-section" class="history-container">
        <?php
        if (mysqli_num_rows($history_query) > 0) {
            while ($row = mysqli_fetch_assoc($history_query)) {
                echo "<div class='history-entry'>";
                echo "<p><strong>Room:</strong> " . $row['room_number'] . "</p>";
                echo "<p><strong>Request:</strong> " . $row['request'] . "</p>";
                echo "<p><strong>Status:</strong> " . $row['status'] . "</p>";
                echo "<p><strong>Date:</strong> " . $row['request_date'] . "</p>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>No completed requests yet.</p>";
        }
        ?>
    </div>
</div>
<!-- Dropdown Toggle Logic -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const historyToggle = document.querySelector('.history-toggle');
    const historySection = document.getElementById('history-section');

    historyToggle.addEventListener('click', function () {
        // Toggle the visibility of the request history
        historySection.style.display = historySection.style.display === 'none' || historySection.style.display === '' ? 'block' : 'none';
    });

    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');

    dropdownToggle.addEventListener('click', function (e) {
        e.preventDefault();
        dropdown.classList.toggle('open');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.dropdownSide');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggleSide');
        
        toggle.addEventListener('click', function(event) {
            event.preventDefault();
            dropdown.classList.toggle('open');
        });
    });

    // Optional: Close dropdown if clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdownSide')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('open');
            });
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add active class to the current link
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.sidebar ul li a');
    links.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
});
    </script>


</body>
</html>