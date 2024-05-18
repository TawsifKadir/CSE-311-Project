<?php
    require('handlers/dbHandler.php');

    $data = json_decode(file_get_contents('php://input'), true);

    $user_id = $data['user_id'];
    $recipient_id = $data['recipient_id'];
    $message = $data['message'];

    try {
        global $chatTable,$db;
        isChatTableExists();
        $pdo = getPDOConnection();

        $pdo->exec("USE $db");

        $sql = "INSERT INTO $chatTable (sender_id, recipient_id, content) VALUES (:user_id, :recipient_id, :content)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':recipient_id', $recipient_id);
        $stmt->bindParam(':content', $message);
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Database error: ' . $e->getMessage();
    }
?>
