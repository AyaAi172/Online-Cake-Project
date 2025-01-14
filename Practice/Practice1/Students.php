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

    <?php

    $file = fopen("Students.csv", "r");
    $line = fgets($file);
    $NomberOfStudent = 0;

    while (!feof($file)) {

        $line = fgets($file);
        //print($line);
        $arrayOfPieces = explode(",", $line);

        if (count($arrayOfPieces) == 3) {
            $ftName = htmlspecialchars($arrayOfPieces[0]);
            $lName = htmlspecialchars($arrayOfPieces[1]);
            $Grade = htmlspecialchars($arrayOfPieces[2]);
            $NomberOfStudent = $NomberOfStudent + 1;

            if ($Grade < 20) {
                $Grade = "<div class='lowGrade'>$Grade</div>";
            } else if ($Grade > 40) {
                $Grade = "<div class='highGrade'>$Grade</div>";
            }
            else {
                $Grade = "<div>$Grade</div>";
            }


    ?>

            <table>

                <div>
                    <td><?= $NomberOfStudent ?></td>
                    <td><?= $ftName ?></td>
                    <td><?= $lName ?></td>
                    <td><?= $Grade ?></td>
                </div>

            </table>

    <?php
        }
    }
    fclose($file);
    ?>
    <a href="Students.php">Reset View</a>
    <h1>Add a new student:</h1>

    <?php
    if (!empty($_POST["fName"]) && !empty($_POST["lName"]) && !empty($_POST["Grade"])) {
        $newStudent = fopen("Students.csv", "a");
        if (!$newStudent) {
            echo ("Error: Unable to open the file for writing.");
        }
        fputs($newStudent, "\n" . $_POST["fName"] . "," . $_POST["lName"] . "," . $_POST["Grade"]);
        fclose($newStudent);
        exit();
    }

    ?>

    <form method="POST">

        <input type="text" name="fName" /></div>
        <input type="text" name="lName" /></div>
        <input type="text" name="Grade" /></div>
        <input type="submit" value="Add" /></div>
    </form>


</body>

</html>