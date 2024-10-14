<?php 
function commoncode($PageOpen){}
?>

<div class="NavAll">
            <div class="TopNav">
                <div class="MainLinks">
                    <a href="Home.html" <?php if($PageOpen == "Home") {
                        print("class='active'");
                    } ?>>Home</a>
                    <a href="About .html" <?php if($PageOpen == "About") {
                        print("class='active'");
                    } ?>>About</a>
                    <a href="Products.html"<?php if($PageOpen == "Products") {
                        print("class='active'");
                    } ?>>Products</a>
                    <a href="Contact.html" <?php if($PageOpen == "Contact") {
                        print("class='active'");
                    } ?>>Contact</a>
                </div>
                <div class="Icon">
                    <img src="./img/download.jpg">

                </div>
                <a href="#" id="basketIcon"> 🛒 <span id="basketCount"></span>
            </div>
        </div>

      <?php 
      
      ?>