<?php
if (!isset($_SESSION['username'])) {
    // Redirect to login if the user is not logged in
    header("Location: Login.php");
    exit();
}

include_once("../Database/CommonCode.php");
commoncodeNA("ShoppingCart");

$cart = $_SESSION['cart'] ?? []; // Get the cart from the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css">
    <title>Shopping Cart</title>
</head>

<body>
    <h1 style="text-align: center;">Your Shopping Cart</h1>
    <div class="AllProducts">
        <?php if (count($cart) > 0): ?>
            <?php foreach ($cart as $product): ?>
                <div class="OneProduct">
                    <div class="ProductName"><?= htmlspecialchars($product['name']) ?></div>
                    <div class="ImageContainer">
                        <img src="../Database/Images/<?= htmlspecialchars($product['image']) ?>" class="ProductImage" alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                    <div class="Price"><?= htmlspecialchars($product['price']) ?> €</div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; font-size: 20px;">Your cart is empty!</p>
        <?php endif; ?>
    </div>
</body>

</html>
