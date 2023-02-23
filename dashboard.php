<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
}

require('./src/dashboard_handlers.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บัญชี</title>
    <link rel="stylesheet" href="./styles/dashboard_style.css">
</head>

<body>
    <nav>
        <div class="nav-container">
            <ul>
                <li><a href="#home" class="transaction-menu">Home</a></li>
                <li><a href="#history" class="history-menu">History</a></li>
                <li><a href="#edit" class="edit">Edit</a></li>
                <li><a href="./dashboard.php?logout='1'" class="logout">Logout</a></li>
                <li class="remove"><a  class="remove-link">Remove</a></li>
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
                        <div class="user" id="user-container"></div>
                    </div>
                    <div class="bottom">
                        <div class="user" id="withdraw-container"></div>
                        <div class="user" id="deposit-container"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="history-container" id="history">
            <div class="infomation-container">
                <div class="infomation-content">
                    <div class="infomation-list">

                    </div>
                </div>
            </div>
        </div>
        <div class="edit-container" id="edit">
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
                                <div class="inputbox">
                                    <input id="username" class="infomation" type="text" required name="username">
                                    <label for="username">username</label>
                                </div>
                                <div class="inputbox">
                                    <input id="email" class="infomation" type="email" required name="email">
                                    <label for="email">email</label>
                                </div>
                                <div class="inputbox">
                                    <input id="password" class="infomation" type="password" required name="password">
                                    <label for="password">password</label>
                                </div>
                                <div class="inputbox">
                                    <input id="confirm-password" class="infomation" type="password" required name="confirm-password">
                                    <label for="confirm-password">confirm password</label>
                                </div>
                                <div class="radio">
                                    <label for="gender">Gender</label>
                                    <input type="radio" name="gender" value="male" required>
                                    <span class="gender">Male</span>
                                    <input type="radio" name="gender" value="female" required>
                                    <span class="gender">Female</span>
                                </div>
                                <div class="radio">
                                    <label for="gender">Status</label>
                                    <input type="radio" name="status" value="unmarried" required>
                                    <span class="gender">Single</span>
                                    <input type="radio" name="status" value="married" required>
                                    <span class="gender">Married</span>
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
        </div>
    </section>
    <footer>

    </footer>
</body>

</html>