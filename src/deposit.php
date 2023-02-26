<?php
require('./manage/deposit_manage.php');
require_once('./manage/get_account.php');

$acc_id = $_POST['acc_id'];
$amount = $_POST['deposit-amount'];
$detail = $_POST['detail'];

require('./conn.php');
$acc = new GetAccount();
$row = $acc->get_account($conn, $acc_id);

require('./conn.php');
$deposit = deposit($conn, $row, $amount, $detail, $acc_id);
header("location: ../dashboard.php");
?>