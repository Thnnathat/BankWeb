<?php
session_start();
$confirm_pass_err = $message_pass_error = "";
require('./src/conn.php');
require('./src/manage/dashboard_manage.php');

$row = get_important_data($conn, $_SESSION['row']['id']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['new-password'])) {
    } else {
        if ($row['password'] != $_POST['new-password']) {
            if ($_POST['new-password'] == $_POST['confirm-password']) {
                echo "<script>alert('แก้ไขข้อมูลสำเร็จ')</script>";
                $new_password = $_POST['new-password'];
                echo $_POST['new-password'] . "<br>" . $new_password;
                try {
                    require('./src/conn.php');
                    $sql = "UPDATE users SET password = '$new_password' WHERE user_id = '{$row['user_id']}'";
                    $conn->query($sql);
                    $conn->close();
                } catch (Exception $e) {
                    echo $e;
                    $conn->close();
                }
            } else {
                $confirm_pass_err = "border: 1px solid #FF4949; ";
                $message_pass_error = "รหัสผ่านไม่ตรงกัน";
                // echo "<script>alert('รหัสผ่านไม่ตรงกัน')</script>";
                echo $_POST['new-password'];
            }
        }
    }

    if ($row['username'] != $_POST['edit-username'] && !empty($_POST['edit-username'])) {
        try {
            require('./src/conn.php');
            $sql = "UPDATE users SET username = '{$_POST["edit-username"]}' WHERE user_id = '{$row['user_id']}' ";
            $conn->query($sql);
            $conn->close();
            // echo "<script>alert('แก้ไขข้อมูลสำเร็จ')</script>";
        } catch (Exception $e) {
            echo $e;
            $conn->close();
        }
    }

    if ($row['email'] != $_POST['edit-email'] && !empty($_POST['edit-email'])) {
        try {
            require('./src/conn.php');
            $sql = "UPDATE users SET email = '{$_POST["edit-email"]}' WHERE user_id = '{$row['user_id']}' ";
            $conn->query($sql);
            $conn->close();
            // echo "<script>alert('แก้ไขข้อมูลสำเร็จ')</script>";
        } catch (Exception $e) {
            echo $e;
            $conn->close();
        }
    }
    header("location: ./dashboard.php?id={$row['user_id']}");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขบัญชี</title>
    <link rel="stylesheet" href="./styles/edit_style.css">
</head>

<body>
    <ul class="navbar">
        <li>
            <a class="nav-menu" id="home" href="./dashboard.php?id=<?php echo $_SESSION['row']['user_id'] ?>">หน้าหลัก</a>
        </li>
        <li>
            <a class="nav-menu" id="edit-account" href="./edit.php">แก้ไขบัญชี</a>
        </li>
        <li>
            <a class="nav-menu" id="logout" href="./index.php">ออกจากระบบ</a>
        </li>
        <li id="list-delete-account">
            <a class="nav-menu" id="delete-account" href="./src/delete_account.php?acc_id=<?php echo $_SESSION['row']['acc_id'] ?>" onclick="<?php echo "return confirm('คุณต้องการลบบัญชี " . $row['username'] . " หรือไม่ " . "')" ?>">ลบบัญชี</a>
        </li>
    </ul>
    <form class="form-edit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="image" src="" alt="">
        <input type="text" name="edit-username" id="edit-username" placeholder="new username" value="<?php echo $row['username'] ?>">
        <input type="email" name="edit-email" id="edit-email" placeholder="new email" value="<?php echo $row['email'] ?>">
        <input type="password" name="new-password" id="new-password" placeholder="new password">
        <input style="<?php echo $confirm_pass_err; ?>" type="password" name="confirm-password" id="confirm-password" placeholder="confirm password">
        <span style="color: #FF4949"><?php echo $message_pass_error ?></span>
        <input type="submit" value="บันทึก">
    </form>
</body>

</html>