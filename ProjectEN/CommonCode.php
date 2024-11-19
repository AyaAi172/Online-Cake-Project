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
?>