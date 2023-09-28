<?php
session_start(); //start session to access the c_id

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ev";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if(isset($_SESSION['c_id'])) {
$c_id = $_SESSION['c_id']; //get the session c_id
// Retrieve deleted reservations for the logged-in owner
$sql = "SELECT R_ID, S_ID, USER_ID, START_TIME, END_TIME, DATE FROM resdeleted WHERE c_id = $c_id";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>R_ID</th><th>S_ID</th><th>USER_ID</th><th>START_TIME</th><th>END_TIME</th><th>DATE</th></tr>";
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["R_ID"]. "</td>";
        echo "<td>" . $row["S_ID"]. "</td>";
        echo "<td>" . $row["USER_ID"]. "</td>";
        echo "<td>" . $row["START_TIME"]. "</td>";
        echo "<td>" . $row["END_TIME"]. "</td>";
        echo "<td>" . $row["DATE"]. "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No deleted reservations found.</td></tr>";
}
echo "</table>";
} else {
    // Redirect to login page if user is not logged in
    header("Location: companylogin.php");
    exit;
    }
    
    $conn->close();
    ?>