<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cake.css?= time() ?>">
    <title>Login</title>
</head>

<body>
    <?php
    include_once("CommonCode.php");
    commoncodeNA("Login");

    if (isset($_POST["username"], $_POST["password"])) {
        $newpassword =  str_replace(";", "", $_POST["password"]);

        if (passwordmatch($_POST["username"],  $newpassword)) {
            print("<p>Welcome" . ' ' . htmlspecialchars($_POST["username"]) . "!</p>");
        } else {
            echo "<p>Invalid username or password. Please try again.</p>";
        }
    }


    ?>

    <div class="form-container">
        <form method="POST">
            <div class="regesterform">
                <input type="text" name="username" placeholder="Enter your username" />
            </div>
            <div class="regesterform">
                <input type="password" name="password" placeholder="Enter your password" />
            </div>
            <div class="regesterform">
                <input type="submit" value="Login" />
            </div>
        </form>
    </div>
</body>

</html>