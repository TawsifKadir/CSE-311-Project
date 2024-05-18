<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Box with Image, Name, and Input</title>
    <link rel="stylesheet" href="styles/chatbox.css">
    <?php
        require('includes/dependencies.php');
        require('handlers/dbHandler.php');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $recipient = getUserByID($id);
        } else {
            echo 'Invalid request.';
            exit();
        }

        session_start();
    ?>
</head>
<body>

    <?php
        require('utils/navigationbarlogin.php');
    ?>
    <div class="box-holder">
        <div class="centered-box">
            <div class="header">
                <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left"></i></a>
                <a href="usercontact.php?id=<?php echo $recipient['id']; ?>" class="profile-link">
                    <?php if ($recipient['profile_image']) : ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($recipient['profile_image']); ?>" alt="Profile Image" class="profile-image">
                    <?php else : ?>
                        <img src="images/placeholder.jpg" alt="Profile Image" class="profile-image">
                    <?php endif; ?>
                </a>
                
                <span class="name"><?php echo htmlspecialchars($recipient['username']); ?></span>
            </div>
            <div class="content">
                <!-- Add your scrollable content here -->
                <div class="content-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac libero a justo interdum malesuada. Quisque consectetur velit sed justo vehicula, ac posuere ligula dignissim.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac libero a justo interdum malesuada. Quisque consectetur velit sed justo vehicula, ac posuere ligula dignissim.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac libero a justo interdum malesuada. Quisque consectetur velit sed justo vehicula, ac posuere ligula dignissim.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac libero a justo interdum malesuada. Quisque consectetur velit sed justo vehicula, ac posuere ligula dignissim.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac libero a justo interdum malesuada. Quisque consectetur velit sed justo vehicula, ac posuere ligula dignissim.</p>
                </div>
            </div>
            <div class="footer">
                <input type="text" placeholder="Type here..." class="input-box">
                <button class="send-button"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>

    </div>

</body>
</html>
