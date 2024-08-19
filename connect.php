<?php

$conn = new mysqli('localhost', 'root', '', 'urent');

if(!$conn){
    die(mysqli_error($conn)); 
}

mysqli_select_db($conn, 'urent');
?>