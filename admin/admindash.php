<?php

include_once "connection_proc.php";

$sql = "SELECT * from adminlogin;;";
$res = mysqli_query($conn, $sql);
$ress = mysqli_num_rows($res);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style> body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    text-align: center;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 24px;
    color: #034ea1;
}

.container a {
    display: block;
    padding: 15px;
    margin: 10px 0;
    background-color: #034ea1;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s;
}

.container a:hover {
    background-color: #00A86B;
}
</style>
</head>
<body>
    <h2 style="text-align: center;">Welcome To Admin Page</h2>
    <br><br>
    <div class="container">
    <br>
        <a href="../admin/reporthtml.php">Generate Report </a>
	<br>
        <a href="../admin/i1.php">Add Owner</a>
	<br>
	 <a href="../admin/adminlogin.php">LOGOUT</a>
	 <br>
    </div>
</body>
</html>
