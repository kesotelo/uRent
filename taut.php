<?php

session_start();
include_once 'connect.php';

$name = $_POST['user'];
$password = $_POST['password'];

$s = " select * from tenant where username = '$name' && password = '$password'";

$result = mysqli_query($conn, $s);

$num = mysqli_num_rows($result);

	
if( $num == 1){
	$row = mysqli_fetch_assoc($result);
	$_SESSION['user'] = $name;
	$_SESSION['password'] = $password;
	$_SESSION['id']=$row['tenant_id'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['phone'] = $row['phone_num'];
	header('location:tdb.php');
}else{
	echo '<script>alert("Wrong username or password")</script>';
	echo '<script>window.location="tlogin.php"</script>';

}


?>
