<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Table Page</title>
    
    <style>
        /* Add the CSS styles here */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #034ea1;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #00A86B;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php
    $connection = mysqli_connect("localhost", "root", "", "ev");

    $query = "SELECT S.S_ID, S.S_NAME, COUNT(R.R_ID) AS 'Total Reservations', SUM(F.COST_PER_UNIT) AS 'Total Amount'
FROM station S
LEFT JOIN reservations R ON S.S_ID = R.S_ID
LEFT JOIN features F ON S.S_ID = F.S_ID
GROUP BY S.S_ID, S.S_NAME;
";
    $result = mysqli_query($connection, $query);
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>Station ID</th>';
    echo '<th>Station Name</th>';
    echo '<th>Total Reservations</th>';
    echo '<th>Total Amount</th>';
    echo '</tr>';

    while($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>'.$row['S_ID'].'</td>';
        echo '<td>'.$row['S_NAME'].'</td>';
        echo '<td>'.$row['Total Reservations'].'</td>';
        echo '<td>'.$row['Total Amount'].'</td>';
        echo '</tr>';
    }

    echo '</table>';
    mysqli_close($connection);
    ?>
</body>
</html>

