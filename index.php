<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/main_style.css">
    <link rel="stylesheet" href="./styles/index_style.css">
</head>

<body>
    <div class="master">
        <div class="container">
            <div class="login-container">
                <div class="login-content">
                    <div class="title">
                        <h1 class="head">Welcome to</h1>
                        <h1 class="head">the website</h1>
                    </div>
                    <div class="login-infomation">
                        <form action="./src/login.php" method="post">
                            <input id="email" class="infomation" type="text" placeholder="username" required
                                name="username"><br>
                            <input id="password" class="infomation" type="password" placeholder="password" required
                                name="password"><br>
                            <input id="submit" class="infomation" type="submit" value="Login">
                        </form>
                        <a class="register" href="./register.html">
                            <button class="register-btn">
                                Register
                            </button>
                        </a>
                    </div>
                </div>
                <div class="picture">
                    <img class="image" src="./images/undraw_digital_currency_qpak.svg" width="400px" height="400px">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
