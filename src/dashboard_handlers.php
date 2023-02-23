<?php
require('./src/conn.php');
require('./src/manage/dashboard_manage.php');
//!error ตรงนี้ ระวัง

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $row = get_important_data($conn, $user_id);
    echo var_dump($row);
} else {
    header("location: ./index.php");
}

function get_name($first_name, $last_name, $gender, $birthday, $married)
{

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

