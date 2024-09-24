<?php
session_start();
include_once "connect.php";

// Ensure the landlord is logged in
if (!isset($_SESSION['unique_id'])) {
    echo "<script>alert('Please log in first.'); window.location='lllogin.php';</script>";
    exit();
}
$landlord_id = $_SESSION['unique_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard - Chat</title>
    <link rel="stylesheet" href="message.css">
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

<div class="sidebar">
    <div class="URent">
        <img src="urentlogo.png" alt="logo Image">
        <p class="logo-text">URent</p>
    </div>
    <ul>
    <li><a href="lldb.php">Dashboard</a></li>
                <li><a href="llmb.php">Report</a></li>
                <li><a href="tenants.php" >Tenants</a></li>
                <li><a href="messagell.php" class="active">Message</a></li>
</div>
<div class="main-content">
    <h1>Electricity Bill</h1>
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
    <h1>Chat with Tenants</h1>

    <!-- Display Tenant List -->
    <div class="tenant-list">
        <h2>Select a Tenant to Chat</h2>
        <ul>
            <?php
            // Fetch the list of tenants
            $tenants_query = mysqli_query($conn, "SELECT tenant_id, username, room_num FROM tenant");
            while ($tenant = mysqli_fetch_assoc($tenants_query)) {
                echo "<li><a href='?tenant_id={$tenant['tenant_id']}'>Room {$tenant['room_num']} - {$tenant['username']}</a></li>";
            }
            ?>
        </ul>
    </div>

    <?php
    // Display chat history for the selected tenant
    if (isset($_GET['tenant_id'])) {
        $tenant_id = $_GET['tenant_id'];
        
        // Fetch messages between the landlord and the selected tenant
        $messages_query = mysqli_query($conn, "SELECT * FROM messages WHERE (sender_id = '$landlord_id' AND receiver_id = '$tenant_id') OR (sender_id = '$tenant_id' AND receiver_id = '$landlord_id') ORDER BY created_at ASC");

        echo "<div class='chat-history'>";
        if (mysqli_num_rows($messages_query) > 0) {
            while ($message_row = mysqli_fetch_assoc($messages_query)) {
                $sender_name = $message_row['sender_id'] == $landlord_id ? 'You' : 'Tenant';
                echo "
                    <div class='message'>
                        <p><strong>{$sender_name}:</strong> {$message_row['message']}</p>
                        <span>{$message_row['created_at']}</span>
                    </div>
                ";
            }
        } else {
            echo "<p>No messages yet with this tenant.</p>";
        }
        echo "</div>";
    }
    ?>

    <!-- Popup to send a new message -->
    <?php if (isset($_GET['tenant_id'])): ?>
        
    <div id="messagePopup" class="popup">
        <div class="popup-content">
            <h2>Send a Message to Tenant</h2>
            <form action="send_messagell.php" method="POST">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" cols="50" placeholder="Write your message here..." required></textarea>
                <input type="hidden" name="receiver_id" value="<?php echo $tenant_id; ?>">
                <button type="submit" class="send-btn">Send</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Show and hide popup logic (optional)
    function showPopup() {
        document.getElementById('messagePopup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('messagePopup').style.display = 'none';
    }
</script>

</body>
</html>
