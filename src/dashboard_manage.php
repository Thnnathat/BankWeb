<?php

function get_important_data($conn, $user_id)
{
    try {
        $sql = "SELECT * FROM users u
                INNER JOIN accounts a on u.acc_id = a.acc_id
                INNER JOIN persons p on a.id = p.id
                INNER JOIN images i on u.user_id = i.user_id 
                WHERE u.user_id='{$user_id}'";
        echo $sql . "<br>";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($result->num_rows == 1) {
                    return $row;
                }
            }
        } else {
            return "";
        }
        $conn->close();
    } catch (Exception $e) {
        echo $e . "<br>";
    }
}

// function get_picture()
// {
//     $image_name = "person-svgrepo-com.svg";
//     echo "{$image_name}";
// }

// function get_name (){
//     echo "Thnnathat";
// }

// function get_acc_id ()
// {
//     echo "6440201561";
// }

// function get_balance()
// {
//     echo "1000000000000";
// }

function get_data()
{
    for ($i = 0; $i < 10; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 4; $j++) {
            echo "<td>Thnnathat</td>";
        }
        echo "</tr>";
    }
}
