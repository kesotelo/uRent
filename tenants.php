
<!DOCTYPE html>
<?php
include_once 'connect.php';
session_start();


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
            <div class="profile">
                <img src="profile_icon.png" alt="Landlord Icon">
                <p><?php echo $_SESSION['user'];?></p>
            </div>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="lldb.php">Monthly Bills</a></li>
                <li><a href="#" class="active">Tenants</a></li>
                <li><a href="lnlogout.php">Log out</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h2>Tenants</h2>
            <div class="tenant-grid">
                <div class="tenant-room">
                    <p>Room 1</p>
                    <button onclick="showPopup('info', 1)">Information</button>
                    <button onclick="showPopup('electricity', 1)">Electricity</button>
                    <button onclick="showPopup('water', 1)">Water</button> 
                    <button onclick="showPopup('rental', 1)">Rental</button> 
                </div>
                <div class="tenant-room">
                    <p>Room 2</p>
                    <button onclick="showPopup('info', 2)">Information</button>
                    <button onclick="showPopup('electricity', 2)">Electricity</button>
                    <button onclick="showPopup('water', 2)">Water</button> 
                    <button onclick="showPopup('rental', 2)">Rental</button> 
                </div>
                <div class="tenant-room">
                    <p>Room 3</p>
                    <button onclick="showPopup('info', 3)">Information</button>
                    <button onclick="showPopup('electricity', 3)">Electricity</button>
                    <button onclick="showPopup('water', 3)">Water</button> 
                    <button onclick="showPopup('rental', 3)">Rental</button> 
                </div>
                <div class="tenant-room">
                    <p>Room 4</p>
                    <button onclick="showPopup('info', 4)">Information</button>
                    <button onclick="showPopup('electricity', 4)">Electricity</button>
                    <button onclick="showPopup('water', 4)">Water</button> 
                    <button onclick="showPopup('rental', 4)">Rental</button> 
                </div>
                <div class="tenant-room">
                    <p>Room 5</p>
                    <button onclick="showPopup('info', 5)">Information</button>
                    <button onclick="showPopup('electricity', 5)">Electricity</button>
                    <button onclick="showPopup('water', 5)">Water</button> 
                    <button onclick="showPopup('rental', 5)">Rental</button> 
                </div>
                <div class="tenant-room">
                    <p>Room 6</p>
                    <button onclick="showPopup('info', 6)">Information</button>
                    <button onclick="showPopup('electricity', 6)">Electricity</button>
                    <button onclick="showPopup('water', 6)">Water</button> 
                    <button onclick="showPopup('rental', 6)">Rental</button> 
                </div>
            </div>
        </div>
    </div>

    <div id="info-popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup('info')">&times;</span>
            <h3>Room Information</h3>
            <p id="room-info"></p>
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
