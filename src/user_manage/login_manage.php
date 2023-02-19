<?php

function login($conn, $username, $password)
{
    try {
        $sql = "SELECT user_id FROM users WHERE username='{$username}' AND password='{$password}'";
        // echo $sql . "<br>";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // echo "id: " . $row["user_id"];
                if ($result->num_rows == 1) {
                    return $row['user_id'];
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
