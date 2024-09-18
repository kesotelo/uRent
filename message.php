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
    <link rel="stylesheet" href="message.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="sidebar">
    <div class="URent">
            <img src="urentlogo.png" alt="logo Image">
            <p class="logo-text">URent</p>
    </div>
    <ul>
        <li><a href="tdb.php">Dashboard</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">Bills <span class="arrow"></span></a>
            <ul class="dropdown-menu">
                <li><a href="twb.php">Water Bill</a></li>
                <li><a href="teb.php">Electricity Bill</a></li>
                <li><a href="trb.php">Rent Bill</a></li>
            </ul>
        </li>
        <li><a href="message.php" class="active">Message</a></li>
        <li><a href="tlogout.php">Log out</a></li>
    </ul>
</div>

<div class="main-content">
    <h1>Chat with Landlord</h1>

    <!-- Button to trigger the popup -->
    <button class="create-btn" onclick="showPopup()">Create New Message</button>

    <!-- Display Previous Messages -->
    <div class="chat-history">
        <?php foreach ($messages as $message) : ?>
            <div class="message">
                <p><strong><?php echo htmlspecialchars($message['sender']); ?>:</strong> <?php echo htmlspecialchars($message['message']); ?></p>
                <span><?php echo date('Y-m-d H:i:s', strtotime($message['created_at'])); ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Popup container -->
    <div id="messagePopup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Create New Message</h2>
            <!-- Form to send message -->
            <form action="send_message.php" method="POST">
                <label for="recipients">Recipients</label>
                <input type="text" id="recipients" name="recipients" placeholder="Enter recipient names" required><br><br>
                
                <label for="agenda">Agenda</label>
                <input type="text" id="agenda" name="agenda" placeholder="Enter agenda" required><br><br>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" cols="50" placeholder="Write your message here..." required></textarea><br><br>

                <label for="schedule">Schedule Delivery</label>
                <input type="date" id="schedule" name="schedule"><br><br>

                <button type="submit" class="send-btn">Send</button>
            </form>
        </div>
    </div>

    <!-- Success or error message -->
    <?php
    if (isset($success)) {
        echo "<p class='success'>$success</p>";
    } elseif (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>
</div>

<script src="twb.js"></script>
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
