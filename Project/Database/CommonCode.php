<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if none exists
} // Start session management

// Step 1: Set the default language if not already set
if (!isset($_SESSION["language"])) {
    $_SESSION["language"] = "EN"; // Default language is English
}

// Step 2: Allow language switching via GET parameter
if (isset($_GET["language"])) {
    $_SESSION["language"] = $_GET["language"];
}

// Step 3: Load translations from NavBarTranslation.csv
$arrayOfStrings = []; // Array to store translations

$fileTranslations = fopen("../Database/NavBarTranslation.csv", "r");
$header = fgets($fileTranslations); // Skip the first row (header)

while (!feof($fileTranslations)) {
    $line = fgets($fileTranslations);
    $arrayOfPieces = explode(",", $line); // Split the line by commas
    if (count($arrayOfPieces) >= 3) { // Ensure the line has enough fields
        $arrayOfStrings[$arrayOfPieces[0]] = ($_SESSION["language"] == "EN")
            ? $arrayOfPieces[1] // English column
            : $arrayOfPieces[2]; // French column
    }
}
fclose($fileTranslations); // Close the file

// Step 4: Navigation bar function
function commoncodeNA($PageOpen)
{
    echo '<link rel="stylesheet" href="../Design/Cake.css">';
    global $arrayOfStrings;

    // Calculate total cart items
    $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
    <div class="NavAll">
        <div class="TopNav">
            <div class="MainLinks">
                <a href="../Pages/Home.php" <?php if ($PageOpen == "Home") {
                                                print("class='active'");
                                            } ?>><?php echo $arrayOfStrings["Home"]; ?></a>
                <a href="../Pages/About.php" <?php if ($PageOpen == "About") {
                                                    print("class='active'");
                                                } ?>><?php echo $arrayOfStrings["About"]; ?></a>
                <a href="../Pages/Products.php" <?php if ($PageOpen == "Products") {
                                                    print("class='active'");
                                                } ?>><?php echo $arrayOfStrings["Products"]; ?></a>
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="../Pages/AddProduct.php" <?php if ($PageOpen == "AddProduct") {
                                                            print("class='active'");
                                                        } ?>><?php echo $arrayOfStrings["AddProduct"]; ?></a>
                    <a href="../Pages/Orders.php" <?php if ($PageOpen == "Orders") {
                                                        print("class='active'");
                                                    } ?>><?php echo $arrayOfStrings["Orders"]; ?></a>
                <?php endif; ?>

                <?php if (!isset($_SESSION['username'])): ?>
                    <a href="../Pages/Regester.php" <?php if ($PageOpen == "Register") {
                                                        print("class='active'");
                                                    } ?>><?php echo $arrayOfStrings["Register"]; ?></a>
                    <a href="../Pages/Login.php" <?php if ($PageOpen == "Login") {
                                                        print("class='active'");
                                                    } ?>><?php echo $arrayOfStrings["Login"]; ?></a>
                <?php else: ?>
                    <a href="../Pages/Logout.php" style="margin-left: 10px;"><?php echo $arrayOfStrings["Logout"]; ?></a>
                <?php endif; ?>
            </div>

            <div class="Icon">
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'customer'): ?>

                    <!-- Cart link with item count -->
                    <a href="../Pages/Cart.php" <?php if ($PageOpen == "Cart") {
                                                    print("class='active'");
                                                } ?>>
                        <?php echo $arrayOfStrings["Cart"]; ?> 🛒 (<?= $cartCount ?>)
                    </a>
                <?php endif; ?>
                <?php if (isset($_SESSION['username'])): ?>
                    <span style="margin-left: 10px;">
                        👤 <?php echo $arrayOfStrings["Welcome"] . " " . htmlspecialchars($_SESSION['username']); ?>
                    </span>
                <?php else: ?>
                    <span style="margin-left: 10px;">
                        👤 <?php echo $arrayOfStrings["Unknown"]; ?>
                    </span>
                <?php endif; ?>
                <div class="language-selector">
                    <form method="GET" style="margin: 0;">
                        <select name="language" onchange="this.form.submit()">
                            <option value="EN" <?php if ($_SESSION["language"] == "EN") echo "selected"; ?>>English</option>
                            <option value="FR" <?php if ($_SESSION["language"] == "FR") echo "selected"; ?>>French</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}



// Additional functions for user management
$registrationSuccessful = false;

function userExists($checkUser) // Check if the user already exists
{
    $fileUser = fopen("../Database/client.csv", "r"); // Open the file for reading
    while (!feof($fileUser)) {
        $existingUser = fgets($fileUser);
        $existingArray = explode(";", $existingUser);
        if ($existingArray[0] == $checkUser) {
            return true; // User exists
        }
    }
    fclose($fileUser);
    return false; // User does not exist
}

function passwordmatch($checkUser, $checkpassword) // Check if the password matches
{
    $fileUser = fopen("../Database/client.csv", "r");
    while (!feof($fileUser)) {
        $existingUser = fgets($fileUser);
        $existingArray = explode(";", $existingUser);
        if ($existingArray[0] == $checkUser) {
            if ($existingArray[1] == $checkpassword)
                return true; // Match found
        }
    }
    fclose($fileUser);
    return false; // No match found
}

function getUserRole($username) // Retrieve the role of a user
{
    $fileUser = fopen("../Database/client.csv", "r");
    while (!feof($fileUser)) {
        $line = fgets($fileUser);
        $data = explode(";", $line);
        if ($data[0] === $username) {
            fclose($fileUser);
            return trim($data[2]); // Assuming the role is the third column
        }
    }
    fclose($fileUser);
    return "customer"; // Default role
}

function loginUser($username, $role) // Login the user
{
    $_SESSION['username'] = $username; // Set session username
    $_SESSION['role'] = $role;        // Set session role
}

function logoutUser() // Logout the user
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset(); // Unset all session values
    session_destroy();  // Destroy the session
    header("Location: Home.php");
    exit();
}
?>