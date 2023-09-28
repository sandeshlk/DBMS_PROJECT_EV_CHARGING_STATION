<!-- 
<?php
 
$conn = mysqli_connect("localhost","root","","ev");
if($conn -> connect_error)
{
  echo "Connection Error".(mysqli_connect_error());
  die($conn);
}

 ?> -->
 <?php

$conn = "";

try {
	$servername = "localhost:3306";
	$dbname = "ev";
	$username = "root";
	$password = "";

	$conn = new PDO(
		"mysql:host=$servername; dbname=ev",
		$username, $password
	);
	
$conn->setAttribute(PDO::ATTR_ERRMODE,
					PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

?>
