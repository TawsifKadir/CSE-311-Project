<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Box with Image, Name, and Input</title>
    <link rel="stylesheet" href="styles/chatbox.css">
    <link rel="stylesheet" href="styles/animations.css">
    <?php
        require('includes/dependencies.php');
        require('handlers/dbHandler.php');

        session_start();

        if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            exit();
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $recipient = getUserByID($id);
            $sender_id = $_SESSION['user_id'];
        } else {
            echo 'Invalid request.';
            exit();
        }

    ?>
</head>
<body>

    
    <div class="box-holder">
        <?php
            require('utils/navigationbarlogin.php');
        ?>
        <div class="centered-box drop-from-top" data-user-id="<?php echo htmlspecialchars($sender_id);?>" data-recipient-id="<?php echo htmlspecialchars($id); ?>">
            <div class="header">
                <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left grow"></i></a>
                <a href="usercontact.php?id=<?php echo $recipient['id']; ?>" class="profile-link">
                    <?php if ($recipient['profile_image']) : ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($recipient['profile_image']); ?>" alt="Profile Image" class="profile-image grow">
                    <?php else : ?>
                        <img src="images/placeholder.jpg" alt="Profile Image" class="profile-image grow">
                    <?php endif; ?>
                </a>
                
                <span class="name"><?php echo htmlspecialchars($recipient['username']); ?></span>
            </div>
            <div class="content" id="content">
                <!-- Messages will be dynamically loaded here -->
            </div>
            <div class="footer">
                <input type="text" placeholder="Type here..." class="input-box" id="input-box">
                <button class="send-button grow" id="send-button"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>

    </div>
    <script src="chatoboxScript.js"></script>
    <?php
        require('utils/footer.php');
    ?>
</body>
</html>
