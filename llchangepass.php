<?php
include_once 'connect.php';
session_start();

$password = $_POST['password'];
$new_pass = $_POST['newpassword'];
$con_pass = $_POST['conpassword'];
$id = $_SESSION['unique_id'];

$p = "SELECT * from landlord where password = '$password'";

$result = mysqli_query($conn, $p);
$num = mysqli_num_rows($result);

if($num !== 1){
    echo '<script>alert("Wrong password")</script>';
    echo '<script>window.location="lldb.php"</script>';
}else if($new_pass !== $con_pass ){
    echo '<script>alert("New password and Confirm password does not match")</script>';
    echo '<script>window.location="lldb.php"</script>';
}else{
    $sel = "SELECT * from landlord where id = '$id' AND password = '$password' ";
    $res =  mysqli_query($conn, $sel);
    if(mysqli_num_rows($res) == 1){
        $sql_2 = "UPDATE landlord SET password='$new_pass' WHERE id ='$id'";
        	mysqli_query($conn, $sql_2);

            echo '<script>alert("Password changed)</script>';
            echo '<script>window.location="lldb.php"</script>';
            
        	
	        exit();
    }
}
?>