	
<?php
include_once "connect.php";
if(isset($_POST['submit'])){
    
	$username = $_POST['username'];
	$passwords = $_POST['password'];
	$sql = "SELECT * FROM `landlord`WHERE username = '$username'&& password = '$passwords'";
	$result = mysqli_query($conn, $sql);
	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$id = $row['id'];
			$user= $row['username'];
			$passwords = $row['password'];
			
			
}	
}
}
 echo '<tr>
<th scope="row">'.$user.'</th>
<th scope="row">'.$passwords.'</th>


<td>
<button class = "btn btn-primary"><a href="editaccprocess.php?updateid='.$id.'" class = "text-light">Update</a></button>
</td>
</tr>';?>


<footer><div id="greenyellowfoot"></footer>
</body>
</html>