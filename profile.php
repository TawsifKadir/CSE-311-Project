<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
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
                        <img src="path/to/profile-image.jpg" class="card-img-top" alt="Profile Image">
                        <div class="card-body text-center">
                            <h5 class="card-title" id="profile-name">John Doe</h5>
                            <p class="card-text" id="profile-title">Software Engineer</p>
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
                            <p class="card-text" id="profile-about">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vehicula...</p>
                            <h5 class="card-title">Contact Information</h5>
                            <p class="card-text">
                                <strong>Email:</strong> <span id="profile-email">john.doe@example.com</span><br>
                                <strong>Phone:</strong> <span id="profile-phone">+123456789</span><br>
                                <strong>Address:</strong> <span id="profile-address">1234 Main St, Anytown, USA</span>
                            </p>
                            <h5 class="card-title">Skills</h5>
                            <ul class="list-group list-group-flush" id="profile-skills">
                                <li class="list-group-item">JavaScript</li>
                                <li class="list-group-item">Python</li>
                                <li class="list-group-item">Java</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>