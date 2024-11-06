<?php
include_once 'connect.php';
session_start();

$user = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$id = $_SESSION['unique_id'];

$update = "SELECT * FROM tenant WHERE tenant_id = '$id'";

$req = mysqli_query($conn, $update);
$q = mysqli_num_rows($req);

if($q == 1){
        $up1 = "UPDATE tenant SET username='$user' , email = '$email' , phone_num = '$phone'   WHERE tenant_id='$id'";
        	mysqli_query($conn, $up1);
            echo '<script>alert("Information changed)</script>';
            echo '<script>window.location="tdb.php"</script>';
            
        	
	        exit();
    
}


// if(count($_POST)>0) {
// mysqli_query($conn,"UPDATE tenant set username='" . $_POST['username'] . "', 
// password='" . $_POST['password'] . "'  , email='" . $_POST['email'] . "' , phone_num='" . $_POST['phone'] . "'  where tenant_id='" . $_SESSION['id']  ."'");
// $message = "Data changed successfully, logout to apply changes";
// }

// $result = mysqli_query($conn,"SELECT * FROM tenant WHERE tenant_id='" . $_SESSION['id']  ."'");
// $row= mysqli_fetch_array($result);
?>