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
    $loginSuccessful = false;

    if (isset($_POST["username"], $_POST["password"])) {
        if (($file = fopen("client.csv", "r")) !== false) {
            while (($line = fgetcsv($file, 100, ";")) !== false) {
                if ($line[0] === $_POST["username"] && $line[1] === $_POST["password"]) {
                    $loginSuccessful = true;
                    break;
                }
            }
            fclose($file);
        }


        if ($loginSuccessful) {
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