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
    session_start();
    include_once("CommonCode.php");
    commoncodeNA("Login");

    if (isset($_POST["username"], $_POST["password"])) {
        $newpassword =  str_replace(";", "", $_POST["password"]);

        if (passwordmatch($_POST["username"],  $newpassword)) {
            $_SESSION["username"] = $_POST["username"]; // store the username in the session
            header("Location: Home.php"); // this code is to redirect the user to the home page
            exit();
        } else {
            $feedbackMessage = "Invalid username or password. Please try again:)";
        }
    }


    ?>
    <?php if (!empty($feedbackMessage)): ?>
        <p style="color: red; text-align: center;"><?= htmlspecialchars($feedbackMessage) ?></p>
    <?php endif; ?>
    <div class="form-container">
        <form method="POST">
            <div class="regesterform">
                <input type="text" name="username" placeholder="Enter your username" required>
            </div>
            <div class="regesterform">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="regesterform">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>

</body>

</html>