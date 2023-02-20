<?php
class GetAccount {

    function get_account($conn, $acc_id)
    {
        try
        {
            $sql = "SELECT * FROM accounts WHERE acc_id='{$acc_id}'";
            // echo $sql . "<br>";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc())
                {
                    if ($result->num_rows == 1)
                    {
                        return $row;
                    }
                }
            }
            else
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}
?>