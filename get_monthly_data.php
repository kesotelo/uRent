<?php
// get_monthly_data.php

$host = 'localhost';
$dbname = 'urent'; // Database name
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve GET data
    $month = $_GET['month'];
    $year = $_GET['year'];

    // Fetch all tenants for the selected month and year
    $stmt = $pdo->prepare("SELECT * FROM monthlyreport WHERE month = :month AND year = :year");
    $stmt->execute(['month' => $month, 'year' => $year]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
