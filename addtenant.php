<?php
include_once 'connect.php';


$name = $_POST['tenant-name'];
$email = $_POST['Email'];
$phone = $_POST['tenant-phone'];
$roomNumber = $_POST['tenant-room'];


$n= "SELECT * FROM tenant WHERE username = '$name'";
$n1 = mysqli_query($conn, $n);
$n2 = mysqli_num_rows($n1);

$e= "SELECT * FROM tenant WHERE  email = '$email'";
$e1 = mysqli_query($conn, $e);
$e2 = mysqli_num_rows($e1);

$p= "SELECT * FROM tenant WHERE   phone_num = '$phone'";
$p1 = mysqli_query($conn, $p);
$p2 = mysqli_num_rows($p1);

$r = "SELECT * FROM tenant WHERE  room_num = '$roomNumber'";
$r1 = mysqli_query($conn, $r);
$r2 = mysqli_num_rows($r1);


// If a record is found, prevent the new tenant from being added
if($n2){
    echo '<script>alert("Username is taken please select another one")</script>';
    echo '<script>window.location="tenants.php"</script>';
} 
else if($e2){
    echo '<script>alert("Email is taken please select another one")</script>';
    echo '<script>window.location="tenants.php"</script>';
}
else if($p2){
    echo '<script>alert("Phone is taken please select another one")</script>';
    echo '<script>window.location="tenants.php"</script>';
}
else if($r2){
    echo '<script>alert("Room is taken please select another one")</script>';
    echo '<script>window.location="tenants.php"</script>';
}   
else{
    $sql = "INSERT INTO `tenant`( `username`, `room_num`, `email`, `phone_num`) VALUES ('$name','$roomNumber','$email','$phone')";
    mysqli_query($conn, $sql);
  
    echo '<script>alert("Tenant Added")</script>';
    echo '<script>window.location="tenants.php"</script>';
    
}


?>