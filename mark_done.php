<?php
include_once "connect.php";

// Get request ID from POST data
$request_id = $_POST['request_id'];

// Update the request status to 'done'
$update_query = "UPDATE tenant_requests SET status = 'done' WHERE id = $request_id";
if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Request marked as done.'); window.location='lldb.php';</script>";
} else {
    echo "<script>alert('Failed to update request.'); window.location='lldb.php';</script>";
}
?>
