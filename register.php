<?php 
session_start();
require('./src/register.php');
$err = [false,false,false];

if (isset($_SESSION['user_id'])) {
    header('location: ./dashboard.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    $status = $_POST["married"];

    // echo $username."<br>".$email."<br>".$password."<br>".$confirm_password."<br>".$first_name."<br>".$last_name."<br>".$birthday."<br>".$gender."<br>".$status."<br>";
    $style = "border-color: red;";

    require('./src/conn.php');
    $username_db = get_username($conn, $username);

    require('./src/conn.php');
    $email_db = get_email($conn, $email);

    if ($username_db){
        $user_err[0] = $style;
        $user_err[1] = "Username already in use.";
        $err[0] = false;
    } else {
        $user_err = [" "," "];
        $err[0] = true;
    }

    if ($email_db){
        $email_err[0] = $style;
        $email_err[1] = "Email already in use.";
        $err[1] = false;
    } else {
        $email_err = [" "," "];
        $err[1] = true;
    }

    if ($password != $confirm_password) {
        $confirm_pass_err[0] = $style;
        $confirm_pass_err[1] = "Password is not match.";
        $err[2] = false;
    } else {
        $confirm_pass_err = [" "," "];
        $err[2] = true;
    }

    $confirm = ($err[0] && $err[1] && $err[2]);
    if (!$confirm) {
        session_destroy();
    } else {
        require('./src/conn.php');
        $user_id = register($conn, $username, $password, $email, $first_name, $last_name, $birthday, $gender, $status);
        $_SESSION['user_id'] = $user_id;
        header("location: ./dashboard.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงชื่อเข้า</title>
    <link rel="stylesheet" href="./styles/register_style.css">
</head>

<body>
    <div class="master">
        <div class="container">
            <div class="login-container">
                <div class="login-infomation">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h1>Register</h1>
                        <div class="fullname">
                            <div class="inputbox" id="full-name">
                                <input id="first-name" class="infomation" type="text" required name="first-name">
                                <label for="">first name</label>
                            </div>
                            <div class="inputbox" id="full-name">
                                <input id="last-name" class="infomation" type="text" required name="last-name">
                                <label for="last-name">last name</label>
                            </div>
                        </div>
                        <div style="<?php if(isset($user_err[0])){ echo $user_err[0];} ?>" class="inputbox">
                            <input id="username" class="infomation" type="text" required name="username">
                            <label for="username">username <span class="err"><?php if(isset($user_err[1])){ echo $user_err[1];} ?></span></label>
                        </div>
                        <div style="<?php if(isset($email_err[0])){ echo $email_err[0];} ?>" class="inputbox">
                            <input  id="email" class="infomation" type="email" required name="email">
                            <label for="email">email <span class="err"><?php if(isset($email_err[1])){ echo $email_err[1];} ?></span></label>
                        </div>
                        <div class="inputbox">
                            <input id="password" class="infomation" type="password" required name="password">
                            <label for="password">password</label>
                        </div>
                        <div style="<?php if(isset($confirm_pass_err[0])){ echo $confirm_pass_err[0];} ?>" class="inputbox">
                            <input id="confirm-password" class="infomation" type="password" required name="confirm-password">
                            <label for="confirm-password">confirm password <span class="err"><?php if(isset($confirm_pass_err[1])){ echo $confirm_pass_err[1];} ?></span></label>
                        </div>
                        <div class="inputbox">
                            <input id="birthday" class="infomation" type="date" required name="birthday" value="<?php echo date('Y-m-d'); ?>">
                            <label for="birthday">Birthday</label>
                        </div>
                        <div class="radio">
                            <label for="gender">Gender:</label>
                            <input type="radio" name="gender" value="male" required>
                            <span class="gender">Male</span>
                            <input type="radio" name="gender" value="female" required>
                            <span class="gender">Female</span>
                        </div>
                        <div class="radio">
                            <label for="married">Status:</label>
                            <input type="radio" name="married" value="umarried" required>
                            <span class="married">Single</span>
                            <input type="radio" name="married" value="married" required>
                            <span class="married">Married</span>
                        </div>
                        <div class="back-img">
                            <input id="submit" class="infomation" type="submit" value="Register" name="register">
                        </div>
                    </form>
                    <div class="back-img" id="register">
                        <a href="./index.php">
                            <button>Login</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
