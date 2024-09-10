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
    <link rel="stylesheet" href="llmbn.css"> 
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="URent">
                <img src="urentlogo.png" alt="logo Image">
                <p class="logo-text">URent</p>
                <p><?php echo $_SESSION['user'];?></p>
            </div>
            <ul>
                <li><a href="lldb.php">Dashboard</a></li>
                <div class="month-dropdown">
                <select id="page-select">
                    <option value="bills">Monthly Bills</option>
                    <option value="report">Transaction Report</option>
                </select>
                <li><a href="tenants.php">Tenants</a></li>
                <li><a href="lllogout.php">Log out</a></li>
            </ul>
        </div>
    </div>

        <div class="main-content">
            <div id="bills-section">
                <h2>Monthly Bills</h2>
                <table id="bills-table">
                    <!-- The table will be populated by JavaScript -->
                </table>
            </div>

            <div id="report-section" style="display:none;">
                <h2>Transaction Report</h2>
                <table id="report-table">
                    <!-- Transaction report details will go here -->
                </table>
            </div>
        </div>
    </div>

    <script src="lldb.js"></script>
    <script>
        // JavaScript to handle page selection
        const pageSelect = document.getElementById('page-select');
        const billsSection = document.getElementById('bills-section');
        const reportSection = document.getElementById('report-section');

        pageSelect.addEventListener('change', function() {
            if (this.value === 'bills') {
                billsSection.style.display = 'block';
                reportSection.style.display = 'none';
            } else if (this.value === 'report') {
                billsSection.style.display = 'none';
                reportSection.style.display = 'block';
            }
        });
    </script>
</body>
</html>
