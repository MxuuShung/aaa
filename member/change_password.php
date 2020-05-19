<?php session_start();
header("Cache-control:private");
?>
<?php require_once('../Connections/connSQL.php'); ?>
<!DOCTYPE html>
<html ng-app="app" lang="zh-TW">
<!--    找回密碼頁面part3，更改密碼頁面，成功後跳轉至登入頁    -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAX GEAR瑪斯佶註冊會員</title>
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <?php

    /*定義變數*/
    $email = $_SESSION['email'];
    $password = $password_err='';
    /*欄位驗證，接收到格式為post時*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["password"]))) {
            //密碼為空提示語
            $password_err = "密碼.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "密碼字數需大於6個字";
        } else {
            $password = trim($_POST["password"]);
            $sql = "UPDATE member_maxgear SET password=:password WHERE email=:email";
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                if ($stmt->execute());
            }
            unset($stmt);
        }
        header("location:login.php");
    }
    ?>
</head>
<body>
    <div class="MG-member-background MG-email-background"></div>
    <div>
        <div class="MG-header-space"></div>
        <div class="MG-email-box">
            <div class="MG-email-box-top">
                <p class="MG-add-finish-title">請填入新密碼!</p>
                <div class="MG-email-box-content">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($password_err)) ? '請填入密碼' : ''; ?>">
                            <p>請填入新密碼</p>
                            <input type="text" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="請填入新密碼">
                            <span><?php echo $password_err; ?></span>
                        </div>
                        <a class="MG-change-password-check-btn-2 btn btn-outline-info" href="index.php">取消</a>
                        <input type="submit" class="MG-email-check-btn-1 btn btn-info" value="確定">
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