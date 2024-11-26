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

    // this will check if the username. password and confirmpassword exists or not 
    if (isset($_POST["username"], $_POST["password"], $_POST["confirmpassword"])) {
        print("Registration in progress...");

        if (userExists($_POST["username"])) {
            print("Username already exists. Please choose another username:)");
        } elseif ($_POST["password"] === $_POST["confirmpassword"]) {
            $fileUser = fopen("client.csv", "a");
            fputs($fileUser, "\n" . $_POST["username"] . ";" . $_POST["password"]);
            fclose($fileUser);
            $registrationSuccessful = true;
            print("Registration successful!");
        } else {
            print("Passwords do not match. Please check and try again:)");
        }
    }

    ?>


    <?php if (!$registrationSuccessful): ?>
        <div class="form-container">
            <form method="POST">

                <div class="regesterform">
                    <input type="text" name="username" placeholder="choose a username">
                </div>
                <div class="regesterform">
                    <input type="password" name="password" placeholder="choose a password">
                </div>

                <div class="regesterform">
                    <input type="password" name="confirmpassword" placeholder="confirm password">
                </div>
                <div class="regesterform">
                    <button type="submit">Submit</button>
                </div>

            </form>
        </div>
    <?php else: ?>
        <div class="form-container">
            <p>Registration successful! <a href="Login.php">Click here to login</a>.</p>
        </div>
    <?php endif; ?>



</body>

</html>