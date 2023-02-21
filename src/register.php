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

if ($id)
{
    header("location: ../dashboard.php?id={$id}");
}
else {
    header("location: ./register.php?id=0");
}
?>