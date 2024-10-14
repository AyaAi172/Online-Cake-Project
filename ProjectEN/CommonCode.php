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
                <a href="About .php" <?php if ($PageOpen == "About") {
                                            print("class='active'");
                                        } ?>>About</a>
                <a href="Products.php" <?php if ($PageOpen == "Products") {
                                            print("class='active'");
                                        } ?>>Products</a>
                <a href="Contact.php" <?php if ($PageOpen == "Contact") {
                                            print("class='active'");
                                        } ?>>Contact</a>
            </div>
            <div class="Icon">
                <img src="../img/download.jpg">
                <a href="#" id="basketIcon"> 🛒
                <a href="../ProjecrAR/HomeAR.php">Arabic</a>
            </div>

        </div>
    </div>

<?php
}
?>