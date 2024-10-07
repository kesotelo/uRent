<?php
// Include database connection
include('connect.php');

if (isset($_GET['room_num'])) {
    $roomNum = $_GET['room_num'];

    // SQL query to delete tenant by room number
    $query = "DELETE FROM tenant WHERE room_num = '$roomNum'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Redirect to the tenants page after deletion
        header("Location: tenants.php?msg=Tenant deleted successfully");
    } else {
        echo "Error deleting tenant: " . mysqli_error($conn);
    }
}
?>
