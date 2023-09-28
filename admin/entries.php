<?php

include_once "connection_proc.php";

$sql = "SELECT * FROM entries;;";
$res = mysqli_query($conn, $sql);
$ress = mysqli_num_rows($res);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link rel="stylesheet" href="insidecity.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>



<body>



    <?php
    while ($row = mysqli_fetch_assoc($res)) {
    ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Station ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time In</th>
                    <th scope="col">Time Out</th>
                    <th scope="col">Vehicle Number</th>
                    <th scope="col">UNITS CONSUMED</th>
                    <th scope="col">COST PER UNIT</th>
                    <th scope="col">TOTAL COST</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['S_ID'] ?></td>
                    <td><?php echo $row['CUST_NAME'] ?></td>
                    <td><?php echo $row['DATE'] ?></td>
                    <td><?php echo $row['TIME_IN'] ?></td>
                    <td><?php echo $row['TIME_OUT'] ?></td>
                    <td><?php echo $row['VEHICLE_NO'] ?></td>
                    <td><?php echo $row['UNITS_USED'] ?></td>
                    <td><?php echo $row['COST_P_U'] ?></td>
                    <td><?php echo $row['TOTAL_COST'] ?></td>



                </tr>

            </tbody>
        </table>


    <?php
    }
    ?>
    </div>

</body>

</html>