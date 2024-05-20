<?php
    session_start();
    require('handlers/dbHandler.php');
    global $petTable,$notifications;
    if(!isset($_SESSION['user_id'])){
        header('location:login.php');
        exit();
    }
    isNotificationTableExists();
    $pdo = getPDOConnection();
    $user_id = $_SESSION['user_id'];
    $pet_id = $_POST['pet_id'];
    $action = $_POST['action'];
    $owner_id_query = $pdo->prepare("SELECT owner_id FROM $petTable WHERE id = ?");
    $owner_id_query->execute([$pet_id]);
    $owner_id = $owner_id_query->fetchColumn();

    if ($owner_id) {
        // Insert adoption request
        if($action === 'request_adoption'){
        try{
            $adoption_query = $pdo->prepare("UPDATE $petTable SET adopter_id = ? WHERE id = ?");
            $adoption_query->execute([$user_id, $pet_id]);

            // Insert notification
            if(getUserNameById($user_id)){
                $message = getUserNameByID($user_id) . " is requesting to adopt your pet.";
            }
            $notification_query = $pdo->prepare("INSERT INTO $notifications (user_id, message, pet_id, sender_id) VALUES (?, ?, ?,?)");
            $notification_query->execute([$owner_id, $message, $pet_id, $user_id]);

            echo "Adoption request sent and notification created.";
        }catch(Exception $e){
            echo $e;
        }
            
        }elseif($action === 'cancel_adoption'){
            try{
                    $update_query = $pdo->prepare("UPDATE $petTable SET adopter_id = NULL WHERE id = ? AND adopter_id = ?");
                    $update_query->execute([$pet_id, $user_id]);

                    if ($update_query->rowCount() > 0) {
                        // Optionally, delete related notifications
                        $delete_notifications_query = $pdo->prepare("DELETE FROM $notifications WHERE pet_id = ?");
                        $delete_notifications_query->execute([$pet_id]);

    } else {
        echo 'error';
    }
            }catch(PDOException $e){
                echo $e;
            }
            
        }
        
    } else {
        echo "Pet not found.";
    }
?>
