<html>

<head>
  <title>Manage Reservations</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
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
    th,
    td {
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
    }
  </style>
</head>

<body>
  <br>
  <form action="updateres.php" method="post">
  <button type="submit" class="logout-button">Update</button>
</form>
<body>
   <form action="logout.php" method="post">
  <button type="submit" class="logout-button">Logout</button>
</form>
  <br>
  <?php
  session_start();
  if (!isset($_SESSION['c_id'])) {
    header('Location: companylogin.php');
    exit;
  }
  // Connect to the database
  $db = mysqli_connect('localhost', 'root', '', 'ev');
  // Escape the user input to prevent SQL injection attacks
  $c_id = mysqli_real_escape_string($db, $_SESSION['c_id']);
  // Delete a reservation
  if (isset($_POST['delete_id'])) {
    $id = mysqli_real_escape_string($db, $_POST['delete_id']);
    // Delete the reservation from the database
    $query = "DELETE FROM reservations WHERE r_id='$id'";
    mysqli_query($db, $query);
    // $query1 = "UPDATE features SET available_slots=availabe_slots+1 WHERE fe.s_id=r_id='$id'";
    // mysqli_query($db, $query1);
  }

  // Display the reservations for the owner's stations
  $query = "SELECT r.r_id, r.s_id, r.user_id, r.start_time, r.end_time,r.date,s.s_name,s.c_id  AS station_name FROM reservations r
                INNER JOIN station s ON r.s_id=s.s_id
                WHERE s.c_id='$c_id'";
  $result = mysqli_query($db, $query);
  ?>
  <table>
    <tr>
      <th>RESERVATION ID</th>
      <th>STATION ID</th>
      <th>USER ID</th>
      <th>START</th>
      <th>END</th>
      <th>Station Name</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?php echo $row['r_id']; ?></td>
        <td><?php echo $row['s_id']; ?></td>
        <td><?php echo $row['user_id']; ?></td>
        <td><?php echo $row['start_time']; ?></td>
        <td><?php echo $row['end_time']; ?></td>
        <td><?php echo $row['station_name']; ?></td>
        <td><?php echo $row['date']; ?></td>

        <td>
          <form method="post">
            <input type="hidden" name="delete_id" value="<?php echo $row['r_id']; ?>">
            <input type="submit"  class="logout-button" value="Delete">



          </form>
        </td>

        
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>

</html>
