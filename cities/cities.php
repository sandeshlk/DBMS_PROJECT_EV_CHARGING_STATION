<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cities.css">
</head>

<body>

    <div class="nav">
        <h1>Please Select A City<?php echo "" ?></h1>
        
    </div>
    
    <div class="container1">
        <a href="bengaluru.php">
            <div class="card1">
                <img src="../assets/vikasa-soudha.jpg" alt="">
                <div class="cont">
                    <span>Bengaluru</span>
                    <sapn>Karnataka</span>
                </div>
            </div>
        </a>

        <a href="delhi.php">
            <div class="card1">
                <img src="../assets/delhi.jpg" alt="">
                <div class="cont">
                    <span>Delhi</span>
                    <sapn>Delhi</span>
                </div>
            </div>
        </a>
        <a href="chennai.php">
            <div class="card1">
                <img src="../assets/chennai.jpg" alt="">
                <div class="cont">
                    <span>Chennai</span>
                    <sapn>Tamil Nadu</span>
                </div>
            </div>
        </a>
        <a href="hyd.php">
            <div class="card1">
                <img src="../assets/hyd.jpg" alt="">
                <div class="cont">
                    <span>Hyderabad</span>
                    <sapn>Andhra Pradesh</span>
                </div>
            </div>
        </a>
       
    </div>
    <div class="container2">
        <a href="ahmd.php">
            <div class="card1">
                <img src="../assets/ahmd.jpg" alt="">
                <div class="cont">
                    <span>Ahmedabad</span>
                    <sapn>Gujrat</span>
                </div>
            </div>
        </a>
        <a href="mumbai.php">
            <div class="card1">
                <img src="../assets/gateway-of-india.jpg" alt="">
                <div class="cont">
                    <span>Mumbai</span>
                    <sapn>Maharashtra</span>
                </div>
            </div>
        </a>
        <a href="thiru.php">
            <div class="card1">
                <img src="../assets/thiru.jpg" alt="">
                <div class="cont">
                    <span>Thiruvanantapuram</span>
                    <span>Kerala</span>
                </div>
            </div>
        </a>
        <a href="kol.php">
            <div class="card1">
                <img src="../assets/kol.jpg" alt="">
                <div class="cont">
                    <span>Kolkata</span>
                    <sapn>West Bengal</span>
                </div>
            </div>
        </a>
    </div>

</body>

</html>
