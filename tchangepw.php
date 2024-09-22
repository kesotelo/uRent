<?php
include_once 'connect.php';
session_start();

$password = $_POST['password'];
$new_pass = $_POST['newpassword'];
$con_pass = $_POST['conpassword'];
$id = $_SESSION['unique_id'];

$p = "SELECT * from tenant where password = '$password'";

$result = mysqli_query($conn, $p);
$num = mysqli_num_rows($result);

if($num !== 1 ){
    echo '<script>alert("Wrong password")</script>';
    
    echo '<script>window.location="tdb.php"</script>';
}else if($new_pass !== $con_pass){
    echo '<script>alert("New password and Confirm password does not match")</script>';
    echo '<script>window.location="tdb.php"</script>';
}else{
    $sel = "SELECT * from tenant where tenant_id = '$id' AND password = '$password' ";
    $res =  mysqli_query($conn, $sel);
    if(mysqli_num_rows($res) == 1){
        $sql_2 = "UPDATE tenant SET password='$new_pass' WHERE tenant_id='$id'";
        	mysqli_query($conn, $sql_2);

            echo '<script>alert("Password changed)</script>';
            echo '<script>window.location="tdb.php"</script>';
            
        	
	        exit();
    }
}

// if(count($_POST)>0) {
// mysqli_query($conn,"UPDATE tenant set username='" . $_POST['username'] . "', 
// password='" . $_POST['password'] . "'  , email='" . $_POST['email'] . "' , phone_num='" . $_POST['phone'] . "'  where tenant_id='" . $_SESSION['id']  ."'");
// $message = "Data changed successfully, logout to apply changes";
// }

// $result = mysqli_query($conn,"SELECT * FROM tenant WHERE tenant_id='" . $_SESSION['id']  ."'");
// $row= mysqli_fetch_array($result);
?>