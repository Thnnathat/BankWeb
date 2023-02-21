<?php
require('./manage/register_manage.php');
require("./conn.php");
$username=$_POST["username"];
$password=$_POST["password"];
$email=$_POST["email"];
$fname=$_POST["first_name"];
$lname=$_POST["last_name"];
$birthday=$_POST["birthday"];
$gender=$_POST["gender"];
$status=$_POST["married"];

$id = register($conn, $username, $password, $email, $fname, $lname, $birthday, $gender, $status);

//Register ได้ให้ไปหน้า dashboard.
if ($id)
{
    header("location: ../dashboard.php?id={$id}");
}
//Register ไม่ได้ให้ register ใหม่.
else {
    header("location: ../dashboard.php?id=0");
}
?>