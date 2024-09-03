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
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="URent">
            <img src="urentlogo.png" alt="logo Image">
            <p class="logo-text">URent</p>
            <p><?php echo $_SESSION['user'];?></p>
        </div>
        <ul>
            <li><a href="lldb.php" class="active">Dashboard</a></li>
            <li><a href="llmb.php">Monthly Bills</a></li>
            <li><a href="tenants.php">Tenants</a></li>
            <li><a href="lllogout.php">Log out</a></li>
        </ul>
    </div>
    
    <div class="main-content">
        <div class="top-cards">
            <div class="card">
                <h3>Rent Received</h3>
                <p>₱<?php echo '___'; // Placeholder ?></p>
                <p><?php echo '__'; ?> Unpaid</p>
            </div>
            <div class="card">
                <h3>Overdue Rent</h3>
                <p>₱<?php echo '___'; // Placeholder ?></p>
                <p><?php echo '__'; ?> Overdue</p>
            </div>
            <div class="card">
                <h3>Utility Expenses</h3>
                <p>₱<?php echo '___'; // Placeholder ?></p>
                <p><?php echo '__'; ?> Unpaid</p>
            </div>
        </div>

        <div class="content-container">
            <!-- Charts Section -->
            <div class="chart-section">
                <div class="chart-row">
                    <div class="chart-container">
                        <canvas id="electricityUsageChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="waterUsageChart"></canvas>
                    </div>
                </div>
                <div class="chart-row">
                    <div class="chart-container">
                        <canvas id="utilitiesCostChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <canvas id="estimatedChangeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tenant Requests Section -->
            <div class="tenant-requests">
                <h3>Tenant Request</h3>
                <ul>
                    <li>ROOM 1 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                    <li>ROOM 2 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                    <li>ROOM 3 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                    <li>ROOM 4 - <span class="status"><?php echo '___'; // Placeholder ?></span></li>
                </ul>
            </div>

    <script src="scripts.js"></script>
</body>
</html>
