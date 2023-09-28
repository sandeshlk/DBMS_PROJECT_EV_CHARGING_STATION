<?php
$connection = mysqli_connect("localhost", "root", "", "ev");

$query = "SELECT AVG(total_cost) as 'Average Cost', 
                 AVG(units_consumed) as 'Average Units Consumed',
                 MAX(units_consumed) as 'Highest Units Consumed',
                 SUM(units_consumed) as 'Total Units Consumed',
                 s_id
          FROM entries
          GROUP BY s_id";
$result = mysqli_query($connection, $query);
echo '<table border="1">';
echo '<tr>';
echo '<th>STATION ID</th>';
echo '<th>Average Cost</th>';
echo '<th>Average Units Consumed</th>';
echo '<th>Highest Units Consumed</th>';
echo '<th>Total Units Consumed</th>';
echo '</tr>';

while($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>'.$row['s_id'].'</td>';
    echo '<td>'.$row['Average Cost'].'</td>';
    echo '<td>'.$row['Average Units Consumed'].'</td>';
    echo '<td>'.$row['Highest Units Consumed'].'</td>';
    echo '<td>'.$row['Total Units Consumed'].'</td>';
    echo '</tr>';
}

echo '</table>';
mysqli_close($connection);


?>