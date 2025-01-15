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
            padding: 5px;
        }

        .lowGrade {
            background-color: lightpink;
        }

        .highGrade {
            background-color: lightgreen;
        }

        form div {
            width: 300px;
            text-align: right;
            margin: 10px;
        }

        form {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<?php
if (!empty($_POST["fName"]) &&  !empty($_POST["lName"]) && !empty($_POST["Grade"])) {
    $file = fopen("Students.csv", "a");
    $NmewLine = $_POST["fName"] . "," . $_POST["lName"] . "," . $_POST["Grade"];
    fputs($file, "\n" . $NmewLine);
    fclose($file);
}

function Avrage()
{

    $file = fopen("Students.csv", "r");
    $line = fgets($file);
    $sum = 0;
    $count = 0;
    while (!feof($file)) {
        $line = fgets($file);
        $arrayItem = explode(",", $line);
        if (count($arrayItem) == 3) {
            $count++;
            $Grade = (int)$arrayItem[2];
            $sum += $Grade;
        }
    }
    fclose($file);
    return $sum / $count;
}


?>



<body>
    <table>
        <tr>
            <th>Number</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Grade</th>
        </tr>
        <?php

        $AVG = Avrage();

        $file = fopen("Students.csv", "r");
        $line = fgets($file);
        $NomberOfStudent = 0;

        while (!feof($file)) {
            $line = fgets($file);
            $arrayItem = explode(",", $line);
            if (count($arrayItem) == 3) {
                $FirstName = ($arrayItem[0]);
                $LastName = ($arrayItem[1]);
                $Grade = (int)$arrayItem[2];
                $NomberOfStudent++;
                $bshow = true;

                if (isset($_GET["minDisplayed"])) {
                    if ($Grade < $_GET["minDisplayed"]) {
                        $bshow = false;
                    }
                }

                if ($bshow) {
        ?>
                    <tr <?php if ($Grade < $AVG) print("class='highGrade'");
                        if ($Grade > $AVG) print("class='lowGrade'") ?>>
                        <td><?= $NomberOfStudent ?></td>
                        <td><?= $FirstName ?></td>
                        <td><?= $LastName ?></td>
                        <td><a href="Students.php?minDisplayed=<?= $Grade ?>"><?= $Grade ?></a></td>
                    </tr>
        <?php
                }
            }
        }
        fclose($file);
        ?>

        <tr>
            <th></th>
            <th>Class average:</th>
            <th></th>
            <th><?= $AVG; ?></th>
        </tr>

    </table>
    <?php if (isset($_GET["minDisplayed"])) { ?>
        <a href="Students.php">Reset View</a>

    <?php
    }
    ?>
    <h1>Add a new student:</h1>
    <form method="POST">
        <div>First name: <input name="fName" /></div>
        <div>Last name: <input name="lName" /></div>
        <div>Grade: <input name="Grade" /></div>
        <div><input type="submit" value="Add" /></div>
    </form>
</body>

</html>