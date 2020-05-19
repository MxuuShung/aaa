<?php
session_start();
require_once('../Connections/connSQL.php');
?>
<?php 
$email = $password = "";
$email_err = $password_err = $verification = "";
//驗證帳密
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //判斷帳號
    if (empty(trim($_POST["email"]))) {
        $email_err = "請輸入信箱.";
    } else {
        $email = trim($_POST["email"]);
    }
    // 判斷密碼
    if (empty(trim($_POST["password"]))) {
        $password_err = "請輸入密碼.";
    } else {
        $password = trim($_POST["password"]);
    }

    // 取得帳密欄位，並與資料庫資料驗證
    if (empty($email_err) && empty($password_err)) {
        // mysql查詢語句
        //某變數= 查詢   id        帳號     密碼    從      這個資料表  條件   當表內欄位與輸入的帳號相等時
        $sql = "SELECT member_id, first_name, email, password,verification FROM member_maxgear WHERE email = :email";

        //pdo連接資料庫語法
        if ($stmt = $pdo->prepare($sql)) {
            //pdo預備語句                               輸入格式:String          
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            //輸入值     =  用戶輸入的帳號
            $param_email = trim($_POST["email"]);
            // 執行pdo預備語句
            if ($stmt->execute()) {
                // 確認用戶帳號是否存在，是，則驗證密碼
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        //取得資料庫資料並儲存
                        $id = $row["member_id"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
                        $verification = $row["verification"];
                        $first_name = $row["first_name"];
                        //密碼是否正確
                        if (password_verify($password, $hashed_password)) {
                            // 將客戶資料輸入到session保存，作為判斷依據
                            $_SESSION["loggedin"] = true;
                            $_SESSION["member_id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["verification"] = $verification;
                            $_SESSION["first_name"] = $first_name;
                            // 導向login_verification.php去判斷導向哪裡
                            header("location: login_verification.php");
                        } else {
                            // 密碼錯，提示語
                            $password_err = "密碼錯誤.";
                        }
                    }
                } else {
                    // 用戶名不存在，提示語
                    $email_err = "帳號錯誤.";
                }
            } else {
                //錯誤
                echo "系統異常錯誤，請後重新嘗試.";
            }
        }
        unset($stmt);
    }
    unset($pdo);
}
?>



<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXGEAR-會員登入</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/solid.min.css" rel="stylesheet" type="text/css">
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-3.4.1.min.js"></script>
</head>


<body>
    <div class="container-fluid  MG-login-background">
        <div class="row MG-row">
            <div class="align-self-center MG-login-box">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <!--內容1-form表單，-->
                    <!--form-title-->
                    <div class="mt-3 MG-login-form-title">
                        <!--left 登入-->
                        <div class="MG-login-form-title-left">
                            <h1>登入</h1>
                            <p>您是新的使用者嗎？<a class="MG-login-a" href="add_email.php">新建帳戶</a></p>
                        </div>
                        <!--right logo-->
                        <div class="MG-login-form-title-right">
                            <img src="../image/member/MAXGEAR_LOGO.svg" alt="" srcset="">
                        </div>
                    </div>
                    <!--form body-->
                    <div class="mt-3 MG-login-form-body">
                        <div class="input-group">
                            <label for="name">帳號：</label>
                            <input class="MG-login-form-body-account" type="text" name="email" value="<?php echo $email; ?>">
                            <span class="mt-3 help-block MG-help-block"><?php echo $email_err; ?></span>
                        </div>
                        <div class="mt-3 input-group" id="show_hide_password">
                            <label for="password" name="密碼">密碼：</label>
                            <input class="MG-login-form-body-password" type="text" name="password" value="">
                            <span class="mt-3 help-block MG-help-block"><?php echo $password_err; ?></span>
                            <div class="form-group MG-login-form-body-eye">
                                <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="mt-3 MG-login-form-body-remember">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember-me">記住帳號密碼</label>
                        </div>
                        <div class="mt-4 input-group MG-login-form-body-btn">
                            <button type="submit" action=""><span></span><span></span><span>登</span><span></span>入<span></span><span></span></button>
                            <a class="MG-login-a" href="forget_password.php">忘記密碼</a>
                        </div>
                    </div>
                </form>
                <!--內容2-其他-->
                <div class="mt-4">
                    <!--或  -  FB圖 google圖-->
                    <div class="MG-login-other">
                        <div class="MG-login-other-font">
                            <span>或</span>
                        </div>
                        <div class="MG-login-other-dash align-self-center">
                            <hr />
                        </div>
                        <div class="MG-login-other-logo">
                            <a href="#"><img class="MG-login-other-logo-img" src="../image/member/Google_Logo.svg"></a>
                        </div>
                        <div class="MG-login-other-logo">
                            <a href="#"><img class="MG-login-other-logo-img" src="../image/member/Facebook_Logo.svg"></a>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <p>受 Google <a class="MG-login-a" href="">隱私權政策</a>和<a class="MG-login-a" href="">服務條款</a>的規範</p>
                </div>
            </div>
        </div>
    </div>

    <!--密碼顯示/隱藏 切換-->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr('type') == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr('type') == 'password') {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
    </script>
</body>

</html>