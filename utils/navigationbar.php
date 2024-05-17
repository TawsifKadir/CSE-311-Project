

<style>
    .navbar {
            padding-top: 1rem;
            padding-bottom: 1rem;
            font-size: 1.25rem; /* Optional: Increase font size */
    } 

    .login_move{
        padding-right: 5%;
    }

    .title{
        padding-left: 2%;
        color : #f2ebeb;
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
                    <a class="dropdown-item" href="index.php">Home</a>
                    <a class="dropdown-item" href="about.php">About us</a>
                    <a class="dropdown-item" href="pet.php">Our Pets</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="register.php">Register</a>
                </div>
            </li>
        </ul>
        
        <h2 class = "title">FA Pet Agency</h2>
        
        <ul class="navbar-nav ml-auto login_move">
            <li class="nav-item">
               <a class="nav-link" href="login.php">Login</a>
            </li>
        </ul>
     
    </div>
</nav>