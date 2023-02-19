<?php
require('./conn.php');
require('./user_manage/get_account.php');
// require('./deposit.php');

$acc_id = $_POST['acc_id'];
$to_account= $_POST['withdraw-acc_id'];
$amount = $_POST['withdraw-amount'];
$detail = $_POST['withdraw-detail'];
$user_id = $_POST['user_id'];


function withdraw($conn, $row, $amount, $detail, $acc_id, $to_account)
{
    //! problem เงินไม่พอถอน ทำให้ติดลบ
    if ($amount > 0 && $row != false && $amount <= $row['balance'])
    {
        try
        {
            $conn -> autocommit(FALSE);
            
            //หักเงินออกจากบัญชีผู้นโอน
            $withdraw = $row['balance'] - $amount;
            $sql = "INSERT transactions(acc_id, deposit, withdraw, detail, date_time) VALUE('{$acc_id}' ,'0', '{$amount}', '{$detail}', NOW())";
            // echo $sql . "<br>";
            $conn->query($sql);
            
            $sql = "UPDATE accounts SET balance = '{$withdraw}' WHERE acc_id='{$acc_id}'";
            // echo $sql . "<br>";
            $conn->query($sql);
            
            //เพิ่มเงินบัญชีปลายทาง
            $row = get_account($conn, $to_account);
            $deposit = $row['balance'] + $amount;
            
            $sql = "INSERT transactions(acc_id, deposit, withdraw, detail, date_time) VALUE('{$to_account}' ,'{$amount}', '0', '{$detail}', NOW())";
            // echo $sql . "<br>";
            $conn->query($sql);

            $sql = "UPDATE accounts SET balance = '{$deposit}' WHERE acc_id='{$to_account}'";
            // echo $sql . "<br>";
            $conn->query($sql);
            // return deposit($conn, $row, $amount, $detail, $to_account);
            
            if (!$conn -> commit()) {
                $conn->close();
                echo "transaction failed";
                exit();
            }
            // $conn->close();
            return true;
        }
        catch (Exception $e)
        {
            $conn->close();
            // echo $e."<br>";
            return false;
        }
    }
    return false;
}

$row = get_account($conn, $acc_id);
withdraw($conn, $row, $amount, $detail, $acc_id, $to_account);
header("location: ../dashboard.php?id={$user_id}");

// echo $acc_id."<br>".$amount."<br>".$detail."<br>".$to_account."<br>";
// echo var_dump($row);
?>