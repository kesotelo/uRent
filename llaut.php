<?php

session_start();
include_once 'connect.php';

$name = $_POST['user'];
$password = $_POST['password'];

$s = " select * from landlord where username = '$name' && password = '$password'";

$result = mysqli_query($conn, $s);

$num = mysqli_num_rows($result);

	
if( $num == 1){
	$row = mysqli_fetch_assoc($result);
	$_SESSION['id']=$row['id'];
	$_SESSION['user'] = $name;
	header('location:lldb.php');
}else{
	echo '<script>alert("Wrong username or password")</script>';
	echo '<script>window.location="lllogin.php"</script>';

}


?>
