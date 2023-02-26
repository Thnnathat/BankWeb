<?php
function register($conn, $username, $password, $email, $fname, $lname, $birthday, $gender, $status)
{
    try {
        //ปิด auto commit.
        $conn -> autocommit(FALSE);

        //ความสัมพันธ์ one to one.
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

        //TODO: เมื่อเพิ่มข้อมูลครบโดยไม่มีข้อผิดพลาด ก็จะ commit
        if (!$conn -> commit()) {
            echo "Commit transaction failed";
            exit();
        }
        $conn->close();
        return $id;
        //* ถ้าสำเร็จจะส่งค่า id ผู้ใช้กลับไปหน้า register.php (UI).
    } catch (Exception $e) {
        //! เมื่อผิดพลาด(การ insert ข้อมูลไม่สมบูรณ์) โปรแกรมจะทำการ rollback ข้อมูล (ทำให้ข้อมูล ไม่ถูกเพิ่ม)
        $conn->rollback();
        echo $e;
        $conn->close();
        return false;
    }
}
