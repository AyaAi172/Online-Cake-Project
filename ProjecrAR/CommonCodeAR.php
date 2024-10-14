<?php
function commoncodeNA($PageOpen)
{
?>

    <div class="NavAll">
        <div class="TopNav">
            <div class="MainLinks">
                <a href="HomeAR.php" <?php if ($PageOpen == "HomeAR") {
                                            print("class='active'");
                                        } ?>>الصفحة الرئيسية</a>
                <a href="AboutAR.php" <?php if ($PageOpen == "AboutAR") {
                                            print("class='active'");
                                        } ?>>عننا</a>
                <a href="ProductsAR.php" <?php if ($PageOpen == "ProductsAR") {
                                                print("class='active'");
                                            } ?>>المنتجات</a>
                <a href="ContactAR.php" <?php if ($PageOpen == "ContactAR") {
                                            print("class='active'");
                                        } ?>>التواصل</a>
                <div class="Icon">
                    <img src="../img/download.jpg">
                </div>
                <a href="#" id="basketIcon"> 🛒 <span id="basketCount"></span>
            </div>
        </div>

    <?php
}
    ?>