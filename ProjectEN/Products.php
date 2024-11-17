<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cake.css?<?= time() ?>">
    <title>Cake</title>
</head>

<body>

    <body>
        <?php
        include_once("CommonCode.php");
        commoncodeNA("Products");
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
                        <img src="./Images/<?= $arrayOfPiesces[3]  ?>" class="ProductImage">
                        </div>
                        <div class="Price"><?= $arrayOfPiesces[2] ?> € </div>
                        <button class="ADD">ADD TO CART 🛒</button>
                    </div>
            <?php
                }
            }
            ?>
        </div>

    </body>

</html>