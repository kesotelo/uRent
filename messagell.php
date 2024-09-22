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
