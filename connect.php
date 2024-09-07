<?php
$conn = new mysqli('localhost', 'root', '', 'urent');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Check if the database is selected correctly
if (!mysqli_select_db($conn, 'urent')) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>
