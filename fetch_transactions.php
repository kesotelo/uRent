<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'urent');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM transactions";
$result = $conn->query($query);

$transactions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}

// Send the transactions as JSON
echo json_encode($transactions);

// Close the database connection
$conn->close();
?>
