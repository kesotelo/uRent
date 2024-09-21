<?php
include_once 'connect.php';
session_start();



if(count($_POST)>0) {
mysqli_query($conn,"UPDATE tenant set username='" . $_POST['username'] . "', 
password='" . $_POST['password'] . "'  ,email='$emailaddress', contact='$contactnumber' where id='$id'");
$message = "Data changed successfully, logout to apply changes";
}

$result = mysqli_query($conn,"SELECT * FROM tenant WHERE id='" . $_SESSION['id']  ."'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<title>editacc page</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">

</div>

Name: <br>
<input type="text" name="username" class="txtField" value="<?php echo $row['username']; ?>">
<br>
Pass:<br>
<input type="text" name="password" class="txtField" value="<?php echo $row['passwords']; ?>">
<br>
Email Address:<br>
<input type="text" name="emailaddress" class="txtField" value="<?php echo $row['emailaddress']; ?>">
<br>
Contact Number:<br>
<input type="text" name="contactnumber" class="txtField" value="<?php echo $row['contactnumber']; ?>">
<br>
Shipping Address:<br>
<input type="text" name="address" class="txtField" value="<?php echo $row['address']; ?>">
<br>
<br>

<br>
<input href type="submit" name="submit" value="Submit" class="buttom">
<a href="logout.php"> LOGOUT</a>




</form>
</body>
</html>

