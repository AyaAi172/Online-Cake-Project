<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css">
    <title>Products</title>
</head>

<body>
    <?php
    include_once("../Database/CommonCode.php");
    commoncodeNA("Products");

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // Initialize cart if not set
    }
    ?>

    <div class="AllProducts">
        <?php
        $myFile = fopen("../Database/ProductsTranslation.csv", "r");
        $line = fgets($myFile); // Skip the header line

        while (!feof($myFile)) {
            $line = fgets($myFile);
            $arrayOfPieces = explode(";", $line);

            if (count($arrayOfPieces) == 7) {
                $productID = htmlspecialchars($arrayOfPieces[0]);
                $productName = ($_SESSION["language"] == "EN") ? htmlspecialchars($arrayOfPieces[1]) : htmlspecialchars($arrayOfPieces[5]);
                $productPrice = htmlspecialchars($arrayOfPieces[2]);
                $productImage = htmlspecialchars($arrayOfPieces[3]);
                $addToBasketText = ($_SESSION["language"] == "EN") ? htmlspecialchars($arrayOfPieces[4]) : htmlspecialchars($arrayOfPieces[6]);
        ?>
                <div class="OneProduct">
                    <div class="ProductName"><?= $productName ?></div>
                    <div class="ImageContainer">
                        <img src="../Database/Images/<?= $productImage ?>" class="ProductImage" alt="<?= $productName ?>">
                    </div>
                    <div class="Price"><?= $productPrice ?> €</div>

                    <!-- Buy Button -->
                    <form method="POST" action="Products.php">
                        <input type="hidden" name="productID" value="<?= $productID ?>">
                        <input type="hidden" name="productName" value="<?= $productName ?>">
                        <input type="hidden" name="productPrice" value="<?= $productPrice ?>">
                        <input type="hidden" name="productImage" value="<?= $productImage ?>">
                        <button type="submit" name="buy" class="ADD"><?= $addToBasketText ?> 🛒</button>
                    </form>
                </div>
        <?php
            }
        }
        fclose($myFile);

        // Handle Buy Button Logic
        if (isset($_POST['buy'])) {
            $product = [
                'id' => $_POST['productID'],
                'name' => $_POST['productName'],
                'price' => $_POST['productPrice'],
                'image' => $_POST['productImage'],
            ];

            $_SESSION['cart'][] = $product; // Add product to the cart
            header("Location: Products.php"); // Avoid form resubmission
            exit();
        }
        ?>
    </div>
</body>

</html>
