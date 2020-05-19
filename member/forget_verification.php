<?php session_start();
require_once('../Connections/connSQL.php'); ?>
<!DOCTYPE html>
<html ng-app="app" lang="zh-TW">
<!--找回密碼頁面part2，需填入驗證碼，驗證碼需在過期時間(1hr)內完成-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAX GEAR瑪斯佶註冊會員</title>
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <?php
    $miss_passwd_code_err = '';
    /*欄位驗證*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["miss_passwd_code"]))) {
            $miss_passwd_code_err = "請輸入驗證碼.";
        } else {
            /*查詢*/
            $sql = "SELECT miss_passwd_code,miss_passwd_code_expire FROM member_maxgear WHERE email = :email";
            if ($stmt = $pdo->prepare($sql)) {
                $email = $_SESSION["email"];
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $member = $stmt->fetch();
                $miss_passwd_code = $_POST['miss_passwd_code'];
                if ($member['miss_passwd_code'] != $miss_passwd_code) {
                    $miss_passwd_code_err  = '驗證碼錯誤!';
                } else if (strtotime(date('Y-m-d H:i:s')) > strtotime($member["miss_passwd_code_expire"])) {
                    $miss_passwd_code_err  = '驗證碼已過期。';
                } else {
                    echo "驗證成功";
                    header("location:change_password.php");
                }
            }
            unset($stmt);
        }
        unset($pdo);
    }
    ?>
</head>




<body>
    <div class="MG-member-background MG-email-background"></div>
    <div>
        <div class="MG-header-space"></div>
        <div class="MG-email-box">
            <div class="MG-email-box-top">
                <p class="MG-add-finish-title">帳戶驗證</p>
                <div class="MG-email-box-content">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($miss_passwd_code_err)) ? '錯誤' : '1'; ?>">
                            <label>請在下方填入驗證碼</label>
                            <input type="text" name="miss_passwd_code" class="form-control" value="<?php $miss_passwd_code ?>" placeholder="驗證碼為4位數">
                            <span><?php echo $miss_passwd_code_err ?></span>
                        </div>
                        <input type="submit" class="MG-forget-verification-btn-type MG-email-check-btn-1 btn btn-info" value="確定">
                        <a class="MG-email-check-btn-2 btn btn-outline-info" target="_blank" href="resend_miss_passwd_code.php">再次發送</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer"></div>
</body>
<!--
    表單參考資料
    https://icodding.blogspot.com/2015/09/php_92.html?m=1
-->