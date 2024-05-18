<?php
require('handlers/dbHandler.php');
global $db,$chatTable;
$user_id = $_GET['user_id'];
$recipient_id = $_GET['recipient_id'];
$last_message_id = $_GET['last_message_id'];

try {
    $pdo = getPDOConnection();

    $pdo->exec("USE $db");

    $sql = "
    SELECT * FROM $chatTable
    WHERE ((sender_id = :user_id AND recipient_id = :recipient_id)
       OR (sender_id = :recipient_id AND recipient_id = :user_id))
       AND id < :last_message_id
    ORDER BY id DESC
    LIMIT 15
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':last_message_id', $last_message_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':recipient_id', $recipient_id);
    $stmt->execute();

    $messages = $stmt->fetchAll();
    echo json_encode($messages);
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
?>
