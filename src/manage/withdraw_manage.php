<?php
function withdraw($conn, $row, $to_row, $amount, $detail)
{
    if (is_numeric($amount)){ //จำนวนเงินที่รับเข้ามาต้องเป็นตัวเลข 
        if ($amount > 0 && $row != false && $amount <= $row['balance'] && $to_row)// จำเนวนเงินต้องมากกว่า 0 และเงินในบัญชีปัจจุบันต้องมากกว่าจำนวนที่จะถอน และปัญชีปลายทางต้องมีตัวตน
        {
            try
            {
                $conn -> autocommit(FALSE); // คล้ายกับ register
                
                //!หักเงินออกจากบัญชีผู้โอน
                $withdraw = $row['balance'] - $amount;
                $sql = "INSERT transactions(acc_id, deposit, withdraw, detail, date_time) VALUE('{$row['acc_id']}' ,'0', '{$amount}', '{$detail}', NOW())";
                $conn->query($sql);
                
                $sql = "UPDATE accounts SET balance = '{$withdraw}' WHERE acc_id='{$row['acc_id']}'";
                $conn->query($sql);
                
                //!เพิ่มเงินบัญชีปลายทาง
                $deposit = $to_row['balance'] + $amount;
                
                $sql = "INSERT transactions(acc_id, deposit, withdraw, detail, date_time) VALUE('{$to_row['acc_id']}' ,'{$amount}', '0', '{$detail}', NOW())";
                $conn->query($sql);
    
                $sql = "UPDATE accounts SET balance = '{$deposit}' WHERE acc_id='{$to_row['acc_id']}'";
                $conn->query($sql);
                
                if (!$conn -> commit()) {
                    $conn->close();
                    echo "transaction failed";
                    return false;
                    exit();
                }
                $conn->close();
                return true;
            }
            catch (Exception $e)
            {
                $conn->rollback();
                $conn->close();
                return false;
            }
        }
    }
    return false;
}
?>