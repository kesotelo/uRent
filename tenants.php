<!DOCTYPE html>
<?php
include_once 'connect.php';
session_start();

// Query to get tenant data
$query = "SELECT * FROM tenant";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenants</title>
    <link rel="stylesheet" href="tenant.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="URent">
                <img src="urentlogo.png" alt="logo Image">
                <p class="logo-text">URent</p>
                <p><?php echo $_SESSION['user']; ?></p>
            </div>
            <ul>
                <li><a href="lldb.php">Dashboard</a></li>
                <li><a href="llmb.php">Monthly Bills</a></li>
                <li><a href="tenants.php" class="active">Tenants</a></li>
                <li><a href="lllogout.php">Log out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <!-- Add Tenants Button Container -->
            <div class="add-tenants-container">
                <button class="add-tenants-btn" onclick="showPopup('add-tenant')">Add Tenants</button>
            </div>
            <h2>Tenants</h2>
            <div class="tenant-grid">
                <!-- Loop through the tenants from the database -->
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="tenant-room">
                        <p>Room <?php echo $row['room_num']; ?></p>
                        <p><?php echo $row['username']; ?></p>
                        <button onclick="showPopup('info', <?php echo $row['room_num']; ?>)">Information</button>
                        <button onclick="showPopup('electricity', <?php echo $row['room_num']; ?>)">Electricity</button>
                        <button onclick="showPopup('water', <?php echo $row['room_num']; ?>)">Water</button>
                        <button onclick="showPopup('rental', <?php echo $row['room_num']; ?>)">Rental</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Existing popups -->
    <!-- Info Popup -->
    <div id="info-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('info')">&times;</span>
            <h3>Room Information</h3>
            <p><strong>Tenant Name:</strong> <span id="tenant-name-info"></span></p>
            <p><strong>Email:</strong> <span id="tenant-email-info"></span></p>
            <p><strong>Phone Number:</strong> <span id="tenant-phone-info"></span></p>
            <p><strong>Room Number:</strong> <span id="tenant-room-info"></span></p>
        </div>
    </div>

    <!-- Add Tenant Popup -->
    <div id="add-tenant-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('add-tenant')">&times;</span>
            <h3>Add New Tenant</h3>
            <form id="add-tenant-form">
                <label for="tenant-name">Tenant Name:</label>
                <input type="text" id="tenant-name" name="tenant-name" required autocomplete="off">
                <label for="Email">Email:</label>
                <input type="text" id="Email" name="Email" required autocomplete="off">
                <label for="tenant-phone">Phone Number:</label>
                <input type="number" id="tenant-phone" name="tenant-phone" required autocomplete="off">
                <label for="tenant-room">Room Number:</label>
                <input type="number" id="tenant-room" name="tenant-room" required autocomplete="off">
                <button type="submit">Add Tenant</button>
            </form>
        </div>
    </div>

    <!-- Electricity Popup -->
    <div id="electricity-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('electricity')">&times;</span>
            <h3>Electricity Bill Calculator</h3>
            <p>Current Reading: <span id="current-reading">1234</span></p>
            <p>Previous Reading: <span id="previous-reading">1200</span></p>
            <p>Peso/kWh: <input type="number" id="peso-per-kwh" /></p>
            <p>Total: ₱<span id="total-bill">0.00</span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <!-- Water Popup -->
    <div id="water-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('water')">&times;</span>
            <h3>Water Bill Calculator</h3>
            <p>Current Reading: <span id="water-current-reading">500</span></p>
            <p>Previous Reading: <span id="water-previous-reading">450</span></p>
            <p>Peso/CuM: <input type="number" id="peso-per-cum" /></p>
            <p>Total: ₱<span id="water-total-bill">0.00</span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <!-- Rental Popup -->
    <div id="rental-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('rental')">&times;</span>
            <h3>Rental Bill Calculator</h3>
            <p>Rent Amount: <input type="number" id="rent-amount" value="5000" /></p>
            <p>Total: ₱<span id="rent-total-bill">0.00</span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <!-- Receipt Popup -->
    <div id="receipt-popup" class="popup">
        <div class="receipt-container">
            <span class="close-btn" onclick="closePopup('receipt')">&times;</span>
            <div class="header">
                <h2>URent</h2>
                <p>Address</p>
                <p>City</p>
                <p>Phone number</p>
            </div>

            <div class="receipt-details">
                <div class="row">
                    <p><strong>Receipt No:</strong> #<span id="receipt-no"></span></p>
                    <p><strong>Date:</strong> <span id="receipt-date"></span></p>
                </div>
                <div class="row">
                    <p><strong>Bill To:</strong> <span id="bill-to"></span></p>
                    <p>Room: <span id="receipt-room"></span></p>
                </div>
            </div>

            <p><strong>Balance:</strong> As of <span id="balance-date"></span> ₱<span id="previous-balance">0.00</span></p>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Previous Bill</th>
                        <th>Current Bill</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="receipt-items">
                    <!-- Bill items will be inserted here -->
                </tbody>
            </table>

            <div class="totals">
                <p><strong>Total Amount:</strong> ₱<span id="receipt-total">0.00</span></p>
            </div>

            <div class="footer">
                <p>Thank you for your payment!</p>
                <p>If you have any questions, please contact us at contact num.</p>
            </div>

            <button onclick="markAsPaid()">Paid</button>
        </div>
    </div>

    <script src="tenants.js"></script>
</body>
</html>
