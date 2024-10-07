<?php
// Database connection setup
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "urent"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tenant data
$sql = "SELECT tenant_id, username, room_num FROM tenant";
$result = $conn->query($sql);

$tenants = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $tenants[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();

// Return tenant data as JSON
header('Content-Type: application/json');
echo json_encode($tenants);
?>
