<?php
session_start();
function commoncodeNA($PageOpen)
{
?>

    <div class="NavAll">
        <div class="TopNav">
            <div class="MainLinks">
                <a href="Home.php" <?php if ($PageOpen == "Home") {
                                        print("class='active'");
                                    } ?>>Home</a>
                <a href="About.php" <?php if ($PageOpen == "About") {
                                        print("class='active'");
                                    } ?>>About</a>
                <a href="Products.php" <?php if ($PageOpen == "Products") {
                                            print("class='active'");
                                        } ?>>Products</a>
                <?php if (isset($_SESSION['username'])): ?>

                    <a href="Regester.php" <?php if ($PageOpen == "Regester") {
                                                print("class='active'");
                                            } ?>>Register</a>
                    <a href="Login.php" <?php if ($PageOpen == "Login") {
                                            print("class='active'");
                                        } ?>>Login</a>
                <?php endif; ?>



            </div>
            <div class="MainLinks">
                <!-- Existing links here -->
            </div>
            <div class="Icon">
                <a href="#" id="basketIcon"> 🛒</a>
                <?php if (isset($_SESSION['username'])): ?>
                    <span style="margin-left: 10px;">
                        👤 Welcome <?= htmlspecialchars($_SESSION['username']) ?>
                    </span>
                    <a href="Logout.php" style="margin-left: 10px;">Logout</a>
                <?php else: ?>
                    <span style="margin-left: 10px;">
                        👤 Unknown user
                    </span>
                <?php endif; ?>
                <a href="../ProjecrFR/HomeFR.php" style="margin-left: 10px;">French</a>
            </div>


        </div>
    </div>

<?php
}

$registrationSuccessful = false;

function userExists($checkUser) // this function is to check if the user already exists
{
    $fileUser = fopen("client.csv", "r"); // this code is to open the file and read the information in it
    while (!feof($fileUser)) { // this loop is to read the information in the file
        $existingUser =  fgets($fileUser); // 
        $existingArray = explode(";", $existingUser); // this code is to explode the information in the file and put it in an array
        if ($existingArray[0] == $checkUser) {
            return true;
        }
    }
    fclose($fileUser);
    return false; // this code is to return false if the user does not exist
}

function passwordmatch($checkUser, $checkpassword)
{
    $fileUser = fopen("client.csv", "r");
    while (!feof($fileUser)) {
        $existingUser =  fgets($fileUser);
        $existingArray = explode(";", $existingUser);
        if ($existingArray[0] == $checkUser) {
            if ($existingArray[1] == $checkpassword)
                return true; // match found
        }
    }
    fclose($fileUser);
    return false; // no match found after checking all the users
}

function logoutUser()
{
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to Home page
    header("Location: Home.php");
    exit();
}
?>