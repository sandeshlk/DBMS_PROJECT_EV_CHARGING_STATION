<html>
  <head>
    <title>Manage Stations</title>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Mulish:wght@600&display=swap'); 

        table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 30px;
}
.logout-button {
  background-color: #3498db; /* Button background color */
  border: none;
  color: white;
  padding: 8px 20px; /* Adjust padding as needed */
  cursor: pointer;
  border-radius: 20px; /* Half of the button's width for oval shape */
  text-decoration: none; /* Remove default link underline */
  transition: background-color 0.3s ease; /* Smooth hover effect for background */
}

.logout-button:hover {
  background-color: #2980b9; /* Button background color on hover */
}

.b{
  display: flex;
  align-items: center;
  text-align: center;
  width: 140px;
  height: 20px;
  padding: 10px 20px;
  color: black;
  border: 2px solid black;
  background-color: palegreen;
  margin-left: 10px;
}
.b:hover{
  background-color: salmon;
  color: #f2f2f2;
}
a{
  font-family: 'Mulish', sans-serif;
  text-decoration: none;
  font-size: 1.3rem;
  padding: 30px 30px;
  color: black;
  

}
a:hover{
  color: white;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

th {
  background-color: #034ea1;
  color: white;
}

form {
  display: inline-block;
  margin-top: 30px;
}
.ab{
  display: flex;
}

    </style>
 <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this station?");
    }
</script>

</head>
<body>
    <form action="addnewstation.php" method="post">
        <button type="submit" class="logout-button">Add New Station</button>
    </form>

    <form action="handleres.php" method="post">
        <button type="submit" class="logout-button">Reservations</button>
    </form>

    <form action="logout.php" method="post">
        <button type="submit" class="logout-button">Logout</button>
    </form>

    <h2>Existing Stations:</h2>
    <?php
    session_start();
    if (!isset($_SESSION['c_id'])) {
        header('Location: companylogin.php');
        exit;
    }
    // Connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'ev');
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Escape the user input to prevent SQL injection attacks
    $c_id = mysqli_real_escape_string($db, $_SESSION['c_id']);

    // Handle station deletion
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
        $delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);
        
        // Check if the station belongs to the company before deleting
        $query = "SELECT * FROM station WHERE S_ID = '$delete_id' AND C_ID = '$c_id'";
        $result = mysqli_query($db, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // The station belongs to the company, so you can proceed with deletion
            $delete_query = "DELETE FROM station WHERE S_ID = '$delete_id'";
            if (mysqli_query($db, $delete_query)) {
                echo "Station with ID $delete_id has been deleted successfully.";
            } else {
                echo "Error deleting station: " . mysqli_error($db);
            }
        } else {
            // Handle the case where the station with the given ID doesn't exist or doesn't belong to the company
            echo "Station with ID $delete_id does not exist or does not belong to your company.";
        }
    }

    // Display the stations owned by the owner
    $query = "SELECT s_id, s_name FROM station WHERE c_id='$c_id'";
    $result = mysqli_query($db, $query);
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['s_id']; ?></td>
                <td><?php echo $row['s_name']; ?></td>
                <td>
                    <form method="post" onsubmit="return confirmDelete();">
    <input type="hidden" name="delete_id" value="<?php echo $row['s_id']; ?>">
    <input type="submit" class="logout-button" value="Delete">
</form>

                    <form method="post" action="updatestation.php">
                        <input type="hidden" name="station_id" value="<?php echo $row['s_id']; ?>">
                        <input type="submit" class="logout-button" value="Update">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

