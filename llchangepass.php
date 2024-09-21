<?php
include_once 'connect.php';
session_start();

$password = $_POST['password'];
$new_pass = $_POST['newpassword'];
$con_pass = $_POST['conpassword'];
$id = $_SESSION['id'];

$pass = "SELECT * from landlord where password = '$password'";

$rslt = mysqli_query($conn, $pass);
$queue = mysqli_num_rows($rslt);

if($new_pass !== $con_pass){
    echo '<script>alert("New password and Confirm password does not match")</script>';
    echo '<script>window.location="lldb.php"</script>';
}else if($queue !== 1){
    echo '<script>alert("Wrong password")</script>';
    echo '<script>window.location="lldb.php"</script>';
}else{
    $pw = "SELECT * from landlord where id = '$id' AND password = '$password' ";
    $q =  mysqli_query($conn, $pw);
    if(mysqli_num_rows($q) == 1){
        $q3 = "UPDATE landlord SET password='$new_pass' WHERE id='$id'";
        	mysqli_query($conn, $q3);

            echo '<script>alert("Password changed)</script>';
            echo '<script>window.location="lldb.php"</script>';
            
        	
	        exit();
    }
}
?>