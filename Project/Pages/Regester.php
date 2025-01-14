<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css?= time() ?>">
    <title>Cake</title>
</head>

<body>
    <?php
    include_once("../Database/CommonCode.php");
    commoncodeNA("Register");

    $feedbackMessage = "";
    // this code is for the registration form to check if the user entered all the information
    if (isset($_POST["username"], $_POST["password"], $_POST["confirmpassword"])) {
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirmpassword"])) {
            $feedbackMessage = "All fields are required. Please fill them out:)";
        } elseif ($_POST["password"] !== $_POST["confirmpassword"]) {
            $feedbackMessage = "Passwords do not match. Please check and try again:)";
        } elseif (userExists($_POST["username"])) { // this function is to check if the user already exists
            $feedbackMessage = "Username already exists. Please choose another username:)";
        } else {
            $newpassword =  str_replace(";", "", $_POST["password"]); // this code is to replace the ; with nothing 
            // if the password match this code will run
            $fileUser = fopen("../Database/client.csv", "a");
            if (!$fileUser) {
                die("Error: Unable to open the file for writing.");
            } // this code is to open the file and write the information in it
            fputs($fileUser, "\n" . $_POST["username"] . ";" . $newpassword . ";customer"); // this code is to write the information in the file
            fclose($fileUser);
            header("Location: Login.php"); // this code is to redirect the user to the login page
            exit();
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
                <button type="submit"><?= htmlspecialchars($arrayOfStrings['Submit'] ?? 'Submit') ?></button>
            </div>

        </form>
    </div>
    <?php if (!empty($feedbackMessage)): ?>
        <p style="color: red; text-align: center;"><?= htmlspecialchars($feedbackMessage) ?></p>
    <?php endif; ?>




</body>

</html>