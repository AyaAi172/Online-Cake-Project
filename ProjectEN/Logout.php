<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include_once("CommonCode.php");
    commoncodeNA("Logout");

    // This code will Call the reusable logout function from the CommonCode file
    logoutUser();
    ?>

</body>

</html>