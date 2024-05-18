<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php

    require('handlers/dbHandler.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $user = getUserByID($id);
    } else {
        echo 'Invalid request.';
        exit();
    }
    session_start();

    require('includes/dependencies.php');
    ?>
</head>

<body>
    <?php
    include('utils/navigationbarlogin.php');
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
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
            <div class="col-md-8">
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
                <div style="text-align: center;">
                    <a href="item_details_adopter.php?id=<?php echo $id; ?>" class="btn btn-primary" style="margin-top: 20px; width:30%; ">Back</a>
                    <a href="chatbox.php?id=<?php echo $id; ?>" class="btn btn-success" style="margin-top: 20px; width:30%; ">Message</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>