<?php
function get_important_data($conn, $id){
    try {
        $sql = "SELECT * FROM users u
                INNER JOIN accounts a on u.acc_id = a.acc_id
                INNER JOIN persons p on a.id = p.id
                INNER JOIN images i on u.user_id = i.user_id 
                WHERE p.id='{$id}'";
        $result = $conn->query($sql);
        $conn->close();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($result->num_rows == 1) {
                    return $row;
                }
            }
        } else {
            return "";
        }
    } catch (Exception $e) {
        echo $e . "<br>";
    }
}