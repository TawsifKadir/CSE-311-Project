<?php
session_start();
require('handlers/dbHandler.php');

global $db,$petTable;

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pet_id = $_POST['pet_id'];
    $action = $_POST['action'];

    $pdo = getPDOConnection();
    $pdo->exec("USE $db");

    if ($action == 'put_up_for_adoption') {
        $update_query = $pdo->prepare("UPDATE $petTable SET up_for_adoption = TRUE WHERE id = ? AND owner_id = ?");
        $update_query->execute([$pet_id, $user_id]);
        echo 'success';
    } elseif ($action == 'cancel_adoption') {
        $update_query = $pdo->prepare("UPDATE $petTable SET up_for_adoption = FALSE WHERE id = ? AND owner_id = ?");
        $update_query->execute([$pet_id, $user_id]);
        echo 'success';
    } else {
        echo 'invalid_action';
    }
} else {
    echo 'invalid_request';
}
?>
