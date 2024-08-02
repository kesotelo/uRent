<?php
include 'connect.php';
session_start();



if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $passwords = $_POST['passwords'];
    

	$s = " SELECT * FROM tenant WHERE username = '".$_POST['username']."'";
    
    $result = mysqli_query($conn, $s);
    $num = mysqli_num_rows($result);
    if($num){
		echo '<script>alert("Username taken, please select another one")</script>';
		echo '<script>window.location="tlogin.php"</script>';
       
        
        
		
    } 
    else{
		$sql = "insert into `tenant` (username, password) values ('$username', '$passwords')";
        mysqli_query($conn, $sql);
      
        echo '<script>alert("Account Registered")</script>';
		echo '<script>window.location="tlogin.php"</script>';
        
}
}
?>
