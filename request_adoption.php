<?php
    session_start();
    require('handlers/dbHandler.php');
    global $petTable,$notifications;
    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized access");
    }
    isNotificationTableExists();
    $pdo = getPDOConnection();
    $user_id = $_SESSION['user_id'];
    $pet_id = $_POST['pet_id'];
    $owner_id_query = $pdo->prepare("SELECT owner_id FROM $petTable WHERE id = ?");
    $owner_id_query->execute([$pet_id]);
    $owner_id = $owner_id_query->fetchColumn();

    if ($owner_id) {
        // Insert adoption request
        $adoption_query = $pdo->prepare("UPDATE $petTable SET adopter_id = ? WHERE id = ?");
        $adoption_query->execute([$user_id, $pet_id]);

        // Insert notification
        if(getUserNameById($user_id)){
            $message = getUserNameByID($user_id) . " is requesting to adopt your pet.";
        }
        $notification_query = $pdo->prepare("INSERT INTO $notifications (user_id, message, pet_id) VALUES (?, ?, ?)");
        $notification_query->execute([$owner_id, $message, $pet_id]);

        echo "Adoption request sent and notification created.";
    } else {
        echo "Pet not found.";
    }
?>
