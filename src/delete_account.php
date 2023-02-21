<?php
require('./conn.php');
require('./manage/delete_account_manage.php');

$acc_id = $_GET['acc_id'];
$delete_bool = delete($conn, $acc_id);
if ($delete_bool)
{
    header("location: ../index.php?delete=1");
}
?>