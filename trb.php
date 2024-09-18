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
    <link rel="stylesheet" href="twbb.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="sidebar">
    <div class="profile">
        <img src="profile-icon.png" alt="Profile Image">
        <p><?php echo $_SESSION['user'];?></p>
    </div>
    <ul>
        <li><a href="tdb.php">Dashboard</a></li>
        
        <!-- Dropdown Menu for Bills -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">Bills <span class="arrow"></span></a>
            <ul class="dropdown-menu">
                <li><a href="twb.php">Water Bill</a></li>
                <li><a href="teb.php">Electricity Bill</a></li>
                <li><a href="#" class="active">Rent Bill</a></li>
            </ul>
        </li>

        <li><a href="tas.php">Account Settings</a></li>
        <li><a href="message.php">Message</a></li>
        <li><a href="tlogout.php">Log out</a></li>
    </ul>
</div>

<div class="main-content">
    <h1>Rent Bill</h1>

    <div class="bill-section">
        <div class="bill-card previous-bill">
            <h2>Previous Bill</h2>
            <p></p> <!-- Fetched previous bill -->
            <p class="payment-date">Date of Payment: </p> <!-- Fetched payment date -->
            <button id="printButton1" class="print-btn">Print</button>
        </div>

        <div class="bill-card current-bill">
            <h2>Current Bill</h2>
            <p></p> <!-- Fetched current bill -->
            <p>Detailed Breakdown</p>
            <button id="printButton2" class="print-btn">View</button>
        </div>
    </div>
</div>

<script src="twb.js"></script>
</body>
</html>
