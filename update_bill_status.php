<?php
include_once 'connect.php';
header('Content-Type: application/json');

// Retrieve JSON data from request body
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['room_number'], $data['bill_type'], $data['payment_date'], $data['tenant_name'])) {
    $roomNumber = $data['room_number'];
    $billType = $data['bill_type'];
    $paymentDate = $data['payment_date'];
    $tenantName = $data['tenant_name']; // Tenant's name

    switch ($billType) {
        case 'electricity':
            $query = "UPDATE bills SET electricityPaid = 1, paymentDate = ?, tenant = ? WHERE roomNumber = ?";
            break;
        case 'water':
            $query = "UPDATE bills SET waterPaid = 1, paymentDate = ?, tenant = ? WHERE roomNumber = ?";
            break;
        case 'rental':
            $query = "UPDATE bills SET rentalPaid = 1, paymentDate = ?, tenant = ? WHERE roomNumber = ?";
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid bill type']);
            exit;
    }

    // Prepare the statement
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement']);
        exit;
    }

    // Bind parameters (payment date, tenant name, room number)
    $stmt->bind_param('sss', $paymentDate, $tenantName, $roomNumber);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update bill status']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}