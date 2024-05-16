<?php

$con = mysqli_connect('localhost','root');
if($con){
    echo"connection successfull";
} else{ "connection not successfull";
} 
mysqli_select_db($con,'pet agency');

$name= $_POST['name'];
$email= $_POST['email'];
$mobile= $_POST['mobile'];
$address=$_POST['address'];
$city=$_POST['city'];
$species=$_POST['species'];

$query = "insert into userinfo (name, email, mobile, address, city,species) VALUES ('$name','$email','$mobile','$address','$city','$species') ";
 mysqli_query($con,$query);
 
header('location:index.php');

?>