<?php
include_once("../Database/CommonCode.php");

// Initialize the shopping cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle "Add to Cart" button
if (isset($_POST['addToCart'])) {
    $product = [
        'id' => $_POST['productID'],
        'name' => $_POST['productName'],
        'price' => (float) $_POST['productPrice'],
        'image' => $_POST['productImage'],
    ];

    $_SESSION['cart'][] = $product; // Add product to the cart
    header("Location: Products.php"); // Redirect to avoid form resubmission
    exit();
}

// Set the Add to Cart button text based on the selected language
$addToCartText = ($_SESSION['language'] == "EN") ? "Add to Cart 🛒" : "Ajouter au panier 🛒";

commoncodeNA("Products"); // Navigation and common functionality
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css">
    <title>Products</title>
</head>

<body>
    <div class="AllProducts">
        <?php
        $file = fopen("../Database/ProductsTranslation.csv", "r");
        $line = fgets($file); // Skip header row

        while (!feof($file)) {
            $line = fgets($file);
            $arrayOfPieces = explode(";", $line);

            if (count($arrayOfPieces) == 7) {
                $productID = htmlspecialchars($arrayOfPieces[0]);
                $productName = ($_SESSION['language'] == "EN") ? htmlspecialchars($arrayOfPieces[1]) : htmlspecialchars($arrayOfPieces[5]);
                $productPrice = htmlspecialchars($arrayOfPieces[2]);
                $productImage = htmlspecialchars($arrayOfPieces[3]);
        ?>
                <div class="OneProduct">
                    <div class="ProductName"><?= $productName ?></div>
                    <div class="ImageContainer">
                        <img src="../Database/Images/<?= $productImage ?>" class="ProductImage" alt="<?= $productName ?>">
                    </div>
                    <div class="Price"><?= $productPrice ?> €</div>

                    <?php if (isset($_SESSION['username'])): ?>
                        <form method="POST" action="Products.php">
                            <input type="hidden" name="productID" value="<?= htmlspecialchars($arrayOfPieces[0]) ?>">
                            <input type="hidden" name="productName" value="<?= htmlspecialchars($productName) ?>">
                            <input type="hidden" name="productPrice" value="<?= htmlspecialchars($productPrice) ?>">
                            <input type="hidden" name="productImage" value="<?= htmlspecialchars($productImage) ?>">
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'customer'): ?>
                                <button type="submit" name="addToCart" class="add-to-cart">
                                    <?= htmlspecialchars($addToCartText) ?>
                                </button>
                            <?php endif; ?>

                        </form>
                    <?php else: ?>
                        <p style="color: gray; font-size: 14px; text-align: center;"><?= htmlspecialchars($arrayOfStrings['Login to add products to your cart'] ?? 'Login to add products to your cart') ?></p>
                    <?php endif; ?>
                </div>
        <?php
            }
        }
        fclose($file);
        ?>
    </div>
</body>

</html>