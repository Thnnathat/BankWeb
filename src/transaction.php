<?php
require('conn.php');
function get_transaction($conn, $acc_id)
{
    $sql = "SELECT * FROM transactions WHERE acc_id = '{$acc_id}' ORDER BY date_time DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
    {
        if ($row['deposit'] == 0)
        {
            echo "<tr>" . "<td style='color: #FF4949'>" . $row["date_time"] . "</td>" . "<td style='color: #FF4949'>" . "โอน ".$row["detail"] . "</td>" . "<td style='color: #FF4949'>" . $row["withdraw"] . "</td>" . "</tr>";
        }
        else if ($row['deposit'] > 0)
        {
            echo "<tr>" . "<td style='color: #5ed33a'>" . $row["date_time"] . "</td>" . "<td style='color: #5ed33a'>" . "ฝาก ". $row["detail"] . "</td>" . "<td style='color: #5ed33a'>" . $row["deposit"] . "</td>" . "</tr>";
        }
    }
    }
    else 
    {
    echo "0 results";
    }
    $conn->close();
}

