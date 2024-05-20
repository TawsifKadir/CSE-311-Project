<?php
session_start();
require('handlers/dbHandler.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

global $db,$userTable,$chatTable;
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

$user_id = $_SESSION['user_id'];
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$pdo = getPDOConnection();

// Fetch the latest message with each user the current user has chatted with
try{
        $chat_users_query = $pdo->prepare("
        SELECT 
            u.id AS user_id, 
            u.username, 
            u.profile_image,
            cm.content, 
            cm.created_at 
        FROM 
            $userTable u 
        JOIN 
            (
                SELECT 
                    LEAST(sender_id, recipient_id) AS user1, 
                    GREATEST(sender_id, recipient_id) AS user2, 
                    MAX(created_at) AS last_message_time 
                FROM 
                    $chatTable 
                WHERE 
                    sender_id = :user_id OR recipient_id = :user_id 
                GROUP BY 
                    LEAST(sender_id, recipient_id), GREATEST(sender_id, recipient_id)
            ) AS last_messages 
        ON 
            (u.id = last_messages.user1 OR u.id = last_messages.user2) 
        AND u.id != :user_id 
        JOIN 
            $chatTable cm 
        ON 
            cm.created_at = last_messages.last_message_time 
        AND (cm.sender_id = u.id OR cm.recipient_id = u.id)
        ORDER BY 
            cm.created_at DESC
        LIMIT :limit OFFSET :offset
    ");
    $chat_users_query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $chat_users_query->bindValue(':limit', $limit, PDO::PARAM_INT);
    $chat_users_query->bindValue(':offset', $offset, PDO::PARAM_INT);
    $chat_users_query->execute();
    $chat_users = $chat_users_query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($chat_users as &$user) {
        $user['profile_image'] = !empty($user['profile_image']) ? base64_encode($user['profile_image']) : null;
    }

    echo json_encode($chat_users);
}catch(Exception $e){
    echo json_encode(['error' => $e->getMessage()]);
}
?>