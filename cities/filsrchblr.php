<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="insidecity.css">
</head>
<body>
<?php
    include_once "connection_proc.php";
    // Get the search term
    $search_term = mysqli_real_escape_string($conn, $_POST['s1']);

    // Build the query
    $query = "SELECT S.S_NAME,C.C_NAME,L.ADDRESS,L.CITY,L.LINK,FE.NO_OF_SLOTS,FE.FAST_SLOW,FE.COST_PER_UNIT,S.TIMING_OPEN,S.TIMING_CLOSE FROM COMPANY C,STATION S,LOCATION L,FEATURES FE WHERE S.S_ID=L.S_ID AND L.S_ID=FE.S_ID AND S.C_ID=C.C_ID AND S_NAME LIKE '%$search_term%' OR ADDRESS LIKE '%$search_term%' OR FAST_SLOW LIKE '%$search_term%' OR COST_PER_UNIT LIKE '%$search_term%' HAVING CITY='BANGALORE';; ";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Loop through the results and display them
   
    ?>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="container">
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
                        <div class="no_os_slots">
                            <h3>SLOTS</h3><br>
                            <h4><?php echo $row['NO_OF_SLOTS'] ?></h4>
                        </div>
                        <div class="cost">
                            <h3>COST PER UNIT</h3><br>
                            <h4>RS . <?php echo $row['COST_PER_UNIT'] ?></h4>
                        </div>
                        <div class="company">
                            <h3>COMPANY</h3><br>
                            <h4><?php echo $row['C_NAME'] ?></h4>
                        </div>
                        <div class="fast_slow">
                            <h3>CHARGING</h3><br>
                            <h4><?php echo $row['FAST_SLOW'] ?></h4>
                        </div>
                    </div>
                </div>
                <div class="buttons">

                    <a id="button1" href="<?php echo $row['LINK'] ?>">DIRECTIONS</a>
                </div>
            </div>

        <?php
        }
        ?>
        </div>
</body>
</html>



