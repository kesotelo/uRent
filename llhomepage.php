<?php
include_once 'connect.php';
session_start();


?>


<html>
<body>
<p class="alignleft">&nbsp;&nbsp;&nbsp; Welcome,&nbsp;<?php echo $_SESSION['user'];?> 

<br>
<br>
<a href ="lnedit.php">change password</a>
<br>
<br>

<a href = "lnlogout.php">logout</a>
</body>
</html> 