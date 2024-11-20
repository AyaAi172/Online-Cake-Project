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

    if (isset($_POST["username"], $_POST["password"], $_POST["confirmpassword"])) {
        print("Registration in progress...");

        if (userExists($_POST["username"])) {
            print("Username already exists. Please choose another username:)");
        } elseif ($_POST["password"] === $_POST["confirmpassword"]) {
            $fileUser = fopen("client.csv", "a");
            fputs($fileUser, "\n" . $_POST["username"] . ";" . $_POST["password"]);
            fclose($fileUser);
            print("Registration successful!");
        } else {
            print("Passwords do not match. Please check and try again:)");
        }
    }

    ?>
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



</body>

</html>