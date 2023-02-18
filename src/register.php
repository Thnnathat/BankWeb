<?php
require('./user_manage/register_class.php');
// require('./conn.php');

$username=$_POST["username"];
$password=$_POST["password"];
$email=$_POST["email"];
$fname=$_POST["first_name"];
$lname=$_POST["last_name"];
$birthday=$_POST["birthday"];
$gender=$_POST["gender"];
$status=$_POST["married"];
echo $username."<br>".$password."<br>".$email."<br>".$fname."<br>".$lname."<br>".$birthday."<br>".$gender."<br>".$status;
echo "<br>";
echo uniqid();
// $register = new Register($username, $password, $email, $fname, $lname, $birthday, $gender, $status);
// $register->register($conn);

?>