<?php

session_start();
include_once 'connect.php';

$name = $_POST['user'];
$password = $_POST['password'];

$s = " select * from landlord where username = '$name' && password = '$password'";

$result = mysqli_query($conn, $s);

$num = mysqli_num_rows($result);

	
if( $num == 1){
	$_SESSION['user'] = $name;
	$_SESSION['password'] = $password;
    $_SESSION['id']=$id;
	header('location:lldb.php');
}else{
	echo '<script>alert("Wrong username or password")</script>';
	echo '<script>window.location="lnlogin.php"</script>';

}


?>
