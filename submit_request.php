<?php
include_once 'connect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['unique_id'])) {
    header("Location: tlogin.php");
    exit();
}

$tenant_id = $_SESSION['unique_id']; // Ensure the correct session variable is used

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomNumber = $_POST['roomNumber'];
    $username = $_POST['tenantName'];
    $request = $_POST['request'];

    // Insert the request into the database with default status 'pending'
    $stmt = $conn->prepare("INSERT INTO tenant_requests (tenant_id, room_number, tenant_name, request) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $tenant_id, $roomNumber, $username, $request);

    if ($stmt->execute()) {
        echo "<script>alert('Request submitted successfully!'); window.location='trq.php';</script>";
    } else {
        echo "<script>alert('Error submitting request.'); window.location='trq.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
