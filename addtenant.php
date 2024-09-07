<?php
include_once 'connect.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$roomNumber = $_POST['roomNumber'];

// Prepare and execute SQL query
$query = "INSERT INTO tenant (username, email, phone_num, room_num) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssi", $name, $email, $phone, $roomNumber);

if ($stmt->execute()) {
    echo "Tenant added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
