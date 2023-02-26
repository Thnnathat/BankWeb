<?php
function deposit($conn, $row, $amount, $detail, $acc_id)
{
    if ($amount > 0 && $row != false && is_numeric($amount))//เงินที่ฝากเข้ามาต้องมากกว่า 0 และเงินต้องเป็นตัวเลข
    {
        try
        {
            $conn -> autocommit(FALSE);
            $deposit = $row['balance'] + $amount;

            //เก็บประวัติ
            $sql = "INSERT transactions(acc_id, deposit, withdraw, detail, date_time) VALUE('{$acc_id}' ,'{$amount}', '0', '{$detail}', NOW())";
            $conn->query($sql);

            $sql = "UPDATE accounts SET balance = '{$deposit}' WHERE acc_id='{$acc_id}'";
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
            $conn->rollback();
            $conn->close();
            echo $e."<br>";
            return false;
        }
    }
    return false;
}
?>