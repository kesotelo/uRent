<?php
$conn = new mysqli('localhost', 'root', '', 'urent');

// Check connection
if(!$conn){
    die(mysqli_error($conn)); 
}

mysqli_select_db($conn, 'urent');
?>
