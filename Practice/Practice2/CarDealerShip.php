<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        tr,
        td {
            border: 2px solid black;
            text-align: center;
            padding: 10px;
        }

        .lowCars {
            background-color: pink;
        }
    </style>
</head>

<?php
if (!empty($_POST["ClientName"]) && !empty($_POST["CarType"])  && !empty($_POST["HowMany"])) {
    $file = fopen("Orders.csv", "a");
    $Newline = $_POST["ClientName"] . "," . $_POST["CarType"] . "," . $_POST["HowMany"];

    fputs($file, "\n" . $Newline);
    fclose($file);
}


function SUM(){

    $file = fopen("Order.csv", "r");
    $line = fgetc($file);
    $sum = 0;

    while (!feof($file)){
        $line = fgets($file);
        $arrayCAR = explode(",", $line);
        if(count($arrayCAR) == 3);
        $Order = (int)$arrayCAR[3];

    }

}
?>

<body>
    <table>
        <tr>
            <th>Car model</th>
            <th>Price</th>
            <th>Available</th>
            <th>Orders</th>
        </tr>


        <?php
        $file = fopen("CarDb.csv", "r");
        $line = fgets($file);
        $Totalincome = 0;
        while (!feof($file)) {
            $line = fgets($file);
            $arrayCAR = explode(",", "$line");
            if (count($arrayCAR) == 4) {
                $CarModel = ($arrayCAR[0]);
                $Price = (int)$arrayCAR[1];
                $Available = (int)$arrayCAR[2];
                $Order = (int)$arrayCAR[3];
                $bshow=true;
                $Totalincome += $Price * $Order;  

                if ($bshow) {

        ?>

                    <tr <?php if ($Order > $Available) print("class='lowCars'") ?>>
                        <td><?= $CarModel ?></td>
                        <td><?= $Price ?></td>
                        <td><?= $Available ?></td>
                        <td><?= $Order ?></td>
                    </tr>
        <?php
                }
            }
        }
        ?>


        <th>
            <tr>
                <td>Total income:</td>
                <td></td>
                <td></td>
                <td><?= $Totalincome ?></td>
            </tr>
        </th>
    </table>
</body>

<h1>Order cars here</h1>
<form method="POST">
    <div>Your name<input name="ClientName" /></div>
    <div>
        Please select the car type:
        <select name="CarType">
            <option>Dacia</option>
            <option>Volvo</option>
            <option>BMW</option>
            <option>Renault</option>
            <option>Tata Motors</option>
        </select>
    </div>
    <div>How many do you want:<input name="HowMany" /></div>
    <div><input type="submit" value="Order" /></div>
</form>
</html>