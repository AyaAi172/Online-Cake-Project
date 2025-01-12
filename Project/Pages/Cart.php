<?php
include_once("../Database/CommonCode.php");
commoncodeNA("Cart");

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Path to the orders file
$ordersFile = "../Database/FinalizedOrders.csv";

// Clear cart functionality
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: Cart.php");
    exit();
}

// Finalize order functionality
if (isset($_POST['finalize_order']) && !empty($_SESSION['cart'])) {
    $username = $_SESSION['username'];
    $orderDate = date("Y-m-d");
    $orderTime = date("H:i:s");
    $productIDs = [];
    $totalPrice = 0;

    foreach ($_SESSION['cart'] as $item) {
        $productIDs[] = $item['id'];
        $totalPrice += $item['price'];
    }

    $productIDsString = implode(",", $productIDs);

    // Append the new order to the CSV file
    $file = fopen($ordersFile, "a");
    fputcsv($file, [$username, $orderDate, $orderTime, $productIDsString, $totalPrice]);
    fclose($file);

    // Clear the cart after finalizing the order
    $_SESSION['cart'] = [];
    header("Location: Cart.php");
    exit();
}

// Remove item functionality
if (isset($_POST['remove_item'])) {
    $index = $_POST['remove_item'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: Cart.php");
    exit();
}

// Load user's order history
$userOrders = [];
if (file_exists($ordersFile)) {
    $file = fopen($ordersFile, "r");
    while (($line = fgetcsv($file)) !== false) {
        if ($line[0] === $_SESSION['username']) {
            $userOrders[] = [
                'date' => $line[1],
                'time' => $line[2],
                'product_ids' => explode(",", $line[3]),
                'total_price' => $line[4],
            ];
        }
    }
    fclose($file);
}

// Load product information for translations
$productInfo = [];
$productFile = "../Database/ProductsTranslation.csv";
if (file_exists($productFile)) {
    $file = fopen($productFile, "r");
    fgetcsv($file, 1000, ";"); // Skip the header row
    while (($line = fgetcsv($file, 1000, ";")) !== false) {
        $productID = $line[0];
        $productInfo[$productID] = [
            'name' => ($_SESSION['language'] === "FR") ? $line[5] : $line[1],
            'price' => $line[2],
        ];
    }
    fclose($file);
}
?>

<!DOCTYPE html>
<html lang="<?= $_SESSION['language'] === "FR" ? 'fr' : 'en' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css">
    <title><?= htmlspecialchars($arrayOfStrings['Your Cart'] ?? 'Your Cart') ?></title>
</head>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($arrayOfStrings['Your Shopping Cart'] ?? 'Your Shopping Cart') ?></h1>
    <div class="AllProducts">
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <div class="OneProduct">
                <div class="ProductName"><?= htmlspecialchars($productInfo[$item['id']]['name'] ?? 'Unknown Product') ?></div>

                    <div class="ImageContainer">
                        <img src="../Database/Images/<?= htmlspecialchars($item['image']) ?>" class="ProductImage" alt="<?= htmlspecialchars($item['name']) ?>">
                    </div>
                    <div class="Price"><?= htmlspecialchars($item['price']) ?> €</div>
                    <form method="POST">
                        <button type="submit" name="remove_item" value="<?= $index ?>" class="REMOVE">
                            <?= htmlspecialchars($arrayOfStrings['Remove'] ?? 'Remove') ?>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
            <div style="text-align: center; margin-top: 20px;">
                <p><?= htmlspecialchars($arrayOfStrings['Total'] ?? 'Total') ?>: <strong>
                    <?= array_sum(array_column($_SESSION['cart'], 'price')) ?> €
                </strong></p>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="finalize_order" class="ADD">
                        <?= htmlspecialchars($arrayOfStrings['Finalize Order'] ?? 'Finalize Order') ?>
                    </button>
                </form>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="clear_cart" class="REMOVE">
                        <?= htmlspecialchars($arrayOfStrings['Clear Cart'] ?? 'Clear Cart') ?>
                    </button>
                </form>
            </div>
        <?php else: ?>
            <p style="text-align: center; font-size: 18px;">
                <?= htmlspecialchars($arrayOfStrings['Your cart is empty'] ?? 'Your cart is empty!') ?>
            </p>
        <?php endif; ?>
    </div>

    <h2 style="text-align: center;"><?= htmlspecialchars($arrayOfStrings['Your Order History'] ?? 'Your Order History') ?></h2>
    <table>
        <thead>
            <tr>
                <th><?= htmlspecialchars($arrayOfStrings['Order Date'] ?? 'Date') ?></th>
                <th><?= htmlspecialchars($arrayOfStrings['Order Time'] ?? 'Time') ?></th>
                <th><?= htmlspecialchars($arrayOfStrings['Product Name'] ?? 'Product Name') ?></th>
                <th><?= htmlspecialchars($arrayOfStrings['Price'] ?? 'Price') ?></th>
                <th><?= htmlspecialchars($arrayOfStrings['Total Price'] ?? 'Total Price') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userOrders as $order): ?>
                <tr>
                    <td rowspan="<?= count($order['product_ids']) ?>"><?= htmlspecialchars($order['date']) ?></td>
                    <td rowspan="<?= count($order['product_ids']) ?>"><?= htmlspecialchars($order['time']) ?></td>
                    <?php foreach ($order['product_ids'] as $index => $productID): ?>
                        <?php if ($index > 0): ?><tr><?php endif; ?>
                        <td><?= htmlspecialchars($productInfo[$productID]['name'] ?? 'Unknown Product') ?></td>
                        <td><?= htmlspecialchars($productInfo[$productID]['price'] ?? '0') ?> €</td>
                        <?php if ($index === 0): ?>
                            <td rowspan="<?= count($order['product_ids']) ?>"><?= htmlspecialchars($order['total_price']) ?> €</td>
                        <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
