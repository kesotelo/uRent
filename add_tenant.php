<?php
// add_tenant.php

$host = 'localhost';
$dbname = 'urent'; // Database name
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve POST data
    $tenantName = $_POST['tenant_name'];
    $roomNumber = $_POST['room_number'];
    $startYear = 2020; // Starting year for tenant records
    $endYear = date("Y"); // Current year

    for ($year = $startYear; $year <= $endYear; $year++) {
        for ($month = 1; $month <= 12; $month++) {
            // Check if the tenant entry exists for the specific month and year
            $stmt = $pdo->prepare("SELECT * FROM monthlyreport WHERE tenant_name = :tenantName AND room_number = :roomNumber AND month = :month AND year = :year");
            $stmt->execute(['tenantName' => $tenantName, 'roomNumber' => $roomNumber, 'month' => $month, 'year' => $year]);

            if ($stmt->rowCount() === 0) {
                // Insert a new record if it does not exist
                $insertStmt = $pdo->prepare("INSERT INTO monthlyreport (tenant_name, room_number, electricity_status, water_status, rental_status, month, year) VALUES (:tenantName, :roomNumber, 'Not Paid', 'Not Paid', 'Not Paid', :month, :year)");
                $insertStmt->execute(['tenantName' => $tenantName, 'roomNumber' => $roomNumber, 'month' => $month, 'year' => $year]);
            }
        }
    }

    echo json_encode(["status" => "success"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
