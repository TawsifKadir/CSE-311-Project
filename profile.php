<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/content.css">
    <link rel="stylesheet" href="styles/animations.css">
    <?php

    session_start();

    // Redirect to login page if the user is not logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    require('handlers/dbHandler.php');

    try {
        // Get the PDO instance
        $pdo = getPDOConnection();

        // Prepare the SQL query to get the logged-in user's information
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['user_id']);
        $stmt->execute();

        $user = $stmt->fetch();

        if (!$user) {
            // If the user does not exist, log them out
            session_unset();
            session_destroy();
            header('Location: login.php');
            exit();
        }
    } catch (PDOException $e) {
        // Store the error message in the session and redirect to the login page
        $_SESSION['error_message'] = "Database error: " . $e->getMessage();
        header('Location: login.php');
        exit();
    }
    require('includes/dependencies.php');
    ?>
</head>

<body>
    <div class="content-for-footer">
    <?php
    include('utils/navigationbarlogin.php');
    ?>
    <div class="container mt-5" style="padding-top: 70px;">
        <div class="row">
            <div class="col-md-4 slide-in">
                <div class="card">
                    <?php if ($user['profile_image']) : ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($user['profile_image']); ?>" alt="Profile Image" class="card-img-top">
                    <?php else : ?>
                        <img src="images/placeholder.jpg" alt="Profile Image" class="card-img-top">
                    <?php endif; ?>
                    <div class="card-body text-center">
                        <h5 class="card-title" id="profile-name"><?php echo htmlspecialchars($user['username']); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8 slide-in-right">
                <div class="card">
                    <div class="card-header">
                        Profile Information
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">About Me</h5>
                        <p class="card-text" id="profile-about"><?php echo htmlspecialchars($user['description']); ?></p>
                        <h5 class="card-title">Contact Information</h5>
                        <p class="card-text">
                            <strong>Email:</strong> <span id="profile-email"><?php echo htmlspecialchars($user['email']); ?></span><br>
                            <strong>Phone:</strong> <span id="profile-phone"><?php echo htmlspecialchars($user['phone_no']); ?></span><br>
                            <strong>Address:</strong> <span id="profile-address"><?php echo htmlspecialchars($user['address']); ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
        require('utils/footer.php');
    ?>
</body>

</html>