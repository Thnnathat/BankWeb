<?php
function delete($conn, $acc_id)
{
    try
    {
        $conn->autocommit(FALSE);
        $sql = "DELETE FROM images WHERE acc_id = '{$acc_id}'";
        
    }
    catch (Exception $e)
    {

    }
}

function delete_img($acc_id)
{
    try
    {
        
    }
    catch (Exception $e)
    {

    }
}
?>