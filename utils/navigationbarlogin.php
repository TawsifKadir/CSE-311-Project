
<style>
    .navbar {
        /* padding-top: 1rem;
        padding-bottom: 1rem; */
        font-size: 1.5rem;
        padding-right: 0.5rem;
        height: 100px;
        /* Optional: Increase font size */
    }

    .login_move {
        padding-right: 5%;
    }

    .title {
        padding-left: 3%;
        color: #f2ebeb;
    }
</style>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="dashboard.php">Home</a>
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="petRegister.php">Post a pet</a>
                    <a class="dropdown-item" href="#">Adopt a pet</a>
                    <a class="dropdown-item" href="#">Your Pets</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" id="logout">Log out</a>
                </div>
            </li>
        </ul>

        <h2 class="title">FA Pet Agency</h2>

        <ul class="navbar-nav ml-auto login_move">
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                    <?php if (isset($_SESSION['profile_image'])) : ?>
                        <img src="data:image/jpeg;base64,<?php echo $_SESSION['profile_image']; ?>" alt="Profile Image" class="rounded-circle" style="width: 80px; height: 80px;">
                    <?php else : ?>
                        <img src="images/placeholder.jpg" alt="Default Profile Image" class="rounded-circle" style="width: 80px; height: 80px;">
                    <?php endif; ?>
                </a>
            </li>
        </ul>

    </div>

    <script>
        document.getElementById('logout').addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
    </script>

</nav>