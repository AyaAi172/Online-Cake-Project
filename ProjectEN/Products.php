<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cake.css">
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
            $myFile = fopen("pro.csv", "r");
            $line = fgets($myFile);
            while (!feof($myFile)) {
                $line = fgets($myFile);
                $arrayOfPiesces = explode(";", $line);
                if (count($arrayOfPiesces) == 5) {
            ?>

                    <div class="OneProduct">
                        <div><?= $arrayOfPiesces[1]  ?></div>
                        <img src="./<?= $arrayOfPiesces[4]  ?>">
                        <div><?= $arrayOfPiesces[2]  ?>EUR</div>
                        <div><?= $arrayOfPiesces[3]  ?></div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

    </body>
</html>