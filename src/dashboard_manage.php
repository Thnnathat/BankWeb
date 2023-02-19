<?php

function get_important_data($conn, $user_id)
{
    try {
        $sql = "SELECT * FROM users u
                INNER JOIN accounts a on u.acc_id = a.acc_id
                INNER JOIN persons p on a.id = p.id
                INNER JOIN images i on u.user_id = i.user_id 
                WHERE u.user_id='{$user_id}'";
        // echo $sql . "<br>";
        $result = $conn->query($sql);
        // $conn->close();

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

function get_name($first_name, $last_name, $gender, $birthday, $married)
{
    //* cr. Stack overflow.
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthday), date_create($today));
    $age = $diff->format('%y');

    $prefix = "";
    if ($gender == "male") {
        if ($age >= 15) {
            $prefix = "นาย";
        } else {
            $prefix = "เด็กชาย";
        }
    } else {
        if ($married == "married") {
            $prefix = "นาง";
        } else {
            if ($age < 15) {
                $prefix = "เด็กหญิง";
            } else {
                $prefix = "นางสาว";
            }
        }
    }
    $name = $prefix . " " . $first_name . " " . $last_name;
    return $name;
}
