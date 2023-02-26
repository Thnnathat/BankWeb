<?php
require('./manage/get_account.php');
require_once('./manage/withdraw_manage.php');

$acc_id = $_POST['acc_id'];
$to_account= $_POST['withdraw-acc_id'];
$amount = $_POST['withdraw-amount'];
$detail = $_POST['detail'];

require('./conn.php');
$acc = new GetAccount();
$row = $acc->get_account($conn, $acc_id); // เอาข้อมูลบัญชีต้นทางมา (current user)
require('./conn.php');
$to_acc = new GetAccount();
$to_row = $to_acc->get_account($conn, $to_account); // เอาข้อมูลบัญชีปลายทางมา

require('./conn.php');
$transfer = withdraw($conn, $row, $to_row, $amount, $detail);// ทำการโอน

header("location: ../dashboard.php");
?>