<?php

    require('handlers/dbHandler.php');

    //inputs
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_password = $_POST['password_repeat'];
    $phone = $_POST['mobile'];
    $address = $_POST['address'];
    $description = $_POST['description'];

    if(validateForm()){
        createDatabase();
        if(insertIntoUsersTable($name,$username,$email,$password,$phone,$address,$description)){
            goToDashboard();
        }else{
            
        }
    }else{
        echo 'Invalid username or password';
    }


    function validateForm(){
        return isValidEmail() && isValidPhoneNumber() &&validatePassword();
    }

    function isValidPhoneNumber() {
        global $phone;
        $regex = '/^\+?[1-9]\d{1,14}$/';
    
        // Use preg_match to check if the phone number matches the regex pattern
        if (preg_match($regex, $phone)) {
            return true;
        } else {
            echo 'Invalid Phone number';
            return false;
        }
    }

    function isValidEmail() {
        // Regular expression for validating an email
        global $email;
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    
        if (preg_match($regex, $email)) {
            return true;
        } else {
            echo 'Invalid Email';
            return false;
        }
    }
    function validatePassword(){
        global $password,$conf_password;
        if($password == null || $password == ""){
            return false;
        }
        if($password === $conf_password){
            return true;
        }else{
            echo 'Invalid Password';
            return false;
        }
    }
    function goToDashboard(){
        header('location: dashboard.php');
    }

?>  