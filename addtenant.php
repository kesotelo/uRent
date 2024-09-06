<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenantName = htmlspecialchars($_POST['tenant-name']);
    $email = htmlspecialchars($_POST['Email']);
    $phone = htmlspecialchars($_POST['tenant-phone']);
    $roomNumber = htmlspecialchars($_POST['tenant-room']);

    if (empty($tenantName) || empty($email) || empty($phone) || empty($roomNumber)) {
        echo 'All fields are required.';
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tenants (tenant_name, email, phone_number, room_number) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        echo 'Error preparing statement: ' . $conn->error;
        exit;
    }

    $stmt->bind_param('ssss', $tenantName, $email, $phone, $roomNumber);

    if ($stmt->execute()) {
        echo 'Tenant added successfully!';
    } else {
        echo 'Error executing statement: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
