<?php
    session_start();
    require('handlers/dbHandler.php');
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_SESSION['user_id'];
    $image = file_get_contents($_FILES['imageInput']['tmp_name']);

        if(insertIntoPetsTable($name,$description,$image,$id,null)){
            goToYourPets();
        }else{

        }

    function goToYourPets(){
        header('location: pet_list_user.php');
    }
?>