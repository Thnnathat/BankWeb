<?php
require('./src/conn.php');
$sql = "SELECT * FROM transactions WHERE acc_id = '{$acc_id}' ORDER BY date_time DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc())
{
    if ($row['deposit'] == 0)
    {
        echo "<tr>" . "<td style='color: #FF4949'>" . $row["date_time"] . "</td>" . "<td style='color: #FF4949'><div class=\"td-detail\">" . "โอน ".$row["detail"] . "</div></td>" . "<td style='color: #FF4949'>" . number_format($row["withdraw"], 2, '.', ',') . " ฿</td>" . "</tr>";
    }
    else if ($row['deposit'] > 0)
    {
        echo "<tr>" . "<td style='color: #5ed33a'>" . $row["date_time"] . "</td>" . "<td style='color: #5ed33a'> <div class=\"td-detail\">" . "ฝาก ". $row["detail"] . "</div></td>" . "<td style='color: #5ed33a'>" . number_format($row["deposit"], 2, '.', ',') . " ฿</td>" . "</tr>";
    }
}
}
else 
{
echo "0 results";
}
$conn->close();