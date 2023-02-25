<?php
session_start();
require('./conn.php');
require('./manage/delete_account_manage.php');

$acc_id = $_SESSION['acc_id'];
$delete_bool = delete($conn, $acc_id);
if ($delete_bool)
{
    session_destroy();
    unset($_SESSION);
    header("location: ../index.php");
}
?>