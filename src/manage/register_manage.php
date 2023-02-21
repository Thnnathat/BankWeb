<?php

function register($conn, $username, $password, $email, $fname, $lname, $birthday, $gender, $status)
{
    try {
        $conn -> autocommit(FALSE);

        //*สร้าง person
        $id = uniqid();
        $value = "'{$id}','{$fname}', '{$lname}', '{$gender}', '{$birthday}', '{$status}'";
        $sql = "INSERT INTO persons(id, first_name, last_name, gender, birthday, married) VALUES($value)";
        $conn -> query($sql);

        //*สร้าง account
        $value = "'{$id}','{$id}'";
        $sql = "INSERT INTO accounts(id, acc_id) VALUES($value)";
        $conn -> query($sql);

        //*สร้าง user
        $value = "'{$id}','{$id}', '{$email}', '{$username}', '{$password}'";
        $sql = "INSERT INTO users(acc_id, user_id, email, username, password) VALUES($value)";
        $conn -> query($sql);

        //*สร้าง image
        $value = "'{$id}','{$id}'";
        $sql = "INSERT INTO images(user_id, img_id) VALUES($value)";
        $conn -> query($sql);

        if (!$conn -> commit()) {
            echo "Commit transaction failed";
            exit();
        }
        $conn->close();
        return $id;
    } catch (Exception $e) {
        $conn->rollback();
        echo $e;
        $conn->close();
        return false;
    }
}
