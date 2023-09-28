<?php
include_once "connection_proc.php";

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize the search variable
$search = "";

// Check if the form has been submitted
if (isset($_POST['search_button'])) {
    $search = mysqli_real_escape_string($conn, $_POST['s1']);

    // Query to fetch stations matching the search input
    $sql = "SELECT S.S_NAME, C.C_NAME, L.ADDRESS, L.CITY, L.LINK, FE.NO_OF_SLOTS, FE.AMENITIES, FE.CHARGER_TYPE, FE.COST_PER_UNIT, S.TIMING_OPEN, S.TIMING_CLOSE FROM  station S, location L, features FE, company C WHERE S.S_ID = L.S_ID AND L.S_ID = FE.S_ID AND S.C_ID = C.C_ID AND (S.S_NAME LIKE '%$search%' OR L.ADDRESS LIKE '%$search%' OR L.CITY LIKE '%$search%') AND L.CITY = 'THIRUVANANTAPURAM'";
} else {
    // Query to fetch all stations
    $sql = "SELECT S.S_NAME, C.C_NAME, L.ADDRESS, L.CITY, L.LINK, FE.NO_OF_SLOTS, FE.AMENITIES, FE.CHARGER_TYPE, FE.COST_PER_UNIT, S.TIMING_OPEN, S.TIMING_CLOSE FROM  station S, location L, features FE, company C WHERE S.S_ID = L.S_ID AND L.S_ID = FE.S_ID AND S.C_ID = C.C_ID AND L.CITY = 'THIRUVANANTAPURAM'";
}

$res = mysqli_query($conn, $sql);

if (!$res) {
    die("Query failed: " . mysqli_error($conn));
}
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
    <style>
        .buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        #button1 {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        #button1:hover {
            background-color: #2980b9;
        }

        /* Style for the search form */
        .searchbar {
            text-align: center;
            margin-top: 20px;
        }

        /* Style for the search input */
        #search {
            padding: 6px 16px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: 300px;
            margin-right: 10px;
        }

        /* Style for the search button */
        #button {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 6px 16px;
            cursor: pointer;
            border-radius: 20px;
            width: 100px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect for search button */
        #button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <?php include_once('nav.php') ?>
    <div class="container">
        <div class="searchbar">
            <form method="post">
                <input type="text" id="search" name="s1" placeholder="Search name, address, or city" value="<?php echo $search; ?>">
                <button type="submit" id="button" name="search_button">SUBMIT</button>
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
                        <div class="charger">
                            <h3>CHARGING</h3><br>
                            <h4><?php echo $row['CHARGER_TYPE'] ?></h4>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <a id="button1" href="<?php echo $row['LINK'] ?>" style="text-decoration: none;">DIRECTIONS</a>
                    <a id="button1" href="../user/userlogin.php" style="text-decoration: none;">BOOK</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>

