<?php
include_once("../Database/CommonCode.php");
commoncodeNA("Orders");

// Restrict access to admin users only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: Home.php");
    exit();
}

// Load product translations
$productTranslations = [];
$productFile = "../Database/ProductsTranslation.csv";
if (file_exists($productFile)) {
    $file = fopen($productFile, "r");
    fgetcsv($file, 1000, ";"); // Skip the header row
    while (($line = fgetcsv($file, 1000, ";")) !== false) {
        $productID = $line[0]; // Use product ID as the key
        $productTranslations[$productID] = [
            'name_en' => $line[1],
            'name_fr' => $line[5],
            'price' => $line[2],
        ];
    }
    fclose($file);
}

// Load all orders
$allOrders = [];
$ordersFile = "../Database/FinalizedOrders.csv";
if (file_exists($ordersFile)) {
    $file = fopen($ordersFile, "r");
    fgetcsv($file); // Skip the header row
    while (($line = fgetcsv($file)) !== false) {
        if (count($line) >= 5) { // Ensure all required fields are present
            $allOrders[] = [
                'username' => $line[0],
                'date' => $line[1],
                'time' => $line[2],
                'product_ids' => explode(",", trim($line[3], "\"")), // Process product IDs correctly
                'total_price' => $line[4],
            ];
        }
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
    <title><?= htmlspecialchars($arrayOfStrings['All Orders'] ?? 'All Orders') ?></title>
</head>

<body>
    <h1 style="text-align: center;"><?= htmlspecialchars($arrayOfStrings['All Orders'] ?? 'All Orders') ?></h1>
    <div class="AllOrders">
        <?php if (!empty($allOrders)): ?>
            <table>
                <thead>
                    <tr>
                        <th><?= htmlspecialchars($arrayOfStrings['Username'] ?? 'Username') ?></th>
                        <th><?= htmlspecialchars($arrayOfStrings['Order Date'] ?? 'Order Date') ?></th>
                        <th><?= htmlspecialchars($arrayOfStrings['Order Time'] ?? 'Order Time') ?></th>
                        <th><?= htmlspecialchars($arrayOfStrings['Product Name'] ?? 'Product Name') ?></th>
                        <th><?= htmlspecialchars($arrayOfStrings['Price'] ?? 'Price') ?></th>
                        <th><?= htmlspecialchars($arrayOfStrings['Total Price'] ?? 'Total Price') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allOrders as $order): ?>
                        <?php $firstRow = true; ?>
                        <?php foreach ($order['product_ids'] as $productID): ?>
                            <tr>
                                <?php if ($firstRow): ?>
                                    <td rowspan="<?= count($order['product_ids']) ?>"><?= htmlspecialchars($order['username']) ?></td>
                                    <td rowspan="<?= count($order['product_ids']) ?>"><?= htmlspecialchars($order['date']) ?></td>
                                    <td rowspan="<?= count($order['product_ids']) ?>"><?= htmlspecialchars($order['time']) ?></td>
                                <?php endif; ?>
                                <td>
                                    <?php
                                    if (isset($productTranslations[$productID])) {
                                        echo htmlspecialchars(
                                            $_SESSION['language'] === "FR"
                                                ? $productTranslations[$productID]['name_fr']
                                                : $productTranslations[$productID]['name_en']
                                        );
                                    } else {
                                        echo htmlspecialchars($arrayOfStrings['Unknown Product'] ?? 'Unknown Product');
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($productTranslations[$productID]['price'] ?? '0') ?> €
                                </td>
                                <?php if ($firstRow): ?>
                                    <td rowspan="<?= count($order['product_ids']) ?>">
                                        <?= htmlspecialchars($order['total_price']) ?> €
                                    </td>
                                    <?php $firstRow = false; ?>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center;"><?= htmlspecialchars($arrayOfStrings['No orders found'] ?? 'No orders found') ?></p>
        <?php endif; ?>
    </div>
</body>

</html>
