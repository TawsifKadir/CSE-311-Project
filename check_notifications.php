<?php
    session_start();
    require('handlers/dbHandler.php');

    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized access");
    }
    $pdo = getPDOConnection();
    $user_id = $_SESSION['user_id'];
    $notifications_query = $pdo->prepare("SELECT * FROM $notifications WHERE user_id = ? AND read_status = 0 ORDER BY created_at DESC");
    $notifications_query->execute([$user_id]);
    $notifications = $notifications_query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($notifications);
?>
