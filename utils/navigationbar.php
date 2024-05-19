
<style>

    .login_move {
        padding-right: 5%;
    }

    .title {
        padding-left: 3%;
        color: #f2ebeb;
    }
    .icon-link {
    margin-right: 15px;
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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pet.php">Our pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            </ul>

            <div class="navbar-icons ml-auto">
                <a href="login.php" class="icon-link">
                    <i class="fas fa-sign-in-alt"></i>
                </a>
            </div>
        </div>


    </nav>

    