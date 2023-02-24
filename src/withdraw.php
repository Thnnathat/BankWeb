<?php
require('./conn.php');
require('./manage/get_account.php');
require_once('./manage/withdraw_manage.php');

$acc_id = $_POST['acc_id'];
$to_account= $_POST['withdraw-acc_id'];
$amount = $_POST['withdraw-amount'];
$detail = $_POST['detail'];

$acc = new GetAccount();
$row = $acc->get_account($conn, $acc_id);

$to_acc = new GetAccount();
$to_row = $to_acc->get_account($conn, $to_account);

withdraw($conn, $row, $to_row, $amount, $detail);
header("location: ../dashboard.php");
?>