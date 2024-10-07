<?php
// Database connection setup
$servername = "localhost";  // Your server name
$username = "root";  // Your database username
$password = "";  // Your database password
$dbname = "urent";  // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the room number from the request (e.g., from an AJAX call)
$room_num = intval($_GET['room_num']); // Assuming the room number is sent via GET

// Prepare and execute the SQL query to get tenant data by room number
$sql = "SELECT * FROM tenant WHERE room_num = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_num); // "i" means integer
$stmt->execute();
$result = $stmt->get_result();

// Check if a tenant was found
if ($result->num_rows > 0) {
    // Fetch the tenant data
    $tenant = $result->fetch_assoc();
    
    // Return the tenant data as a JSON response
    echo json_encode([
        'tenant_id' => $tenant['tenant_id'],
        'username' => $tenant['username'],
        'email' => $tenant['email'],
        'phone_num' => $tenant['phone_num'],
        'room_num' => $tenant['room_num']
    ]);
} else {
    // No tenant found for the given room number
    echo json_encode(['error' => 'No tenant found for this room']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
