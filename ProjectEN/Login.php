<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake</title>
    <link rel="stylesheet" href="../Cake.css?<?= time() ?>">

</head>

<body>

    <?php
    include_once("CommonCode.php");
    commoncodeNA("Login")
    ?>

    <form method="POST">
        <div class="login-wrapper">
            <div class="loginContaner">
                <div class="form_group">
                    <input type="text" name="UserNmae" placeholder="Enter your username">
                </div>
                <div class="form_group">
                    <input type="password" name="psw" placeholder="Enter your password">
                </div>

                <div class="form_group">
                    <input type="submit" value="Login">
                </div>
                <div class="additional-options">
                    <p><a href="#">Forgot your password?</a></p>
                </div>


            </div>
        </div>
    </form>
</body>

</html>