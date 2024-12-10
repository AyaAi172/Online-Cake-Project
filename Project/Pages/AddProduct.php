<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Cake.css?= time() ?>">
    <title>Add Product</title>
</head>

<body>
    <?php
    include_once("CommonCode.php");
    commoncodeNA("AddProduct");

    $feedbackMessage = "";

    // Check if the user is an admin
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
        // Redirect to Home if not an admin
        header("Location: Home.php");
        exit();
    }

    // Handle the form submission
    if (isset($_POST['productName'], $_POST['productPrice'], $_POST['productImage'])) {
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productImage = $_POST['productImage'];

        // Open the CSV file in append mode
        $file = fopen("Products details/pro.csv", "a");

        if ($file) {
            // Write the new product to the file with a newline
            fwrite($file, "\n" . uniqid() . ";" . $productName . ";" . $productPrice . ";" . $productImage . ";");

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
                <input type="text" name="productName" placeholder="Product Name" required>
            </div>
            <div class="regesterform">
                <input type="number" name="productPrice" placeholder="Product Price" required>
            </div>
            <div class="regesterform">
                <input type="text" name="productImage" placeholder="Product Image Path (e.g., images/product.jpg)" required>
            </div>
            <div class="regesterform">
                <button type="submit">Add Product</button>
            </div>
        </form>
    </div>
</body>

</html>
