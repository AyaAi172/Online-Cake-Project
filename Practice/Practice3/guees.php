<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        tr,
        td {
            border: 2px solid black;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST["button"])) {
        $file = fopen("tries.txt", "a");
        $NewLine = $_POST["Guees"];
        fputs($file, "\n" . $NewLine);
        fclose($file);
    }

    ?>

    <form action="POST">
        
        Guess whats the secret: <input name="Guees" />
        <input type="submit" value="Try" name="button">

    </form>

</html>