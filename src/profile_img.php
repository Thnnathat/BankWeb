<?php

// รับข้อมูลรูปภาพคนปัจจุบันมา
if (isset($_POST['img_id']) && isset($_POST['img_name'])) {
    $img_id = $_POST['img_id'];
    $img_name = $_POST['img_name'];
}

$target_dir = "../server/images/";
$old_file = $target_dir . $img_id . $img_name;// กำหนดตำแหน่งรูปของผู้ใช้ปัจจุบันมา เพื่อที่จะแทนที่ไฟล์

if (!empty($_FILES['profile-upload']['name'])) {
    $file_name = basename($_FILES["profile-upload"]["name"]);// รับชื่อไฟล์ที่อัพโหลดมา.
    $target_file_path = $target_dir . $img_id . $file_name;// ตำแหน่งรูปใหม่.

    $allow_file_type = array('jpg', 'png', 'jpeg', 'svg');
    $imageFileType = pathinfo($target_file_path, PATHINFO_EXTENSION);

    if ($target_file_path !== $old_file) {
        if (in_array($imageFileType, $allow_file_type)) {
            if (move_uploaded_file($_FILES['profile-upload']['tmp_name'], $target_file_path)) {// ย้าไฟล์จาก tmp ไปเก็บไน server/images/ชื่อรูป | เอารูปใหม่ไปเก็บ
                require("./conn.php");

                try {
                    $sql = "UPDATE images SET img_name = '{$file_name}' WHERE img_id = '{$img_id}'";// เพิ่มตำแหน่งรูปใหม่ให้ user.
                    $conn->query($sql);
                    $conn->close();
                    unlink($old_file);// รบรูปเดิมออก
                } catch (Exception $e) {
                }
            }
        }
    }
    header("location: ../dashboard.php");
}

?>
