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
    <link rel="stylesheet" href="llmb.css"> 
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="URent">
                <img src="urentlogo.png" alt="logo Image">
                <p class="logo-text">URent</p>
            </div>
            <ul>
                <li><a href="lldb.php">Dashboard</a></li>
                <li class="dropdown">
            <a class="dropdown-toggle">Report <span class="arrow">&#9662;</span></a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" data-action="monthly_report">Monthly Report</a></li>
                <li><a class="dropdown-item" data-action="transaction_report">Transaction Report</a></li>
            </ul>
        </li>
                <li><a href="tenants.php">Tenants</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div id="bills-section" style="display:none;">
            <h2>Monthly Report</h2>
            <table id="bills-table">
                <!-- The table will be populated by JavaScript -->
            </table>
        </div>

        <div id="report-section" style="display:none;">
            <h2>Transaction Report</h2>
            <table id="report-table">
                <thead>
                    <tr>
                        <th>Room Number</th>
                        <th>Name</th>
                        <th>Type of Bill</th>
                        <th>Amount Paid</th>
                        <th>Date Paid</th>
                        <th>Proof of Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be populated using JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="lldb.js"></script>
    <script>
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
                loadTransactionReport(); // Load report when "Transaction Report" is selected
            }
        });
    </script>
</body>
</html>
