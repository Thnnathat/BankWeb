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
    <?php
    include("./src/dashboard_handlers.php");
    ?>
    <ul class="navbar">
        <li>
            <a class="nav-menu" id="edit-account" href="./src/edit_account.php">แก้ไขบัญชี</a>
        </li>
        <li>
            <a class="nav-menu" id="logout" href="./index.php">ออกจากระบบ</a>
        </li>
        <li id="list-delete-account">
            <a class="nav-menu" id="delete-account" href="./src/delete_account.php?acc_id=<?php $row['acc_id'] ?>" onclick="<?php echo "return confirm('คุณต้องการลบบัญชี ".$row['username'] . " หรือไม่ " . "')" ?>">ลบบัญชี</a>
        </li>
    </ul>
    <header calss="header">
        <div class="header-container">
            <div class="header-title">
                <h1 class="header-title-text">
                    welcome to the website
                </h1>
            </div>
            <div class="header-image">
                <img class="header-image-tag" src="./images/undraw_vault_re_s4my.svg">
            </div>
        </div>
    </header>
    <section class="section-container">
        <div class="container">
            <div class="above-container">
                <div class="user-container">
                    <div class="user-content-container">
                        <div class="user-picture">
                            <div class="user-image" style="background-image: url('./images/icons/<?php echo $row['img_name'] ?>');"">
                            </div>
                        </div>
                        <div class=" user-detail">
                                <ul class="user-detail-list" style="list-style-type: none;">
                                    <li class="item">
                                        <h4>
                                            ชื่อ
                                        </h4>
                                        <p>
                                            <?php
                                            echo get_name($row['first_name'], $row['last_name'], $row['gender'], $row['birthday'], $row['married']);
                                            ?>
                                        </p>
                                    </li>
                                    <li class="item">
                                        <h4>
                                            เลขบัญชี
                                        </h4>
                                        <p>
                                            <?php
                                            echo $row['acc_id'];
                                            ?>
                                        </p>
                                    </li>
                                    <li class="item" id="balance-container">
                                        <h4>
                                            จำนวนเงินในบัญชี
                                        </h4>
                                        <p id="balance">
                                            <?php
                                            echo $row['balance'];
                                            ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="create-trans-container">
                        <div class="withdraw-container">
                            <div class="withdraw-form-container">
                                <form class="withdraw-form" action="./src/withdraw.php" method="post">
                                    <div class="withdraw-above-container">
                                        <input style="display: none;" type="hidden" value="<?php echo $row['acc_id'] ?>" name="acc_id">
                                        <input style="display: none;" type="hidden" value="<?php echo $user_id ?>" name="user_id">
                                        <input class="withdraw-input" id="withdraw-accid" type="text" placeholder="เลขบัญชี" name="withdraw-acc_id">
                                        <input class="withdraw-input" id="withdraw-amount" type="text" placeholder="จำนวนเงิน" name="withdraw-amount">
                                    </div>
                                    <div class="withdraw-bottom-container">
                                        <textarea class="withdraw-input" id="withdraw-detail-text" style="resize: none;" cols="30" rows="3" name="withdraw-detail" placeholder="รายละเอียด" maxlength="180"></textarea>
                                        <input class="withdraw-input" id="withdraw-btn" type="submit" value="โอนเงิน" name="withdraw-btn">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="deposit-container">
                            <form class="deposit-form" action="./src/deposit.php" method="post">
                                <input style="display: none;" type="hidden" value="<?php echo $row['acc_id'] ?>" name="acc_id">
                                <input style="display: none;" type="hidden" value="<?php echo $user_id ?>" name="user_id">
                                <input class="deposit-input" id="deposit-amount-text" type="text" placeholder="จำนวนเงิน" name="deposit-amount">
                                <textarea class="deposit-input" id="deposit-detail-text" style="resize: none;" cols="3" rows="3" type="text" placeholder="รายละเอียด" name="deposit-detail" maxlength="180"></textarea>
                                <input class="deposit-input" id="deposit-btn" type="submit" value="ฝากเงิน" name="deposit-btn">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bottom-container">
                    <div class="trans-container">
                        <div class="trans-detail-container">
                            <!-- <div class="search-container">
                                <form class="search-form" method="get" action="./">
                                    <input class="search-input" id="search-text" type="text" name="search-text" placeholder="ค้นหา">
                                    <input class="search-input" id="search-btn" type="submit" value="ค้นหา" name="search-btn">
                                </form>
                            </div> -->
                            <div class="trans-history-container">
                                <div class="trans-history-header">
                                    <ul class="trans-header-list" style="list-style-type: none;">
                                        <li class="header-item">เวลา</li>
                                        <li class="header-item">รายละเอียด</li>
                                        <li class="header-item">จำนวนเงิน</li>
                                    </ul>
                                </div>
                                <div class="trans-history-content">
                                    <table id="table">
                                        <?php
                                        $acc_id = $row['acc_id'];
                                        include('./src/transaction.php');
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</body>

</html>