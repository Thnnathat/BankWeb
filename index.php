<?php  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/index_style.css">
    <script src="https://kit.fontawesome.com/ef89d40f12.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="master">
        <div class="container">
            <div class="login-container">
                    <div class="login-infomation">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <h1>Login</h1>
                            <div class="inputbox">
                                <!-- <i class="fa-regular fa-user"></i> -->
                                <input id="email" class="infomation" type="text" required name="username">
                                <label for="username">email</label>
                            </div>
                            <div class="inputbox">
                                <!-- <i class="fa-light fa-lock"></i> -->
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
