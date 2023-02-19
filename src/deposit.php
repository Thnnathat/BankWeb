<?php
require('./conn.php');
require('./user_manage/get_account.php');

$acc_id = $_POST['acc_id'];
$amount = $_POST['deposit-amount'];
$detail = $_POST['deposit-detail'];
$user_id = $_POST['user_id'];

$row = get_account($conn, $acc_id);

function deposit($conn, $row, $amount, $detail, $acc_id)
{
    if ($amount > 0 && $row != false)
    {
        try
        {
            $conn -> autocommit(FALSE);
            $deposit = $row['balance'] + $amount;

            //เก็บประวัติ
            $sql = "INSERT transactions(acc_id, deposit, withdraw, detail, date_time) VALUE('{$acc_id}' ,'{$amount}', '0', '{$detail}', NOW())";
            echo $sql . "<br>";
            $conn->query($sql);

            $sql = "UPDATE accounts SET balance = '{$deposit}' WHERE acc_id='{$acc_id}'";
            echo $sql . "<br>";
            $conn->query($sql);

            if (!$conn -> commit()) {
                $conn->close();
                echo "transaction failed";
                exit();
            }
            $conn->close();
            return true;
        }
        catch (Exception $e)
        {
            $conn->close();
            echo $e."<br>";
            return false;
        }
    }
    return false;
}

deposit($conn, $row, $amount, $detail, $acc_id);
header("location: ../dashboard.php?id={$user_id}");

echo $acc_id."<br>".$amount."<br>".$detail."<br>";
echo var_dump($row);
?>