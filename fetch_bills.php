<?php
// Database connection setup
$servername = "localhost";
$username = "root"; // Your username
$password = ""; // Your password
$dbname = "urent"; // Your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the selected month and year from the request
$month = $_GET['month'] ?? '06'; // Default to June if not provided
$year = $_GET['year'] ?? '2024';

// Fetch bills for the selected month/year
$sql = "SELECT tenant_id, electricity_paid, water_paid, rent_paid 
        FROM monthly_bills 
        WHERE YEAR(bill_date) = ? AND MONTH(bill_date) = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $year, $month);
$stmt->execute();
$result = $stmt->get_result();

$bills = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bills[] = $row;
    }
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($bills);
?>
