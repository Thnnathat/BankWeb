<?php
function delete($conn, $acc_id)
{
    try
    {
        $conn -> autocommit(FALSE);

        $sql = "SELECT user_id FROM users WHERE acc_id = '{$acc_id}'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
        }

        $sql = "SELECT * FROM images WHERE user_id = '{$user_id}'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $img_id = $row['img_id'];
            $img_name = $row['img_name'];
        }

        $sql = "DELETE FROM images WHERE user_id = '{$user_id}'";
        $conn->query($sql);
        
        $sql = "DELETE FROM users WHERE acc_id = '{$acc_id}'";
        $conn->query($sql);
        
        $sql = "DELETE FROM transactions WHERE acc_id = '{$acc_id}'";
        $conn->query($sql);

        $sql = "SELECT id FROM accounts WHERE acc_id = '{$acc_id}'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $id = $row['id'];
        }

        $sql = "DELETE FROM accounts WHERE id = '{$id}'";
        $conn->query($sql);
        
        $sql = "DELETE FROM persons WHERE id = '{$id}'";
        $conn->query($sql);
        
        
        if (!$conn -> commit()) {
            $conn->close();
            echo "transaction failed";
            exit();
        }
        $img_path = $img_id.$img_name;
        unlink("../server/images/$img_path");// ลบไฟล์ภาพ

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

?>