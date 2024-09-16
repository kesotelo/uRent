<?php
include_once 'connect.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$roomNumber = $_POST['roomNumber'];

// Check if email, phone number, or room number already exists in the database
$checkQuery = "SELECT * FROM tenant WHERE email = ? OR phone_num = ? OR room_num = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->bind_param("ssi", $email, $phone, $roomNumber);
$checkStmt->execute();
$checkStmt->store_result();

// If a record is found, prevent the new tenant from being added
if ($checkStmt->num_rows > 0) {
    echo "Error: A tenant with the same email, phone number, or room number already exists.";
} else {
    // Prepare and execute the insert query if no duplicates are found
    $query = "INSERT INTO tenant (username, email, phone_num, room_num) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $name, $email, $phone, $roomNumber);

    if ($stmt->execute()) {
        echo "Tenant added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$checkStmt->close();
$conn->close();
?>
