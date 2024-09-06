
<!DOCTYPE html>
<?php
include_once 'connect.php';
session_start();

// Query to get addtenant data
$query = "SELECT * FROM addtenant";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenants</title>
    <link rel="stylesheet" href="tenants.css"> 
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
                <!-- Existing tenant-room divs here -->
                <div class="tenant-room">
                    <p>Room 1</p>
                    <button onclick="showPopup('info', 1)">Information</button>
                    <button onclick="showPopup('electricity', 1)">Electricity</button>
                    <button onclick="showPopup('water', 1)">Water</button> 
                    <button onclick="showPopup('rental', 1)">Rental</button> 
                </div>
                <!-- Repeat tenant-room divs for other rooms as needed -->
            </div>
        </div>
    </div>

    <!-- Existing popups -->
    <div id="info-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('info')">&times;</span>
            <h3>Room Information</h3>
            <p id="room-info"></p>
        </div>
    </div>

    <!-- Add the new Add Tenant Popup -->
    <div id="add-tenant-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('add-tenant')">&times;</span>
            <h3>Add New Tenant</h3>
            <form id="add-tenant-form">
                <label for="tenant-name">Tenant Name:</label>
                <input type="text" id="tenant-name" name="tenant-name" required>
                <label for="Email">Email:</label>
                <input type="text" id="Email" name="Email" required>
                <label for="tenant-phone">Phone Number:</label>
                <input type="int" id="tenant-phone" name="tenant-phone" required>
                <label for="tenant-room">Room Number:</label>
                <input type="int" id="tenant-room" name="tenant-room" required>
                <button type="submit">Add Tenant</button>
            </form>
        </div>
    </div>

    <div id="electricity-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('electricity')">&times;</span>
            <h3>Electricity Bill Calculator</h3>
            <p>Current Reading: <span id="current-reading"></span></p>
            <p>Previous Reading: <span id="previous-reading"></span></p>
            <p>Peso/kWh: <input type="number" id="peso-per-kwh" /></p>
            <p>Total: <span id="total-bill"></span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <div id="water-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('water')">&times;</span>
            <h3>Water Bill Calculator</h3>
            <p>Current Reading: <span id="water-current-reading"></span></p>
            <p>Previous Reading: <span id="water-previous-reading"></span></p>
            <p>Peso/CuM: <input type="number" id="peso-per-cum" /></p>
            <p>Total: <span id="water-total-bill"></span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <div id="rental-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('rental')">&times;</span>
            <h3>Rental Bill Calculator</h3>
            <p>Rent Amount: <input type="number" id="rent-amount" /></p>
            <p>Total: <span id="rent-total-bill"></span></p>
            <button onclick="showPopup('receipt')">Pay Bills</button>
        </div>
    </div>

    <div id="receipt-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('receipt')">&times;</span>
            <h3>Receipt</h3>
            <p>Room: <span id="receipt-room"></span></p>
            <p>Total Amount: <span id="receipt-total"></span></p>
            <button onclick="markAsPaid()">Paid</button>
        </div>
    </div>

    <script src="tenants.js"></script>
</body>
</html>
