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
    <link rel="stylesheet" href="tdb1.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="profile">
            <img src="profile-icon.png" alt="Profile Image">
            <p><?php echo $_SESSION['user'];?></p>
        </div>
        <ul>
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="#">Water Bill</a></li>
            <li><a href="#">Electricity Bill</a></li>
            <li><a href="#">Rent Bill</a></li>
            <li><a href="tas.php">Account Settings</a></li>
            <li><a href="tlogout.php">Log out</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <h1>Dashboard</h1>

        <!-- Monthly Bills and Due Dates -->
        <div class="top-section">
            <div class="monthly-bills">
                <h2>Monthly Bills</h2>
                <canvas id="monthlyBillsChart"></canvas>
            </div>
            <div class="due-dates">
                <h2>Due Dates</h2>
                <!-- Due dates will be dynamically inserted here -->
            </div>
        </div>

        <!-- Daily Bills -->
        <div class="daily-bills">
            <h2>Daily Bills</h2>
            <div class="chart-row">
                <div class="chart-container">
                    <h3>Electricity Bills</h3>
                    <canvas id="electricityDailyChart"></canvas>
                </div>
                <div class="chart-container">
                    <h3>Water Bills</h3>
                    <canvas id="waterDailyChart"></canvas>
                </div>
                <div class="chart-container">
                    <h3>Rental Bills</h3>
                    <canvas id="rentalDailyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="tdb.js"></script>
</body>
</html>
