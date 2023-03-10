<?php
require('./src/conn.php');
require('./src/manage/dashboard_manage.php');
//!error ตรงนี้ ระวัง
$user_id = $_GET['id'];
$row = get_important_data($conn, $user_id);

if (!isset($row['user_id']) || !isset($row['id'])){
    header("location: ./src/login.php");
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

