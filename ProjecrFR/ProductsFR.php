<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cake.css?<?= time() ?>">
    <title>Cake</title>
</head>

<body>
    <?php
    include_once("CommonCodeFR.php");
    commoncodeNA("ProductsFR");
    ?>
   

   <div class="AllProducts">
            <?php
            $myFile = fopen("../ProjectEN/Products details/pro.csv", "r");
            $line = fgets($myFile);
            while (!feof($myFile)) {
                $line = fgets($myFile);
                $arrayOfPiesces = explode(";", $line);
                if (count($arrayOfPiesces) == 5) {
            ?>

                    <div class="OneProduct">
                        <div class="ProductName"><?= $arrayOfPiesces[1]  ?></div>
                        <div class="ImageContainer">
                        <img src="../ProjectEN/Images/<?=$arrayOfPiesces[3]?>" class="ProductImage">
                        </div>
                        <div class="Price"><?= $arrayOfPiesces[2] ?> € </div>
                        <button class="ADD">AJOUTER AU PANIER 🛒</button>
                    </div>
            <?php
                }
            }
            ?>
        </div>
</body>

</html>