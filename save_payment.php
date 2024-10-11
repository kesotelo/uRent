<?php
// Database connection

$conn = new mysqli('localhost', 'root', '', 'urent');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if PDF is uploaded
if (isset($_FILES['pdf'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $pdfFileName = uniqid() . '_receipt.pdf';
    $uploadFile = $uploadDir . $pdfFileName;

    // Attempt to move uploaded file
    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadFile)) {
        $room_number = $_POST['room_number'];
        $tenant_name = $_POST['tenant_name']; 
        $amount = $_POST['amount'];
        $bill_type = $_POST['bill_type'];
        $payment_date = $_POST['payment_date'];

        $stmt = $conn->prepare("INSERT INTO transactions (room_number, tenant_name, bill_type, amount_paid, date_paid, proof_of_payment) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $room_number, $tenant_name, $bill_type, $amount, $payment_date, $pdfFileName);    

        if ($stmt->execute()) {
            echo "Payment saved successfully!";
        } else {
            echo "Error saving payment: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload the receipt PDF.";
    }
} else {
    echo "No PDF received.";
}


// Close the database connection
$conn->close();
?>