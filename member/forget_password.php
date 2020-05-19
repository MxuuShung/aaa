<?php session_start();
header("Cache-control:private");
?>
<?php
require_once('../Connections/connSQL.php');
require_once("../src/PHPMailer.php");
require_once("../src/SMTP.php");
require_once("../src/Exception.php");
?>
<!DOCTYPE html>
<html ng-app="app" lang="zh-TW">
<!--找回密碼頁面part1，需填入信箱，並且必須先通過信箱連結驗證成功-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAX GEAR瑪斯佶_尋回密碼頁</title>
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <?php
    /*定義變數*/
    $param_miss_passwd_code = $miss_passwd_code = $email = $email_err = '';
    $param_miss_passwd_code_expire = $miss_passwd_code_expire = $param_email ='';
    /*欄位驗證，接收到格式為post時*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["email"]))) {
            $email_err = "";
        } else {
            /*MYSQL 查詢    email,會員等級 從    表單            條件 email欄位=輸入的email值時 */
            $sql = "SELECT email,verification FROM member_maxgear WHERE email = :email";
            /*pdo預備語法*/
            if ($stmt = $pdo->prepare($sql)) {
                $param_email = trim($_POST["email"]);
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $_SESSION['verification'] = $row["verification"];
                            if ($_SESSION['verification'] != 1) {
                                $email_err = "請先至信箱開通會員";
                            } else {
                                $_SESSION["email"] = trim($_POST["email"]);
                            }
                        }
                    } else {
                        $email_err = "查無此帳號";
                        $_SESSION['verification']=0;
                    }
                } else {
                    echo "資料庫連線失敗";
                }
            }
        }
                //修改                     驗證碼                               驗證時間
        $sql2 = "UPDATE member_maxgear SET miss_passwd_code=:miss_passwd_code ,miss_passwd_code_expire=:miss_passwd_code_expire WHERE email=:email";
        $miss_passwd_code = rand(1000, 9999);
        $miss_passwd_code_expire = date('Y-m-d H:i:s', strtotime('+1 hours'));
        $email = $_SESSION["email"];
        if ($_SESSION['verification'] == 1 && $stmt = $pdo->prepare($sql2)) {
            //參數
            $param_email =  $email;
            $param_miss_passwd_code = $miss_passwd_code;
            $param_miss_passwd_code_expire = $miss_passwd_code_expire;
            //預備語句
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":miss_passwd_code", $param_miss_passwd_code, PDO::PARAM_INT);
            $stmt->bindParam(":miss_passwd_code_expire", $param_miss_passwd_code_expire, PDO::PARAM_STR);
            $stmt->execute();

            // ================================== 開始寄信 ==================================
            $mail = new PHPMailer\PHPMailer\PHPMailer(); //匯入PHPMailer類別
            $mail->IsSMTP();
            $mail->SMTPAuth = true; // turn on SMTP authentication
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->CharSet = "utf-8";

            $mail->Username = "todaytime0311@gmail.com";
            $mail->Password = "today0311";
            $mail->FromName = "找回密碼";
            $webmaster_email = "todaytime0311@gmail.com";
            //$_SESSION["email"] 註冊用戶的信箱
            $email = $_SESSION["email"];
            $name = "1";
            $mail->From = $webmaster_email;

            $mail->AddAddress($email, $name);
            $mail->AddReplyTo($webmaster_email, "Squall.f");

            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            $mail->Subject = "信件標題";
            $mail->Body = <<< HTML
<h5>此為MAXGEAR瑪斯佶科技公司寄出的驗證信</h5><br>
<p>{$email}用戶您好，我們寄出此信件協助您找回密碼，請點擊下方驗證碼以找回密碼</p>
<p>驗證碼為{$miss_passwd_code}</p>
<p>驗證碼將在{$miss_passwd_code_expire}後過期，請注意!</p>
HTML;

            if (!$mail->Send()) {
                echo "發送信件時發生錯誤，請確定email是否正確";
                //如果有錯誤會印出原因
            } else {
                header("location:forget_verification.php");
            }
        }
        // ================================== 寄信結束 ==================================
        unset($stmt);
    }
    ?>
</head>

<body>
    <div class="MG-member-background MG-email-background"></div>
    <div>
        <div class="MG-header-space"></div>
        <div class="MG-email-box">
            <div class="MG-email-box-top">
                <p class="MG-add-finish-title">請輸入註冊信箱用以找回密碼!</p>
                <div class="MG-email-box-content">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($email_err)) ? '請填入信箱' : ''; ?>">
                            <h6>請填入註冊信箱</h6>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="請輸入信箱">
                            <span><?php echo $email_err; ?></span>
                        </div>
                        <a class="MG-change-password-check-btn-2 btn  btn-outline-info" href="../index.php">取消</a>
                        <input type="submit" class="MG-email-check-btn-1 btn btn-info" value="確定">
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="footer"></div>
    </div>
</body>
<!--
    表單參考資料
    https://icodding.blogspot.com/2015/09/php_92.html?m=1
-->