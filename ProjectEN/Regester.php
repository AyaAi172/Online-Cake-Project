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
    commoncodeNA("Regester");


    // this code is for the registration form to check if the user entered all the information
    if (isset($_POST["username"], $_POST["password"], $_POST["confirmpassword"])) {
        print("Registration in progress..."); // If true if the user intered all the information we will print this message
        if (userExists($_POST["username"])) {// this function is to check if the user already exists
            print("Username already exists. Please choose another username:)");
        } 
       
        elseif ($_POST["password"] === $_POST["confirmpassword"]) {  
            $newpassword =  str_replace(";", "", $_POST["password"]); // this code is to replace the ; with nothing 
            // if the password match this code will run
            $fileUser = fopen("client.csv", "a"); // this code is to open the file and write the information in it
            fputs($fileUser, "\n" . $_POST["username"] . ";" . $newpassword );// this code is to write the information in the file
            fclose($fileUser);
            $registrationSuccessful = true; 
            print("Registration successful!");
        } 
        else { // if the password do not match this code will run
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