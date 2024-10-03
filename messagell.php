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
        <li class="menu-item">
            <a href="lldb.php">
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
            <a href="messagell.php" class="active">
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
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Tenant List -->
            <div class="col-md-4 col-xl-3 chat">
                <div class="card contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="🔎Search..." class="form-control search">
                            <div class="input-group-append">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ul class="contacts">
                            <?php
                            // Fetch the list of tenants
                            $tenants_query = mysqli_query($conn, "SELECT tenant_id, username, room_num FROM tenant");
                            while ($tenant = mysqli_fetch_assoc($tenants_query)) {
                                echo "
                                    <li>
                                        <div class='d-flex bd-highlight'>
                                            <div class='img_cont'>
                                                <img src='user icon.png' class='rounded-circle user_img'>
                                                <span class='online_icon'></span>
                                            </div>
                                            <div class='user_info'>
                                                <a href='?tenant_id={$tenant['tenant_id']}'><span>{$tenant['username']}</span></a>
                                                <p>Room {$tenant['room_num']}</p>
                                            </div>
                                        </div>
                                    </li>
                                ";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Chat Box -->
            <div class="col-md-8 col-xl-6 chat">
                <div class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                                <img src="user icon.png" class="rounded-circle user_img">
                                <span class="online_icon"></span>
                            </div>
                            <div class="user_info">
                                <?php
                                if (isset($_GET['tenant_id'])) {
                                    $tenant_id = $_GET['tenant_id'];
                                    $tenant_query = mysqli_query($conn, "SELECT username FROM tenant WHERE tenant_id='$tenant_id'");
                                    $tenant_data = mysqli_fetch_assoc($tenant_query);
                                    echo "<p class='chat_info'>Chat with {$tenant_data['username']}</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body msg_card_body">
                        <?php
                        if (isset($_GET['tenant_id'])) {
                            // Fetch chat messages
                            $messages_query = mysqli_query($conn, "SELECT * FROM messages WHERE (sender_id='$landlord_id' AND receiver_id='$tenant_id') OR (sender_id='$tenant_id' AND receiver_id='$landlord_id') ORDER BY created_at ASC");

                            if (mysqli_num_rows($messages_query) > 0) {
                                while ($message_row = mysqli_fetch_assoc($messages_query)) {
                                    $is_sender = $message_row['sender_id'] == $landlord_id;
                                    $message_class = $is_sender ? 'msg_cotainer_send' : 'msg_cotainer';
                                    $message_time_class = $is_sender ? 'msg_time_send' : 'msg_time';
                                    echo "
                                        <div class='d-flex ".($is_sender ? "justify-content-end" : "justify-content-start")." mb-4'>
                                            <div class='img_cont_msg'>
                                                <img src='landlord.png' class='rounded-circle user_img_msg'>
                                            </div>
                                            <div class='{$message_class}'>
                                                {$message_row['message']}
                                                <span class='{$message_time_class}'>{$message_row['created_at']}</span>
                                            </div>
                                        </div>
                                    ";
                                }
                            } else {
                                echo "<p>No messages yet with this tenant.</p>";
                            }
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <form action="send_messagell.php" method="POST">
                            <div class="input-group">
                                <textarea class="form-control" name="message" placeholder="Write your message here..." required></textarea>
                                <input type="hidden" name="receiver_id" value="<?php echo $tenant_id; ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
