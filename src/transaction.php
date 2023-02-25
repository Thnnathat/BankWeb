<?php
require('./src/conn.php');
$acc_id = $_SESSION['acc_id'];

$sql = "SELECT * FROM transactions WHERE acc_id = '{$acc_id}' ORDER BY date_time DESC";
$result = $conn->query($sql);

echo "<table>";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc())
{
    if ($row['deposit'] == 0)
    {
        echo "<tr>" . "<td style='color: #ff3300;'>" . $row["date_time"] . "</td>" . "<td style='color: #ff3300;'><div class=\"td-detail\">" . "โอน ".$row["detail"] . "</div></td>" . "<td style='color: #ff3300;'>" . number_format($row["withdraw"], 2, '.', ',') . " ฿</td>" . "</tr>";
    }
    else if ($row['deposit'] > 0)
    {
        echo "<tr>" . "<td style='color: #adff2f;'>" . $row["date_time"] . "</td>" . "<td style='color: #adff2f;'> <div class=\"td-detail\">" . "ฝาก ". $row["detail"] . "</div></td>" . "<td style='color: #adff2f;'>" . number_format($row["deposit"], 2, '.', ',') . " ฿</td>" . "</tr>";
    }
}
}
else 
{
echo "0 results";
}
echo "</table>";
$conn->close();