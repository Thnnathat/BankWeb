<?php
require('./user_manage/login_manage.php');
require('./conn.php');

$username = $_POST['username'];
$password = $_POST['password'];

// echo $username."<br>".$password."<br>";
// echo "Hello World"."<br>";
$auth = login($conn, $username, $password);

if (strlen($auth) == 13)
{
    header("location: ../dashboard.php?id={$auth}");
}
else
{
    header("location: ../index.php?login_status=0");
}
?>