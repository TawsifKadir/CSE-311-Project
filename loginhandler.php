<?php
    require('handlers/dbHandler.php');

    $username = $_POST['name'];
    $password = $_POST['password'];

    if(verifyUserLogin($username,$password)){
        header('location:dashboard.php');
    }

?>