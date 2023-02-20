<?php
require('./manage/login_manage.php');
require('./conn.php');

$username = $_POST['username'];
$password = $_POST['password'];

// echo $username."<br>".$password."<br>";
// echo "Hello World"."<br>";
$user_id = login($conn, $username, $password);

if ($user_id)
{
    header("location: ../dashboard.php?id={$user_id}");
}
else
{
    header("location: ../index.php?login_status=0");
}
?>