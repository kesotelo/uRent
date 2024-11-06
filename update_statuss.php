<?php
$host = 'localhost';
$dbname = 'urent';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tenantName = $_POST['tenant_name'];
    $roomNumber = $_POST['room_number'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE monthlyreport SET $type = :status WHERE tenant_name = :tenantName AND room_number = :roomNumber AND month = :month AND year = :year");
    $stmt->execute(['status' => $status, 'tenantName' => $tenantName, 'roomNumber' => $roomNumber, 'month' => $month, 'year' => $year]);

    echo json_encode(["status" => "success"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
