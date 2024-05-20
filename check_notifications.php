<?php
session_start();
require 'handlers/dbHandler.php';

global $db,$notification,$userTable;

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$pdo = getPDOConnection();

try {
    // Fetch notifications with user profile pictures
    $notifications_query = $pdo->prepare("
    SELECT 
    n.id AS notification_id,
    n.pet_id as pet_id,
    n.message,
    n.created_at,
    u.id AS user_id,
    u.username,
    u.profile_image
    FROM 
        $notifications n
    JOIN 
        $userTable u ON n.sender_id = u.id
    WHERE 
        n.user_id = :user_id
    ORDER BY 
        n.created_at DESC
    LIMIT :limit OFFSET :offset
    ");
    $notifications_query->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $notifications_query->bindValue(':limit', $limit, PDO::PARAM_INT);
    $notifications_query->bindValue(':offset', $offset, PDO::PARAM_INT);
    $notifications_query->execute();
    $notifications = $notifications_query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($notifications as &$notification) {
        $notification['profile_image'] = !empty($notification['profile_image']) ? base64_encode($notification['profile_image']) : null;
    }

    echo json_encode($notifications);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
