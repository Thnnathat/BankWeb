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
    <div class="srceen">
        <div class="image">
            <img src="images/undraw_my_password_re_ydq7_1.svg" alt="ไม่โหลด">
        </div>
        <div class="register-container">
            <div class="infometion-conner">
                <div class="title">
                    <h1>
                        Register
                    </h1>
                </div>
                <form action="" method="post">
                    <div class="UaP">
                        <input class="RU" type="text" placeholder="username">
                        <input class="RP" type="text" placeholder="password">
                    </div>
                    <div class="personaldata">
                        <input class="RE" type="text" placeholder="Email">
                        <input class="fname" type="text" placeholder="FistName">
                        <input class="lname" type="text" placeholder="LastName">
                    </div>
                    <div class="bday">
                        Birthday:<input class="BD" type="date">
                    </div>
                    <div class="Gender">
                        <p>Gender:</p>
                        <div class="GenderText">
                            <div>
                                <input class="GM" type="radio" value="male" name="gender">
                                <p>Male</p>
                            </div>
                            <div>
                                <input class="GFM" type="radio" value="female" name="gender">
                                <p>Female</p>
                            </div>
                        </div>
                    </div>
                    <div class="Status-container">
                        <p>Status:</p>
                        <div class="status">
                            <input class="status" type="radio" value="single" name="married">
                            <p>Single</p>
                            <input class="status" type="radio" value="married" name="married">
                            <p>Married</p>
                        </div>
                    </div>
                    <input class="Bottle" type="submit" value="Register">
                </form>
                <a class="login" href="./index.html">
                    <button class="login-btn">
                        Login
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>
