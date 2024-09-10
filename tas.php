<?php
include_once 'connect.php';
session_start();



if(count($_POST)>0) {
mysqli_query($conn,"UPDATE tenant set username='" . $_POST['username'] . "', 
password='" . $_POST['password'] . "'  , email='" . $_POST['email'] . "' , phone_num='" . $_POST['phone'] . "'  where tenant_id='" . $_SESSION['id']  ."'");
$message = "Data changed successfully, logout to apply changes";
}

$result = mysqli_query($conn,"SELECT * FROM tenant WHERE tenant_id='" . $_SESSION['id']  ."'");
$row= mysqli_fetch_array($result);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenants</title>
    <link rel="stylesheet" href="tas.css">
</head>
<body>
<div class="container">
        <div class="sidebar">
            <div class="URent">
                <img src="urentlogo.png" alt="logo Image">
                <p class="logo-text">URent</p>
                <p><?php echo $_SESSION['user']; ?></p>
            </div>
            <ul>
                <li><a href="tdb.php">Dashboard</a></li>
                <li><a href="php">Water Bill</a></li>
                <li><a href="php" class="active">Electricity Bill</a></li>
                <li><a href="php" class="active">Rent Bill</a></li>
                <li><a href="php" class="active">Account Setting</a></li>
                <li><a href="tlogout.php" class="active">Log out</a></li>
            </ul>
        </div>
<title>editacc page</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">

</div>

Name: <br>
<input type="text" name="username" class="txtField" autocomplete ="off" value="<?php echo $_SESSION['user']; ?>">
<br>
Pass:<br>
<input type="text" name="password" class="txtField" autocomplete ="off" value="<?php echo $_SESSION['password']; ?>">
<br>
Email Address:<br>
<input type="text" name="email" class="txtField" autocomplete ="off" value="<?php echo $_SESSION['email']; ?>">
<br>
Contact Number:<br>
<input type="number" name="phone" autocomplete ="off" value="<?php echo $_SESSION['phone']; ?>">
<br>
<br>
<br>

<br>
<input href type="submit" name="Update Password" value="Update Password" class="buttom">
<a href="tlogout.php"> LOGOUT</a>




</form>
</body>
</html>

