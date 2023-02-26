<?php
//insert.
require('./src/manage/register_manage.php');

//ฟังก์ชันตรวจสอบการมีอยู่ของข้อมูลใน database.
function get_username($conn, $username) {
    try {
        $sql = "SELECT username FROM users WHERE username='{$username}'";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
                return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e."<br>";
    }
}

function get_email($conn, $email) {
    try {
        $sql = "SELECT email FROM users WHERE email='{$email}'";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
                return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e."<br>";
    }
}

?>