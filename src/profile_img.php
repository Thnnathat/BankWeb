<?php

if (isset($_POST['img_id']) && isset($_POST['img_name'])) {
    $img_id = $_POST['img_id'];
    $img_name = $_POST['img_name'];
}

$target_dir = "../server/images/";
$old_file = $target_dir . $img_id . $img_name;

if (!empty($_FILES['profile-upload']['name'])) {
    $file_name = basename($_FILES["profile-upload"]["name"]);
    $target_file_path = $target_dir . $img_id . $file_name;

    $allow_file_type = array('jpg', 'png', 'jpeg', 'svg');
    $imageFileType = pathinfo($target_file_path, PATHINFO_EXTENSION);

    if ($target_file_path !== $old_file) {
        if (in_array($imageFileType, $allow_file_type)) {
            if (move_uploaded_file($_FILES['profile-upload']['tmp_name'], $target_file_path)) {
                echo "Uploaded";
                require("./conn.php");

                try {
                    $sql = "UPDATE images SET img_name = '{$file_name}' WHERE img_id = '{$img_id}'";
                    $conn->query($sql);
                    $conn->close();
                    unlink($old_file);
                } catch (Exception $e) {
                }
            }
        }
    }
    header("location: ../dashboard.php");
}

?>
