<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cake.css?= time() ?>">
    <title>Register</title>
</head>

<body>
    <?php

    include_once("CommonCode.php");
    commoncodeNA("Register");

    ?>
    <div class="form-container">
        <form method="POST">

            <div class="regesterform">
                <input type="text" name="username" placeholder="choose a username">
            </div>
s
            <div class="regesterform">
                <input type="password" name="password" placeholder="choose a password">
            </div>

            <div class="regesterform">
                <input type="password" name="password" placeholder="confirm password">
            </div>
            <div class="regesterform">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>



</body>

</html>