
<style>


    .custom-dropdown-menu {
        background-color: #343a40; /* Dark background color */
        color: #ffffff; /* White text color */
        width: 100px;
    }


    .wide-dropdown {
        width: 230px; /* Set the desired width */
        margin-top: 21px;
    }

    .dropdown-item{
        color: rgba(255, 255, 255, .5);
        font-size: 14px;
    }

    .dropdown-item:hover{
        color: #f8f9fa;
    }

    .custom-dropdown-menu .dropdown-item {
        white-space: normal; /* Allow text to wrap */
    }

    .custom-dropdown-menu .dropdown-item:hover {
        background-color: #495057; /* Slightly lighter background on hover */
    }
    .login_move {
        padding-right: 5%;
    }

    .title {
        padding-left: 3%;
        color: #f2ebeb;
    }
    .icon-link {
    margin-right: 40px;
    color: #fff; /* White color for the icons */
    text-decoration: none;
    font-size: 20px;
    position: relative;
    padding: 0 10px;
}
    .profile-link {
        margin-left: 10px; /* Space between icons and profile image */
        margin-right: 10px;
    }
    .icon-link i {
        font-size: 20px;
    }

    .icon-link .badge {
        position: absolute;
        top: -5px;
        right: -10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 2px 5px;
        font-size: 10px;
    }

    .navbar-icons {
    display: flex;
    align-items: center;
    }

    .icon-group {
        display: flex;
        align-items: center;
    }

    .navbar-nav .nav-link {
        font-size: 18px; /* Make the navbar items text smaller */
        padding-left: 20px; /* More padding to the left for each item */
    }

    /* Custom styling for navbar-toggler */
    .custom-toggler {
        width: 40px; /* Smaller width for the toggler */
        margin-right: 15px; /* Position toggler on the right side */
    }

    /* Dark theme for navbar-collapse */
    .navbar-collapse.navbar-dark-theme {
        background-color: #343a40; /* Dark background color */
    }

    .navbar-collapse.navbar-dark-theme .nav-link {
        color: #ffffff; /* White text color for links */
    }

    .navbar-collapse.navbar-dark-theme .nav-link:hover {
        color: #cccccc; /* Light gray color on hover */
    }
</style>


    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">My Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="petRegister.php">Post a pet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pet_list.php">Adopt a pet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pet_list_user.php">Your Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logout">Logout</a>
                </li>
            </ul>

        </div>

            <div class="navbar-icons ml-auto" style="margin-right: 80px;">
                <div class="icon-group">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle icon-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-dark custom-dropdown-menu wide-dropdown" aria-labelledby="navbarDropdown">
                            <div id="notifications">
                                <!-- Notifications will be dynamically loaded here -->
                            </div>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle icon-link" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-dark custom-dropdown-menu wide-dropdown" aria-labelledby="messageDropdown">
                            <a class="dropdown-item" href="#">Message 1</a>
                            <a class="dropdown-item" href="#">Message 2</a>
                            <a class="dropdown-item" href="#">Message 3</a>
                        </div>
                    </div>
                </div>
                <a href="profile.php">
                    <?php if (isset($_SESSION['profile_image'])) : ?>
                        <img src="data:image/jpeg;base64,<?php echo $_SESSION['profile_image']; ?>" alt="Profile Image" class="rounded-circle" style="width: 60px; height: 60px;">
                    <?php else : ?>
                        <img src="images/placeholder.jpg" alt="Default Profile Image" class="rounded-circle" style="width: 80px; height: 80px;">
                    <?php endif; ?>
                </a>
            </div>
        <script>
            document.getElementById('logout').addEventListener('click', function() {
                window.location.href = 'logout.php';
            });
        </script>
        <script src="notifications.js" defer></script>

    </nav>

    