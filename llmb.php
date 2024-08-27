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
    <link rel="stylesheet" href="lldb.css"> 
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="profile">
                <img src="profile_icon.png" alt="Landlord Icon">
                <p><?php echo $_SESSION['user'];?></p>
            </div>
            <ul>
                <li><a href="lldb.php">Dashboard</a></li>
                <li><a href="llmb.php" class="active">Monthly Bills</a></li>
                <li><a href="tenants.php">Tenants</a></li>
                <li><a href="lllogout.php">Log out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Monthly Bills</h2>
            
            <table id="bills-table">
                <!-- The table will be populated by JavaScript -->
            </table>                
        </div>
    </div>

    <script src="lldb.js"></script> 
</body>
</html>
