<?php
include 'connect.php';
session_start();

?>
<div class ="logindiv">
	<div class = "login-box">
	<div class="formdes">

			<font size="7" color="Black"><b>Confirm Username and Password</b></font>
			<form action = "lneditproc.php"  method = "post">

			<font color="Black">USERNAME:</font>
			<div class = "form-grplog">
			<input type = "text" name = "username" class = "form-ctrl" autocomplete="off" value = "<?php echo $_SESSION['user'];?> "reuired>
			</div>

			<font color="Black">PASSWORD:</font>
			<div class = "form-grplog">
			<input type = "password" name = "password" class = "form-ctrl" autocomplete="off" required>
			</div>
	<br>
			<button type = "submit" name= "submit" class = "button2" >Submit</button>
			</form>
	</div>
	</div>
	</div>