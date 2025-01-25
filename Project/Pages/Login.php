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
    commoncodeNA("Login");
    $feedbackMessage = ""; // Initialize feedback message

    // Check if username and password are submitted
    if (isset($_POST["username"], $_POST["password"])) {
        $username = $_POST["username"]; // Assign posted username
        $newpassword = str_replace(";", "", $_POST["password"]); // Clean posted password

        if (passwordmatch($username, $newpassword)) {
            // Get the role of the user
            $role = getUserRole($username);

            // Log in the user and set session variables
            loginUser($username, $role);

            // Redirect to the Home page
            header("Location: Home.php");
            exit();
        } else {
            // Invalid credentials feedback
            $feedbackMessage = "Invalid username or password. Please try again :)";
        }
    }
    ?>

    <!-- Display feedback message -->
    <?php if (!empty($feedbackMessage)): ?>
        <p style="color: red; text-align: center;"><?= htmlspecialchars($feedbackMessage) ?></p>
    <?php endif; ?>

    <!-- Login form -->
    <div class="form-container">
        <form method="POST">
            <div class="regesterform">
                <input type="text" name="username" placeholder="Enter your username" required>
            </div>
            <div class="regesterform">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
           
            <div class="regesterform">
                <input type="submit"><?= htmlspecialchars($arrayOfStrings['Login'] ?? 'Login') ?></input>
                
            </div>
        </form>
    </div>
</body>

</html>