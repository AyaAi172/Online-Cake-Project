<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Design/Cake.css?= time() ?>">
    <title>Add Product</title>
</head>

<body>
    <?php
    include_once("../Database/CommonCode.php");
    commoncodeNA("AddProduct");

    $feedbackMessage = "";

    // Check if the user is an admin
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
        // Redirect to Home if not an admin
        header("Location: Home.php");
        exit();
    }

    $filePath = "../Database/ProductsTranslation.csv";

    // Function to get the next available product ID
    function getNextID($filePath) {
        $lastID = 0;
        if (($file = fopen($filePath, "r")) !== FALSE) {
            while (($line = fgetcsv($file, 1000, ";")) !== FALSE) {
                if (is_numeric($line[0])) {
                    $lastID = max($lastID, (int)$line[0]); // Update the last ID
                }
            }
            fclose($file);
        }
        return $lastID + 1; // Increment the last ID
    }

    // Handle form submission
    if (isset($_POST['productNameEN'], $_POST['productNameFR'], $_POST['productPrice'], $_POST['productImage'])) {
        $productNameEN = $_POST['productNameEN']; // Product name in English
        $productNameFR = $_POST['productNameFR']; // Product name in French
        $productPrice = $_POST['productPrice'];
        $productImage = $_POST['productImage'];

        // Open the CSV file in append mode
        $file = fopen($filePath, "a");
        $nextID = getNextID($filePath); // Get the next ID

        if ($file) {
            // Write the new product to the file
            fwrite($file, "\n" . $nextID . ";" . $productNameEN . ";" . $productPrice . ";" . $productImage . ";Add to Cart;" . $productNameFR . ";Ajouter au panier");

            // Close the file
            fclose($file);

            // Feedback message
            $feedbackMessage = "Product added successfully!";
        } else {
            $feedbackMessage = "Failed to open the products file. Please check permissions.";
        }
    }
    ?>

    <!-- Display feedback message if available -->
    <?php if (!empty($feedbackMessage)): ?>
        <p style="color: green; text-align: center;"><?= htmlspecialchars($feedbackMessage) ?></p>
    <?php endif; ?>

    <!-- Add Product Form -->
    <div class="form-container">
        <form method="POST">
            <div class="regesterform">
                <input type="text" name="productNameEN" placeholder="Product Name (English)" required>
            </div>
            <div class="regesterform">
                <input type="text" name="productNameFR" placeholder="Product Name (French)" required>
            </div>
            <div class="regesterform">
                <input type="number" name="productPrice" placeholder="Product Price" required>
            </div>
            <div class="regesterform">
                <input type="text" name="productImage" placeholder="Product Image Path (e.g., images/product.jpg)" required>
            </div>
            <div class="regesterform">
                <button type="submit"><?= htmlspecialchars($arrayOfStrings['Add Product'] ?? 'Add Product') ?></button>
            </div>
        </form>
    </div>
</body>

</html>
