<?php
include_once("../Database/CommonCode.php");

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}

$username = $_SESSION['username']; // Logged-in username
$cart = $_SESSION['cart'] ?? []; // Current cart

// Handle "Remove Item" button
if (isset($_POST['removeItem'])) {
    $productIndex = $_POST['productIndex'];
    if (isset($_SESSION['cart'][$productIndex])) {
        unset($_SESSION['cart'][$productIndex]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    }
    header("Location: Cart.php");
    exit();
}

// Handle "Clear Cart" button
if (isset($_POST['clearCart'])) {
    $_SESSION['cart'] = [];
    header("Location: Cart.php");
    exit();
}

// Handle "Finalize Order" button
if (isset($_POST['finalizeOrder'])) {
    if (count($cart) > 0) {
        $totalPrice = 0;
        $orderDetails = "";

        foreach ($cart as $product) {
            $totalPrice += $product['price'];
            $orderDetails .= $product['name'] . " - " . $product['price'] . " €; ";
        }

        // Save the order to Orders.csv
        $timestamp = date("Y-m-d H:i:s");
        $file = fopen("../Database/Orders.csv", "a");
        fputcsv($file, [$username, $timestamp, $orderDetails, $totalPrice]);
        fclose($file);

        $_SESSION['cart'] = []; // Clear the cart
        header("Location: Cart.php");
        exit();
    }
}

// Load Order History
$orders = [];
$file = fopen("../Database/Orders.csv", "r");
while (($line = fgetcsv($file)) !== false) {
    if ($line[0] === $username) { // Filter by username
        $orders[] = [
            'timestamp' => $line[1],
            'details' => $line[2],
            'total' => $line[3]
        ];
    }
}
fclose($file);

commoncodeNA("Cart");
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
    <h1 style="text-align: center;"><?php echo $arrayOfStrings["Cart"] ?? "Your Cart"; ?></h1>

    <!-- Current Cart -->
    <div class="AllProducts">
        <?php if (count($cart) > 0): ?>
            <?php 
            $totalPrice = 0;

            foreach ($cart as $index => $product): 
                $totalPrice += $product['price'];
            ?>
                <div class="OneProduct">
                    <div class="ProductName"><?= htmlspecialchars($product['name']) ?></div>
                    <div class="ImageContainer">
                        <img src="../Database/Images/<?= htmlspecialchars($product['image']) ?>" class="ProductImage" alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                    <div class="Price"><?= htmlspecialchars($product['price']) ?> €</div>

                    <!-- Remove Button -->
                    <form method="POST" style="text-align: center;">
                        <input type="hidden" name="productIndex" value="<?= $index ?>">
                        <button type="submit" name="removeItem" class="REMOVE">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Total Price -->
        <h2 style="text-align: center;">Total: <?= $totalPrice ?> €</h2>

        <!-- Finalize Order Button -->
        <form method="POST" style="text-align: center;">
            <button type="submit" name="finalizeOrder" class="ADD">Finalize Order</button>
        </form>

        <!-- Clear Cart Button -->
        <form method="POST" style="text-align: center;">
            <button type="submit" name="clearCart" class="REMOVE">Clear Cart</button>
        </form>
        <?php else: ?>
            <p style="text-align: center; font-size: 20px;">Your cart is empty!</p>
        <?php endif; ?>
    </div>

  <!-- Order History -->
<h2 style="text-align: center;">Your Order History</h2>
<div class="OrderHistory">
    <?php if (count($orders) > 0): ?>
        <table style="width: 80%; margin: 20px auto; border-collapse: collapse; text-align: center;">
            <thead>
                <tr style="background-color: #f1f1f1; border-bottom: 2px solid #ddd;">
                    <th style="padding: 10px;">Order Date</th>
                    <th style="padding: 10px;">Product Name</th>
                    <th style="padding: 10px;">Price</th>
                    <th style="padding: 10px;">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <?php
                    // Split order details into individual products
                    $products = explode("; ", $order['details']);
                    $rowCount = count(array_filter($products)); // Count valid products
                    ?>
                    <?php foreach ($products as $index => $product): ?>
                        <?php if (!empty($product)): ?>
                            <?php
                            // Split product details into name and price
                            $productDetails = explode(" - ", $product);
                            $productName = $productDetails[0] ?? "";
                            $productPrice = $productDetails[1] ?? "";
                            ?>
                            <tr style="border-bottom: 1px solid #ddd;">
                                <!-- Order Date: Display only for the first product in the order -->
                                <?php if ($index === 0): ?>
                                    <td style="padding: 10px;" rowspan="<?= $rowCount ?>"><?= htmlspecialchars($order['timestamp']) ?></td>
                                <?php endif; ?>
                                <td style="padding: 10px;"><?= htmlspecialchars($productName) ?></td>
                                <td style="padding: 10px;"><?= htmlspecialchars($productPrice) ?></td>
                                <!-- Total Price: Display only for the first product in the order -->
                                <?php if ($index === 0): ?>
                                    <td style="padding: 10px;" rowspan="<?= $rowCount ?>"><?= htmlspecialchars($order['total']) ?> €</td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; font-size: 20px;">You have no past orders.</p>
    <?php endif; ?>
</div>


</body>

</html>
