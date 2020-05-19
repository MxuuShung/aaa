<?php
session_start();
require_once('../Connections/connSQL.php');
?>
<!----------------------註冊會員-------------------------->
<!DOCTYPE html>
<html ng-app="app" lang="zh-TW">

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
    $email = $email_err = '';
    /*欄位驗證，接收到格式為post時*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["email"]))) {
            $email_err = "請填入信箱";
        } else {
            /*MYSQL 查詢    email 從    表單            條件 email欄位=輸入的email值時 */
            $sql = "SELECT email FROM member_maxgear WHERE email = :email";
            /*pdo預備語法*/
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $param_email = trim($_POST["email"]);
                if ($stmt->execute()) {
                    /*同一信箱是否重複申請*/
                    if ($stmt->rowCount() == 1) {
                        $email_err = "此信箱已註冊過.";
                    } else {
                        $_SESSION['email'] = trim($_POST["email"]);
                    }
                } else {
                    echo "有問題! 請稍後在試.";
                }
            }
            unset($stmt);
        }
    }
    /* 使用正則表達式 檢查輸入的電子郵件格式*/
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $email_err = "請填寫有效的 email 格式!";
        } else {
            header("location:add.php");
        }
    }
    ?>
</head>

<body>
    <div class="container-fluid text-bg">
        <div class="row MG-row MG-color justify-content-center ">
            <div class="align-self-center MG-add-email-box">
                <div class="MG-add-email-box-padding mt-3">
                    <h1>建立帳戶</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="MG-add-email-box-padding mt-5">
                        <div class="form-group MG-add-email-form-body">
                            <input type="text" name="email" class="MG-add-email-form-body-input" value="<?php echo $email; ?>" placeholder="請輸入信箱">
                            <span><?php echo $email_err; ?></span>
                        </div>
                    </div>
                    <div class="row MG-row justify-content-between mt-5 mb-3">
                        <div class="MG-add-email-form-body-p">
                            <p>或者<a href="../index.html">登入帳號</a></p>
                        </div>
                        <div class="MG-add-email-form-body-btn">
                            <input type="submit" value="確     定">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!--
    表單參考資料
    https://icodding.blogspot.com/2015/09/php_92.html?m=1
-->