<?php
session_start();
include_once "connect.php";

// Ensure the user is logged in
if (!isset($_SESSION['unique_id'])) {
    echo "<script>alert('Please log in first.'); window.location='tlogin.php';</script>";
    exit();
}

$user_id = $_SESSION['unique_id']; // Logged in tenant's unique ID
$landlord_id = 1; // Assuming the landlord's unique_id is 1

// Fetch messages between the tenant and the landlord
$messages_query = mysqli_query($conn, "
    SELECT * 
    FROM messages 
    WHERE (sender_id = '$user_id' AND receiver_id = '$landlord_id') 
       OR (sender_id = '$landlord_id' AND receiver_id = '$user_id') 
    ORDER BY created_at ASC
");

// Fetch all landlords
$landlords_query = mysqli_query($conn, "SELECT id, username FROM landlord");
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
        /* Custom Styles */
    </style>
</head>
<body>

<div class="sidebar">
    <div class="URent">
        <img src="urentlogo.png" alt="logo Image">
        <p class="logo-text">URent</p>
    </div>
    <ul>
        <li><a href="tdb.php">Dashboard</a></li>
        <li class="dropdownSide">
            <a href="#" class="dropdown-toggleSide">Bills <span class="arrowSide"></span></a>
            <ul class="dropdown-menuSide">
                <li><a href="twb.php">Water Bill</a></li>
                <li><a href="teb.php">Electricity Bill</a></li>
                <li><a href="trb.php">Rent Bill</a></li>
            </ul>
        </li>
        <li><a href="message.php" class="active">Message</a></li>
    </ul>
</div>


<div class="main-content">
    <h1>Chat with Landlord</h1>

    <h2>Select a Landlord to Chat</h2>
    <form action="" method="GET">
        <select name="landlord_id" onchange="this.form.submit()">
            <option value="">-- Select a Landlord --</option>
            <?php while ($landlord = mysqli_fetch_assoc($landlords_query)): ?>
                <option value="<?php echo $landlord['id']; ?>">
                    <?php echo $landlord['username']; ?>
                </option>
            <?php endwhile; ?>
        </select>
    </form>

    <?php
    if (isset($_GET['landlord_id'])) {
        $landlord_id = $_GET['landlord_id'];

        // Fetch messages between the tenant and the selected landlord
        $messages_query = mysqli_query($conn, "
            SELECT * 
            FROM messages 
            WHERE (sender_id = '$user_id' AND receiver_id = '$landlord_id') 
               OR (sender_id = '$landlord_id' AND receiver_id = '$user_id') 
            ORDER BY created_at ASC
        ");
    ?>

    <div class="chat-history">
        <?php
        if (mysqli_num_rows($messages_query) > 0) {
            while ($message_row = mysqli_fetch_assoc($messages_query)) {
                $sender_name = $message_row['sender_id'] == $user_id ? 'You' : 'Landlord';
                echo "
                    <div class='message'>
                        <p><strong>{$sender_name}:</strong> {$message_row['message']}</p>
                        <span>{$message_row['created_at']}</span>
                    </div>
                ";
            }
        } else {
            echo "<p>No messages yet.</p>";
        }
        ?>
    </div>

    <!-- Popup to send a new message -->
    <button class="create-btn" onclick="showPopup()">Create New Message</button>
    <div id="messagePopup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Create New Message</h2>
            <form action="send_message.php" method="POST">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" cols="50" placeholder="Write your message here..." required></textarea><br><br>
                <input type="hidden" name="receiver_id" value="<?php echo $landlord_id; ?>">
                <button type="submit" class="send-btn">Send</button>
            </form>
        </div>
    </div>

    <?php } ?>
</div>

<script>
    function showPopup() {
        document.getElementById('messagePopup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('messagePopup').style.display = 'none';
    }
</script>

</body>
</html>