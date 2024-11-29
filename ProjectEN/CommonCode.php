<?php
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

                <a href="Regester.php" <?php if ($PageOpen == "Regester") {
                                            print("class='active'");
                                        } ?>>Regester</a>
                <a href="Login.php" <?php if ($PageOpen == "Login") {
                                        print("class='active'");
                                    } ?>>Login</a>
            </div>
            <div class="Icon">
                <a href="#" id="basketIcon"> 🛒
                    <a href="../ProjecrFR/HomeFR.php">French</a>
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



?>