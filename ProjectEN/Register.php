<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cake.css?= time() ?>">
    <title>Cake</title>
</head>

<body>
<?php

function userExists($username) {
    $fileUsers = fopen("Clients.csv", "r");
    if ($fileUsers) {
        while (($line = fgetcsv($fileUsers, 1000, ";")) !== false) {
            if ($line[0] === $username) { 
                fclose($fileUsers);
                return true;
            }
        }
        fclose($fileUsers);
    }
    return false;
}

if (isset($_POST["userName"], $_POST["psw"], $_POST["pswAgain"])) {
    print("Registration in progress ...");

    if (userExists($_POST["userName"])) {
        print("Username already exists. Please choose a different username.");
    } elseif ($_POST["psw"] === $_POST["pswAgain"]) {
        $fileUsers = fopen("Clients.csv", "a");
        fputs($fileUsers, "\n" . $_POST["userName"] . ";" . $_POST["psw"]);
        fclose($fileUsers);
        print("Registration successful!");
    } else {
        print("Passwords do not match. Please try again !");
    }
}

include_once("CommonCode.php");
commoncodeNA("Register");

?>

<h1>register</h1>


<form method="POST" class="re">
    <input type="text" name="userName" placeholder="Enter your username" />
    <input type="password" name="psw" placeholder="Please choose a password" />
    <input type="password" name="pswAgain" placeholder="Please type the password again" />
    <input type="submit" value="Create account" />
</form>


</body>

</html>