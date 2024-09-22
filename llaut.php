<?php

session_start();
include_once 'connect.php';

$name = $_POST['user'];
$password = $_POST['password'];

$s = " select * from landlord where username = '$name' && password = '$password'";

$result = mysqli_query($conn, $s);

$num = mysqli_num_rows($result);

	
if ($num == 1) {
    $landlord = mysqli_fetch_assoc($result); // Fetch landlord's data
    $_SESSION['unique_id'] = $landlord['id']; // Set unique ID for landlord
    $_SESSION['user'] = $name; // Set username
    header('location: lldb.php');
} else {
    echo '<script>alert("Wrong username or password")</script>';
    echo '<script>window.location="lllogin.php"</script>';
}



?>
