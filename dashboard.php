<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    unset($row);
}

require('./src/dashboard_handlers.php');

if (isset($row)) {
    //basic user.
    $picture_path = $row['img_name'];
    if ($picture_path !== 'person-svgrepo-com.png') {
        $picture_path = $row['img_id'] . $row['img_name'];
    }

    $username = $row['username'];
    $_SESSION['acc_id'] = $account_id = $row['acc_id'];
    $balance = $row['balance'];
    $email = $row['email'];
    $img_id = $row['img_id'];
    $img_name = $row['img_name'];

    //full name.
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $gender = $row['gender'];
    $birthday = $row['birthday'];
    $married = $row['married'];
    $fullname = get_name($first_name, $last_name, $gender, $birthday, $married);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['save'] == 'Save') {

        require("./src/register.php");
        require('./src/conn.php');
        $username_db = get_username($conn, $_POST['edit-username']);

        require('./src/conn.php');
        $email_db = get_email($conn, $_POST["edit-email"]);

        $style = "border-color: red;";
        $confirm = [true, true, true];

        //เมื่อมีความต้องการเปลี่ยนรหัส (มีการป้อนรหัสใหม่มา)
        if (empty($_POST['new-password'])) {
            $confirm[0] = true;
            $confirm_pass_err[0] = "";
            $confirm_pass_err[1] = "";
        } else {
            if ($row['password'] != $_POST['new-password']) {
                if ($_POST['new-password'] == $_POST['confirm-password']) {
                    $new_password = $_POST['new-password'];
                    try {
                        require('./src/conn.php');
                        $sql = "UPDATE users SET password = '$new_password' WHERE user_id = '{$row['user_id']}'";
                        $conn->query($sql);
                        $conn->close();
                    } catch (Exception $e) {
                        $conn->close();
                    }
                    $confirm[0] = true;
                    $confirm_pass_err[0] = "";
                    $confirm_pass_err[1] = "";
                } else {
                    $confirm[0] = false;
                    $confirm_pass_err[0] = $style;
                    $confirm_pass_err[1] = "Password is not match.";
                }
            }
        }

        //เมื่อมีความต้องการเปลี่ยนชื่อผู้ใช้ (ไม่ใช่ชื่อเดิม)
        if ($row['username'] != $_POST['edit-username'] && !empty($_POST['edit-username'])) {
            if ($username_db) {
                $confirm[1] = false;
                $user_err[0] = $style;
                $user_err[1] = "Username already in use.";
            } else {
                try {
                    require('./src/conn.php');
                    $sql = "UPDATE users SET username = '{$_POST["edit-username"]}' WHERE user_id = '{$row['user_id']}' ";
                    $conn->query($sql);
                    $conn->close();
                } catch (Exception $e) {
                    $conn->close();
                }
                $confirm[1] = true;
                $user_err[0] = "";
                $user_err[1] = "";
            }
        }

        //เมื่อมีความต้องการเปลี่ยนอีเมล (ไม่ใช่อีเมลเดิม)
        if ($row['email'] != $_POST['edit-email'] && !empty($_POST['edit-email'])) {
            if ($email_db) {
                $confirm[2] = false;
                $email_err[0] = $style;
                $email_err[1] = "Email already in use.";
            } else {
                try {
                    require('./src/conn.php');
                    $sql = "UPDATE users SET email = '{$_POST["edit-email"]}' WHERE user_id = '{$row['user_id']}' ";
                    $conn->query($sql);
                    $conn->close();
                } catch (Exception $e) {
                    $conn->close();
                }
                $confirm[2] = true;
                $email_err[0] = "";
                $email_err[1] = "";
            }
        }

        $confirm = ($confirm[0] && $confirm[1] && $confirm[2]);
        if ($confirm) {
            //ถ้าข้อมูลถูกแก้ไขเรียบร้อบ จะ reload page เพื้อให้การแสดงผลของข้อมูลเปลียนตาม.
            header("location: ./dashboard.php");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="./styles/dashboard_style.css">
    <script src="./scripts/dashboard_js.js"></script>
</head>

<body>
    <nav>
        <div class="nav-container">
            <ul>
                <li><a href="#home" class="transaction-menu">Home</a></li>
                <li><a href="#history" class="history-menu">History</a></li>
                <li><a href="#edit" class="edit">Edit</a></li>
                <li><a href="./dashboard.php?logout='1'" class="logout" onclick="<?php echo "return logout()"; ?>">Logout</a></li>
                <li class="remove"><a class="remove-link" href="./src/delete_account.php" onclick="<?php if (isset($fullname)) {
                                                                                                        echo "return confirm('Do you want to remove " . $username . " account?')";
                                                                                                    } ?>">Remove</a></li>
            </ul>
        </div>
    </nav>
    <div class="set-nav">

    </div>
    <section>
        <div class="transaction-container" id="home">
            <div class="detail-container">
                <div class="detail">
                    <div class="above">
                        <div class="user" id="user-container">
                            <div class="basic-user">
                                <div style="background-image: url('./server/images/<?php if (isset($picture_path)) {
                                                                                        echo $picture_path;
                                                                                    } ?>'); " class="user-image">
                                    <div class="img-upload-container">
                                        <form id="form" action="./src/profile_img.php" method="post" enctype="multipart/form-data">
                                            <label for="profile-upload"></label>
                                            <input type="file" name="profile-upload" id="profile-img" class="profile-upload-box" accept="image/png, image/jpeg, image/jpg" onchange="form.submit();">
                                            <input style="display: none;" type="hidden" name="img_id" value="<?php if (isset($img_id)) {
                                                                                                                    echo $img_id;
                                                                                                                } ?>">
                                            <input style="display: none;" type="hidden" name="img_name" value="<?php if (isset($img_name)) {
                                                                                                                    echo $img_name;
                                                                                                                } ?>">
                                        </form>
                                    </div>
                                </div>
                                <div class="user-content">
                                    <div>
                                        <h1>username</h1>
                                        <h3 class="username-title">
                                            <?php if (isset($username)) {
                                                echo $username;
                                            } ?>
                                        </h3>
                                    </div>
                                    <div>
                                        <h1>Email</h1>
                                        <h3 class="email-title">
                                            <?php if (isset($email)) {
                                                echo $email;
                                            } ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="user-detail">
                                <div class="horizon-user-detail">
                                    <div class="fullname">
                                        <h1>Name</h1>
                                        <h3><?php if (isset($fullname)) {
                                                echo $fullname;
                                            } ?></h3>
                                    </div>
                                    <div class="account-id">
                                        <h1>Account No.</h1>
                                        <h3><?php if (isset($account_id)) {
                                                echo $account_id;
                                            } ?></h3>
                                    </div>
                                </div>
                                <div class="balance-detail">
                                    <div class="balance">
                                        <h1 class="balance-title">Balance</h1>
                                        <h1 class="balance-text"><?php if (isset($balance)) {
                                                                        echo number_format($balance, 2, '.', ',');
                                                                    } ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="user" id="withdraw-container">
                            <div class="withdraw-form-container">
                                <p class="transfer-title">Transfer</p>
                                <form class="withdraw-form" action="./src/withdraw.php" method="post">
                                    <input style="display: none;" type="hidden" name="acc_id" value="<?php if (isset($account_id)) { echo $account_id;} ?>">
                                    <input class="withdraw-input" type="text" placeholder="Amount" name="withdraw-amount">
                                    <input class="withdraw-input" type="text" placeholder="Account number" name="withdraw-acc_id">
                                    <textarea class="withdraw-input" type="text" placeholder="Detail" name="detail"></textarea>
                                    <input class="withdraw-input" id="withdraw-btn" type="submit" value="Transfer" name="tranfer" onclick="<?php echo"return withdraw_check()"; ?>">
                                </form>
                            </div>
                        </div>
                        <div class="user" id="deposit-container">
                            <div class="deposit-form-container">
                                <p class="deposit-title">Deposit</p>
                                <form class="deposit-form" action="./src/deposit.php" method="post">
                                    <input style="display: none;" type="hidden" name="acc_id" value="<?php if (isset($account_id)) {
                                                                                                            echo $account_id;
                                                                                                        } ?>">
                                    <input class="deposit-input" type="text" placeholder="Amount" name="deposit-amount">
                                    <textarea class="deposit-input" placeholder="Detail" name="detail" cols="30" rows="3" maxlength="100"></textarea>
                                    <input class="deposit-input" id="deposit-btn" type="submit" name="submit" value="Deposit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="history-container" id="history">
            <div class="infomation-container">
                <div class="infomation-content">
                    <div class="infomation-list">
                        <h1 class="transaction-title">
                            Transactions
                        </h1>
                        <form>
                            <input class="search-box" type="text" size="30" onkeyup="showResult(this.value)" placeholder="Search">
                            <div id="livesearch"></div>
                        </form>
                        <div class="detail-title">
                            <h1>Date Time</h1>
                            <h1>Detail</h1>
                            <h1>Amount</h1>
                        </div>
                        <div id="table-container">
                            <script>
                                showResult("");
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="edit-container" id="edit">
            <div class="master">
                <div class="container">
                    <div class="login-container">
                        <div class="login-infomation">
                            <form class="edit-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "#edit"); ?>" method="post">
                                <h1 class="edit-title">Edit Account</h1>
                                <div style="<?php if (isset($user_err[0])) {
                                                echo $user_err[0];
                                            } ?>" class="inputbox">
                                    <input id="username" class="infomation" type="text" name="edit-username" value="<?php if (isset($username)) {
                                                                                                                        echo $username;
                                                                                                                    } ?>">
                                    <label for="edit-username">username <span class="err"><?php if (isset($user_err[1])) {
                                                                                                echo $user_err[1];
                                                                                            } ?></span></label>
                                </div>
                                <div style="<?php if (isset($email_err[0])) {
                                                echo $email_err[0];
                                            } ?>" class="inputbox">
                                    <input id="email" class="infomation" type="email" name="edit-email" value="<?php if (isset($email)) {
                                                                                                                    echo $email;
                                                                                                                } ?>">
                                    <label for="edit-email">email <span class="err"><?php if (isset($email_err[1])) {
                                                                                        echo $email_err[1];
                                                                                    } ?></span></label>
                                </div>
                                <div class="inputbox">
                                    <input id="password" class="infomation" type="password" name="new-password">
                                    <label for="new-password">password</label>
                                </div>
                                <div style="<?php if (isset($confirm_pass_err[0])) {
                                                echo $confirm_pass_err[0];
                                            } ?>" class="inputbox">
                                    <input id="confirm-password" class="infomation" type="password" name="confirm-password">
                                    <label for="confirm-password">confirm password <span class="err"><?php if (isset($confirm_pass_err[1])) {
                                                                                                            echo $confirm_pass_err[1];
                                                                                                        } ?><?php if (isset($message_pass_error)) {
                                                                                                                echo $message_pass_error;
                                                                                                            } ?></span></label>
                                </div>
                                <div class="back-img">
                                    <input id="submit" class="infomation" type="submit" value="Save" name="save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>

    </footer>
</body>

</html>