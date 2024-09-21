<?php
session_start();
include_once "connect.php";

// Ensure the user is logged in
if (!isset($_SESSION['unique_id'])) {
    echo "<script>alert('Please log in first.'); window.location='tlogin.php';</script>";
    exit();
}

if (isset($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sender_id = $_SESSION['unique_id']; // Currently logged-in user
    $receiver_id = 1; // Assume landlord unique_id is 1 for example

    if (!empty($message)) {
        $query = "INSERT INTO messages (sender_id, receiver_id, message, created_at) VALUES ('$sender_id', '$receiver_id', '$message', NOW())";
        if (mysqli_query($conn, $query)) {
            header("Location: message.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
