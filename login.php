<!DOCTYPE html>
<html>

<head>
    <title> pet agency </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    session_start();
    require('includes/dependencies.php');
    require('handlers/dbHandler.php');
    ?>
</head>

<body>

    <?php
    include('utils/navigationbar.php')
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $user = verifyUserLogin($username, $password);
        if ($user != null) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            if ($user['profile_image']) {
                $_SESSION['profile_image'] = base64_encode($user['profile_image']);
            } else {
                unset($_SESSION['profile_image']);
            }
            header('location:dashboard.php');
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid email or password.";
        }
    }
    ?>
    <section class="my-5">
        <div class="py-5">
            <h1 class=text-center> Login</h1>
        </div>
        <div class="w-50 m-auto">


            <form action="login.php" method="POST">

                <?php if (isset($_SESSION['error_message'])) : ?>
                    <div class="alert alert-danger">
                        <?php
                        echo htmlspecialchars($_SESSION['error_message']);
                        unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <level> Username</level>
                    <input type="text" name="name" autocomplete="off" class="form-control">

                </div>

                <div class="form-group">
                    <level> Password</level>
                    <input type="text" name="password" autocomplete="off" class="form-control">

                </div>

                <div class="form-group d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="#" class="text-primary">Forgot Password?</a>
                </div>

            </form>
        </div>
    </section>
    <div class="py-5">
        <footer>
            <p class="p-3 bg-dark text-white text-center"> fk@gamil.com</p>
        </footer>
    </div>
</body>

</html>