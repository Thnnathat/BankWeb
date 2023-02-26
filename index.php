<?php 
session_start();
require('./src/conn.php');
$user_err = $pass_err = "";

if (isset($_SESSION['user_id'])) { //ถ้าอยู่ในระบบอยู่ (มี acc_id ใน session variable ) จะไม่สามารถกลับมาหน้า login ได้
    header('location: ./dashboard.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //เมื่อมีข้อมูล POST เข้ามาถึงจะทำงาน (ทำการกดปุ่ม login).
    $password = $_POST['password'];
    $username = $_POST['username'];
    $user_data_row = get_user_pass($conn, $username); //รับ user, password จาก database มาเปรียบเทียบ

    if ($user_data_row){
        $row = $user_data_row;
        if ($username == $row['username']) //username ที่ป้อนเข้ามา ตรงกันหรือไม่
        {
            if ($password == $row['password']){//password ที่ป้อนเข้ามา ตรงกันหรือไม่
                $_SESSION['user_id'] = $row['user_id'];// ถ้า username, password ตรง จะเก็บ user_id ไว้ใน session แล้วไปหน้า dashboard.php
                header("location: ./dashboard.php");
            } else {
                $pass_err = "border-color: red;";
                session_destroy();
            }
        } else {
            $user_err = "border-color: red;";
            session_destroy();
        }
    } else {
        $user_err = $pass_err = "border-color: red;";
        session_destroy();
    }
}

function get_user_pass($conn, $username) {
    try {
        $sql = "SELECT * FROM users WHERE username='{$username}'";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
                return $row;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e."<br>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/index_style.css">
</head>

<body>
    <div class="master">
        <div class="container">
            <div class="login-container">
                    <div class="login-infomation">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <h1>Login</h1>
                            <div style="<?php echo $user_err; ?>" class="inputbox">
                                <input id="username" class="infomation" type="text" required name="username">
                                <label for="username">uername</label>
                            </div>
                            <div style="<?php echo $pass_err; ?>" class="inputbox">
                                <input id="password" class="infomation" type="password" required name="password">
                                <label for="password">password</label>
                            </div>
                            <div class="back-img">
                                <input id="submit" class="infomation" type="submit" value="Login" name="login">
                            </div>
                        </form>
                        <div class="back-img" id="register">
                            <a href="./register.php">
                                <button>Register</button>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>

</html>
