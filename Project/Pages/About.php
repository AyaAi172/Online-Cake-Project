<?php
include_once("../Database/CommonCode.php");
commoncodeNA("About");
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($_SESSION['language'] === "FR" ? 'fr' : 'en') ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css?= time() ?>">
    <title><?= htmlspecialchars($arrayOfStrings['ABOUT US'] ?? 'ABOUT US') ?></title>
</head>

<body>
    <div class="hero-section">
        <div class="content-box">
            <h1><?= htmlspecialchars($arrayOfStrings['ABOUT US'] ?? 'ABOUT US') ?></h1>
            <p>
                <?= htmlspecialchars(
                    $_SESSION['language'] === "FR"
                        ? 'Nous croyons que chaque célébration mérite un chef-d\'œuvre. Nos gâteaux sont confectionnés avec les meilleurs ingrédients et une touche de magie pour rendre vos moments inoubliables. Que vous célébriez un anniversaire, un mariage ou une occasion spéciale, nos gâteaux ajoutent de la douceur à vos instants.'
                        : 'We believe every celebration deserves a masterpiece. Our cakes are crafted with the finest ingredients and a touch of magic to make your moments unforgettable. Whether you\'re celebrating birthdays, anniversaries, or any special occasion, our cakes are here to add sweetness to your moments.'
                ) ?>
            </p>
        </div>
    </div>
</body>

</html>
