<?php
session_start();

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'ev');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to make a reservation.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h4 {
            color: #034ea1;
        }

        /* Style for the oval-shaped logout button */
        .logout-button {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 8px 20px;
            cursor: pointer;
            border-radius: 20px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #034ea1;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        form {
            display: inline-block;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        /* Oval-shaped button styles */
        input[type="submit"] {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 6px 16px;
            cursor: pointer;
            border-radius: 20px;
            width: 100px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        /* Hover effect */
        input[type="submit"]:hover {
            background-color: #2980b9;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
        }

        /* Style for the search form */
        .search-form {
            margin-top: 20px;
            text-align: center;
        }

        /* Style for the search input */
        .search-input {
            padding: 6px 16px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: 300px;
            margin-right: 10px;
        }

        /* Style for the search button */
        .search-button {
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
        .search-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <h4>Logged in as: <?php echo $_SESSION['user_id']; ?></h4>
    <form action="logout.php" method="post">
        <button type="submit" class="logout-button">Logout</button>
    </form>

    <br>
    <h4>Upcoming Reservations:</h4>

    <?php
    $user_id = $_SESSION['user_id'];

    // Display the reservations for the user
    $query = "SELECT r.r_id, r.s_id, r.start_time, r.end_time, s.s_name AS station_name, c.c_name, c.c_contact, c.c_email
              FROM reservations r
              INNER JOIN station s ON r.s_id = s.s_id
              INNER JOIN company c ON s.c_id = c.c_id
              WHERE r.user_id='$user_id'";
    $result = mysqli_query($db, $query);
    ?>

    <table>
        <tr>
            <th>RESERVATION ID</th>
            <th>STATION ID</th>
            <th>START</th>
            <th>END</th>
            <th>Station Name</th>
            <th>Company Name</th>
            <th>CONTACT</th>
            <th>E-MAIL</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['r_id']; ?></td>
                <td><?php echo $row['s_id']; ?></td>
                <td><?php echo $row['start_time']; ?></td>
                <td><?php echo $row['end_time']; ?></td>
                <td><?php echo $row['station_name']; ?></td>
                <td><?php echo $row['c_name']; ?></td>
                <td><?php echo $row['c_contact']; ?></td>
                <td><?php echo $row['c_email']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <h4>Available Stations:</h4>

    <?php
    // Check if the form has been submitted
    if (isset($_POST['search_button'])) {
        // Get the search input
        $search = mysqli_real_escape_string($db, $_POST['search']);

        // Query to fetch stations matching the search input
        $query = "SELECT S.s_id, S.s_name, S.timing_open, S.timing_close, F.available_slots, L.city, L.address
              FROM station S
              INNER JOIN features F ON S.s_id = F.s_id
              INNER JOIN location L ON S.s_id = L.s_id
              WHERE F.available_slots > 0 AND (S.s_name LIKE '%$search%' OR L.city LIKE '%$search%' OR L.address LIKE '%$search%')";

        $result = mysqli_query($db, $query);
    } else {
        // Query to fetch all available stations
        $query = "SELECT S.s_id, S.s_name, S.timing_open, S.timing_close, F.available_slots, L.city, L.address
              FROM station S
              INNER JOIN features F ON S.s_id = F.s_id
              INNER JOIN location L ON S.s_id = L.s_id
              WHERE F.available_slots > 0";

        $result = mysqli_query($db, $query);
    }
    ?>

    <form method="post" action="booking.php" class="search-form">
        <label for="search"  style="color: #034ea1; font-weight: bold; display: block; text-align: left; margin-bottom: 5px;">Search Stations:</label>
        <input type="text" id="search" name="search" placeholder="Search name, address, or city" class="search-input">
        <input type="submit" name="search_button" value="Search" class="search-button">
    </form>

    <table>
        <tr>
            <th>Station ID</th>
            <th>Station Name</th>
            <th>City</th>
            <th>Address</th>
            <th>Slots Remaining</th>
            <th>Open</th>
            <th>Close</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['s_id']; ?></td>
                <td><?php echo $row['s_name']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['available_slots']; ?></td>
                <td><?php echo $row['timing_open']; ?></td>
                <td><?php echo $row['timing_close']; ?></td>
                <td>
                    <form method="post" action="booking.php">
                        <input type="hidden" name="s_id" value="<?php echo $row['s_id']; ?>">
                        <label for="start_time">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" required>
                        <label for="end_time">End Time:</label>
                        <input type="time" id="end_time" name="end_time" required>
                        <input type="date" id="dat" name="dat" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                        <input type="submit" name="submit" value="Book">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>

