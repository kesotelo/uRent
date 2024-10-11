<?php
include_once 'connect.php';

$year = isset($_GET['year']) ? $_GET['year'] : date("Y");
$month = isset($_GET['month']) ? $_GET['month'] : date("m");

$query = $conn->prepare("SELECT tenant, electricityPaid, waterPaid, rentalPaid, roomNumber FROM bills WHERE year = ? AND month = ?");
$query->bind_param('ss', $year, $month);
$query->execute();
$result = $query->get_result();

$bills = [];
while ($row = $result->fetch_assoc()) {
    $bills[] = $row;
}

echo json_encode($bills);
?>
