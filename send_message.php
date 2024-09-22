<?php
session_start();
include_once "connect.php";

// Ensure the user is logged in
if (!isset($_SESSION['unique_id'])) {
    echo "<script>alert('Please log in first.'); window.location='tlogin.php';</script>";
    exit();
}

if (isset($_POST['message'], $_POST['receiver_id'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sender_id = $_SESSION['unique_id']; // Currently logged-in tenant
    $receiver_id = $_POST['receiver_id']; // Landlord's ID

    if (!empty($message)) {
        $query = "INSERT INTO messages (sender_id, receiver_id, message, created_at) VALUES ('$sender_id', '$receiver_id', '$message', NOW())";
        if (mysqli_query($conn, $query)) {
            header("Location: message.php?landlord_id=$receiver_id");
        } else {
            echo "Error sending message: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Message cannot be empty.'); window.location='message.php';</script>";
    }
}
