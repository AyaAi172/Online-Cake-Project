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

    function authenticateUser($username, $password) {
        $fileUsers = fopen("Clients.csv", "r");
        if ($fileUsers) {
            while (($line = fgetcsv($fileUsers, 1000, ";")) !== false) {
                if ($line[0] === $username && $line[1] === $password) { 
                    fclose($fileUsers);
                    return true;
                }
            }
            fclose($fileUsers);
        }
        return false;
    }

    if (isset($_POST["userName"], $_POST["psw"])) {
        if (authenticateUser($_POST["userName"], $_POST["psw"])) {
            print("Login successful!");
        } else {
            print("Invalid username or password. Please try again.");
        }
    }

    include_once("CommonCode.php");
    commoncodeNA("Login");

    ?>

    <h1>Login</h1>

    <form method="POST">
        <div class="form-group">
            <input type="text" name="userName" placeholder="Enter your username" />
        </div>
        <div class="form-group">
            <input type="password" name="psw" placeholder="Enter your password" />
        </div>
        <div class="form-group">
            <input type="submit" value="Login" />
        </div>
    </form>
</body>

</html>
