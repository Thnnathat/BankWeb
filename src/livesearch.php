<?php
session_start();
$acc_id = $_SESSION['acc_id'];

require('./conn.php');
$sql = "SELECT * FROM transactions WHERE acc_id = '{$acc_id}' ORDER BY date_time DESC";
if (!empty($_GET['q'])) {
    $keyword = $_GET['q'];
    $sql = "SELECT * FROM transactions WHERE acc_id = '{$acc_id}' AND (detail LIKE '%{$keyword}%' OR date_time LIKE '%{$keyword}%' OR withdraw LIKE '%{$keyword}%' OR deposit LIKE '%{$keyword}%') ORDER BY date_time DESC";
}
$result = $conn->query($sql);
$conn->close();

echo "<table class='history-table'>";
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc())
{
    if ($row['deposit'] == 0)
    {
        echo "<tr>" . "<td style='color: red;'>" . $row["date_time"] . "</td>" . "<td style='color: red;'>" . "โอน ".$row["detail"] . "</td>" . "<td style='color: red;'>" . number_format($row["withdraw"], 2, '.', ',') . " ฿</td>" . "</tr>";
    }
    else if ($row['deposit'] > 0)
    {
        echo "<tr>" . "<td style='color: green;'>" . $row["date_time"] . "</td>" . "<td style='color: green;'>" . "ฝาก ". $row["detail"] . "</td>" . "<td style='color: green;'>" . number_format($row["deposit"], 2, '.', ',') . " ฿</td>" . "</tr>";
    }
}
}
else 
{
echo "0 results";
}
echo "</table>";