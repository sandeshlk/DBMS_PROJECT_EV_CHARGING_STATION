<?php

include_once "connection_proc.php";

$sql = "SELECT S.S_NAME,C.C_NAME,L.ADDRESS,L.CITY,FE.NO_OF_SLOTS,FE.FAST_SLOW,FE.COST_PER_UNIT,S.TIMING_OPEN,S.TIMING_CLOSE FROM COMPANY C,STATION S,LOCATION L,FEATURES FE WHERE S.S_ID=L.S_ID AND L.S_ID=FE.S_ID AND S.C_ID=C.C_ID HAVING CITY='CHENNAI';;";
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

    <link rel="stylesheet" href="bengaluru.css">
</head>



<body>
    <?php include_once('nav.php') ?>
    <div class="container">

        <div class="searchbar">
            <form action="a1.php">
                <input type="text" name="s1" value="">
                <button type="submit" id="button">SUBMIT</button>
            </form>
        </div>
        <?php
    while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <div class="station">
            <div class="names">
                <h2><?php echo $row['S_NAME'] ?> , <?php echo $row['CITY'] ?></h2>
                <div class="address">
                    <h3><?php echo $row['ADDRESS'] ?></h3>
                </div>
            </div>
            <div class="info">
                <div class="time">
                    <div class="openclose">
                        <?php
                        $time = time();
                        if ($time < $row['TIMING_OPEN'] && $time > $row['TIMING_CLOSE']) {
                            echo 'CLOSED NOW';
                        } else {
                            echo 'OPEN NOW';
                        }
                        
                        ?>
                    </div>
                    <br>
                    <h2>TIMINGS</h2>
                    <h3><?php echo $row['TIMING_OPEN'] ?> to <?php echo $row['TIMING_CLOSE'] ?></h3>
                </div>
                <div class="details">
                    <div class="no_os_slots" >
                        <h3>SLOTS</h3><br>
                        <h4><?php echo $row['NO_OF_SLOTS'] ?></h4>
                    </div>
                    <div class="cost" >
                        <h3>COST PER UNIT</h3><br>
                        <h4>RS . <?php echo $row['COST_PER_UNIT'] ?></h4>
                    </div>
                    <div class="cost">
                        <h3>COMPANY</h3><br>
                        <h4><?php echo $row['C_NAME'] ?></h4>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button id="button1">More</button>
                <button id="button1"><i class='fas fa-directions'></i>Directions</button>
            </div>
        </div>
        
        <?php
    }
    ?>
    </div>
</body>

</html>