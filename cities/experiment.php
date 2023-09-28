<?php
  include_once "connection_proc.php";

  $sql = "SELECT S.S_NAME,C.C_NAME,S.TIMING_OPEN,S.TIMING_CLOSE FROM COMPANY C,STATION S WHERE S.C_ID=C.C_ID";
  $res = mysqli_query($conn, $sql);
  $ress = mysqli_num_rows($res);
?>
<?php
while ($row = mysqli_fetch_assoc($res)) {
            echo "hi";
        ?>
            <div class="station">
                <div class="names">
                    <h2><?php echo $row['S_NAME'] ?> </h2>
                   
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
                    
                        <div class="company">
                            <h3>COMPANY</h3><br>
                            <h4><?php echo $row['C_NAME'] ?></h4>
                        </div>
                        
                    </div>
                </div>
             
            </div>


        <?php
        }
        ?>