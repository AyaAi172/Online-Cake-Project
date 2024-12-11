<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css?= time() ?>">
    <title>Cake</title>
</head>

<body>

    <body>
        <?php
        include_once("../Database/CommonCode.php");
        commoncodeNA("Products");
        ?>
        <div class="AllProducts">
            <?php
            $myFile = fopen("../Database/ProductsTR.csv", "r");
            $line = fgets($myFile);
            while (!feof($myFile)) {
                $line = fgets($myFile);
                $arrayOfPiesces = explode(";", $line);
                
                if (count($arrayOfPiesces) == 7) {
            ?>

                    <div class="OneProduct">
                        <div class="ProductName"><?= $arrayOfPiesces[1]  ?></div>
                        <div class="ImageContainer">
                            <img src="../Database/Images/<?=$arrayOfPiesces[3]  ?>" class="ProductImage">
                        </div>
                        <div class="Price"><?=$arrayOfPiesces[2] ?> € </div>
                        <button class="ADD">ADD TO CART 🛒</button>
                    </div>
            <?php
                }
            }
            ?>
        </div>

    </body>

</html>