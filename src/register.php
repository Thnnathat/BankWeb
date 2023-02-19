<?php
require('./user_manage/register_manage.php');
require("./conn.php");
$username=$_POST["username"];
$password=$_POST["password"];
$email=$_POST["email"];
$fname=$_POST["first_name"];
$lname=$_POST["last_name"];
$birthday=$_POST["birthday"];
$gender=$_POST["gender"];
$status=$_POST["married"];
echo $username."<br>".$password."<br>".$email."<br>".$fname."<br>".$lname."<br>".$birthday."<br>".$gender."<br>".$status."<br>";

$check_regis = register($conn, $username, $password, $email, $fname, $lname, $birthday, $gender, $status);
echo $check_regis;
if (strlen($check_regis) == 13)
{
    header("location: ../dashboard.php?id={$check_regis}");
}
else {
    header("location: ../dashboard.php?id=0");
}
// echo var_dump($conn);
?>