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
    <div class="URent">
            <img src="urentlogo.png" alt="logo Image">
            <p class="logo-text">URent</p>
    </div>
    <ul>
        <li><a href="tdb.php">Dashboard</a></li>
        
        <!-- Dropdown Menu for Bills -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">Bills <span class="arrow"></span></a>
            <ul class="dropdown-menu">
                <li><a href="twb.php">Water Bill</a></li>
                <li><a href="#" class="active">Electricity Bill</a></li>
                <li><a href="trb.php">Rent Bill</a></li>
            </ul>
        </li>
        <li><a href="message.php">Message</a></li>
        <li><a href="tlogout.php">Log out</a></li>
    </ul>
</div>
<?php
				$query = "SELECT * FROM elec where tenant_id ='" . $_SESSION['id']  ."'";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
<div class="main-content">
    <h1>Electricity Bill</h1>

    <div class="bill-section">
        <div class="bill-card previous-bill">
            <h2>Previous Bill</h2>
            <p>₱<?php echo $row["p_bill"]; ?></p> <!-- Fetched previous bill -->
            <p class="payment-date">Date of Payment: </p> <!-- Fetched payment date -->
            <button id="printButton1" class="print-btn">Print</button>
        </div>

        <div class="bill-card current-bill">
            <h2>Current Bill</h2> 
            <p>₱<?php echo $row["n_bill"]; ?></p> <!-- Fetched current bill -->
            <p>Detailed Breakdown</p>
            <button id="viewButton" class="view-btn">View</button>
        </div>
    </div>
</div>



<script src="twb.js"></script>
<?php }
}
?>
</body>
</html>
