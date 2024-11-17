<?php
function commoncodeNA($PageOpen)
{
?>

    <div class="NavAll">
        <div class="TopNav">
            <div class="MainLinks">
                <a href="HomeFR.php" <?php if ($PageOpen == "HomeFR") {
                                            print("class='active'");
                                        } ?>> ACCUEIL </a>
                <a href="AboutFR.php" <?php if ($PageOpen == "AboutFR") {
                                            print("class='active'");
                                        } ?>>À PROPOS</a>
                <a href="ProductsFR.php" <?php if ($PageOpen == "ProductsFR") {
                                                print("class='active'");
                                            } ?>>PRODUITS</a>
                <a href="ContactFR.php" <?php if ($PageOpen == "ContactFR") {
                                            print("class='active'");
                                        } ?>>CONTACT</a>
            </div>
            <div class="Icon">
                <a href="#" id="basketIcon"> 🛒
                    <a href="../ProjectEN/Home.php">English</a>
            </div>

        </div>

    <?php
}
    ?>