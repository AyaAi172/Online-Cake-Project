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

<body>
    <table>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Grade</th>
        </tr>
        <?php

        $file = fopen("Students.csv", "r");
        $line = fgets($file);
        $NomberOfStudent = 0;

        while (!feof($file)) {

            $line = fgets($file);
            //print($line);
            $arrayOfPieces = explode(",", $line);

            if (count($arrayOfPieces) == 3) {
                $NomberOfStudent = $NomberOfStudent + 1;
        ?>
                <tr class="highGrade">
                    <td><?= $NomberOfStudent ?></td>
                    <td><?= $arrayOfPieces[0] ?></td>
                    <td><?= $arrayOfPieces[1] ?></td>
                    <td><a href="Students.php?minDisplayed=55"><?= $arrayOfPieces[2] ?></a></td>
                </tr>
        <?php
            }
        }
        ?>
        <tr>
            <th></th>
            <th>Class average:</th>
            <th></th>
            <th>35.9</th>
        </tr>
    </table>
    <a href="Students.php">Reset View</a>
    <h1>Add a new student:</h1>
    <form method="POST">
        <div>First name: <input name="fName" /></div>
        <div>Last name: <input name="lName" /></div>
        <div>Grade: <input name="Grade" /></div>
        <div><input type="submit" value="Add" /></div>
    </form>
</body>

</html>