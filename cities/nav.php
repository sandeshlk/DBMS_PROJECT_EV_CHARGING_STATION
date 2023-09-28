<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 31px 70px;
    height: 9vh;
    background: transparent;
    border-bottom: 2px solid black;
    color: rgb(0, 0, 0);
  font-weight: bolder;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-weight: 300;
    font-size: large;
  
    padding: 3px 20px;
    z-index: 1;
  }
  
  .nav a {
    text-decoration: none;
    font-size: larger;
    color: rgb(0, 0, 0);
    margin-right: 0px;
    transition: all 0.3s ease 0s;
  }
  
  .nav #logo {
    cursor: pointer;
    font-family: fantasy;
    font-size: x-large;
    font-weight: 100;
  }
  
  .nav #al {
    transition: all 0.3s ease 0s;
  }
  
  .nav #al a:hover {
    color: rgb(26, 250, 175);
   
  }
  
    </style>
</head>
<body>
    
<div class="nav">
        <div id="logo"><a href="#">EV CHARGE</a></div>
        <div id="al" style="margin-left: 400px;"><a href="../user/userlogin.php">BOOKING</a></div>
        <div id="al"><a href="../user/userlogin.php">USER</a></div>
    </div>

    
</body>
</html>