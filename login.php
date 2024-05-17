<!DOCTYPE html>
<html>
    <head>
        <title> pet agency </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
            require('includes/dependencies.php');
        ?>
    </head>

    <body>

        <?php
        include('utils/navigationbar.php')
        ?>

        <section class="my-5">
            <div class= "py-5">
                <h1 class = text-center > Login</h1>
            </div>
            <div class = "w-50 m-auto">
                <form action="loginhandler.php" method="POST">
                    <div class = "form-group">
                        <level> Username</level>
                        <input type="text" name="name" autocomplete="off" class="form-control">

                    </div>

                    <div class = "form-group">
                        <level> Password</level>
                        <input type="password" name="password" autocomplete="off" class="form-control">

                    </div>

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <a href="#" class="text-primary">Forgot Password?</a>
                    </div>

                </form>
            </div>
        </section>
        <div class ="py-5">
        <footer>
            <p class="p-3 bg-dark text-white text-center"> fk@gamil.com</p>
        </footer>
        </div>
    </body>
</html>