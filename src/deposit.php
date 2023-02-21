<?php
require('./manage/deposit_manage.php');
require_once('./manage/get_account.php');
require('./conn.php');

$acc_id = $_POST['acc_id'];
$amount = $_POST['deposit-amount'];
$detail = $_POST['deposit-detail'];
$user_id = $_POST['user_id'];

$acc = new GetAccount();
$row = $acc->get_account($conn, $acc_id);

deposit($conn, $row, $amount, $detail, $acc_id);
header("location: ../dashboard.php?id={$user_id}");

?>