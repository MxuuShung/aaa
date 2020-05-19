<?php
session_start();
require_once("../src/PHPMailer.php"); // @TODO 引入phpMailer
require_once("../src/SMTP.php");
require_once("../src/Exception.php");
require_once('../Connections/connSQL.php');
?>

<!--寄送 密碼遺失驗證碼的頁面，每天上限4封-->
<head>
    <meta charset="UTF-8">
    <title>帳戶驗證</title>
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<?php
?>
<?php
if (isset($_SESSION['verification'])) {
    echo "權限:" . $_SESSION['verification'] . "<br/>";
} else {
    echo "權限:0" . "<br/>";
}
if (isset($_SESSION['email'])) {
    echo "信箱:" . $_SESSION['email'] . "<br/>";
} else {
    echo "尚未取得信箱" . "<br/>";
}
if (isset($_SESSION['loggedin'])) {
    echo "登入狀態:" . $_SESSION['loggedin'] . "<br/>";
} else {
    echo "登入狀態:否" . "<br/>";
}
if (isset($_SESSION["member_id"])) {
    echo "ID:" . $_SESSION["member_id"] . "<br/>";
} else {
    echo "ID:尚未取得" . "<br/>";
}
?>

<body>
    <?php
    if (!isset($_SESSION['email'])) {
        $_SESSION['email'] = '';
    }
    if (!isset($_SESSION["verification"])) {
        $_SESSION["verification"] = '';
    }
    ?>
    <?php
    if (@$_SESSION['send_mail'] == 3) {
        $_SESSION['send_mail']++;
        //尚未驗證
        if ($_SESSION["verification"] == 1) {
            //MYSQL 修改    表單                驗證碼          輸入的驗證碼    驗證時間                輸入的驗證時間          當  email欄位 相等於 輸入的email值時
            $sql = "UPDATE member_maxgear SET miss_passwd_code = :miss_passwd_code, miss_passwd_code_expire = :miss_passwd_code_expire WHERE email = :email ";
            $stmt = $pdo->prepare($sql);

            $miss_passwd_code = rand(1000, 9999); //rand範圍0-32767
            //將當下時間+1個小時存入MYSQL，故需一小時內驗證
            $miss_passwd_code_expire = date('Y-m-d H:i:s', strtotime('+1 hours'));
            $email = $_SESSION['email'];
            $stmt->bindParam(":miss_passwd_code", $miss_passwd_code, PDO::PARAM_STR);
            $stmt->bindParam(":miss_passwd_code_expire", $miss_passwd_code_expire, PDO::PARAM_STMT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if ($stmt->execute()) {
                // ================================== 開始寄信 ==================================
                $mail = new PHPMailer\PHPMailer\PHPMailer(); //匯入PHPMailer類別
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->CharSet = "utf-8";

                $mail->Username = "todaytime0311@gmail.com";
                $mail->Password = "today0311";
                $mail->FromName = "驗證信";
                $webmaster_email = "todaytime0311@gmail.com";
                //$_SESSION["email"]
                $email = $_SESSION['email'];
                $name = "1";
                $mail->From = $webmaster_email;

                $mail->AddAddress($email, $name);
                $mail->AddReplyTo($webmaster_email, "Squall.f");

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->Subject = "信件標題";
                $mail->Body = <<< HTML
    <h5>此為MAXGEAR瑪斯佶科技公司再次發送的密碼遺失驗證信</h5><br>
    <p>這是您的驗證碼:{$miss_passwd_code}</p>
    <p>請於1小時內輸入驗證碼，過期即失效... </p>
    <p>一天內最多發送4封密碼遺失驗證信</p>
    <P>失效時間為{$miss_passwd_code_expire}</P>
    HTML;

                if (!$mail->Send()) {
                    $send_mail_err =  "發送信件時發生錯誤，請確定email是否正確";
                }
                // ================================== 寄信結束 ==================================
            } else {
                echo "mysql存入資料時錯誤";
            }
            unset($stmt);
            unset($pdo);
        }
    } else if (@$_SESSION['send_mail'] == 2) {
        $_SESSION['send_mail']++;
        if ($_SESSION["verification"] == 1) {
            $sql = "UPDATE member_maxgear SET miss_passwd_code = :miss_passwd_code, miss_passwd_code_expire = :miss_passwd_code_expire WHERE email = :email ";
            $stmt = $pdo->prepare($sql);

            $miss_passwd_code = rand(1000, 9999); //rand範圍0-32767
            $miss_passwd_code_expire = date('Y-m-d H:i:s', strtotime('+1 hours'));
            $email = $_SESSION['email'];
            $stmt->bindParam(":miss_passwd_code", $miss_passwd_code, PDO::PARAM_STR);
            $stmt->bindParam(":miss_passwd_code_expire", $miss_passwd_code_expire, PDO::PARAM_STMT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if ($stmt->execute()) {
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
                $mail->FromName = "驗證信";
                $webmaster_email = "todaytime0311@gmail.com";
                //$_SESSION["email"]
                $email = $_SESSION['email'];
                $name = "1";
                $mail->From = $webmaster_email;

                $mail->AddAddress($email, $name);
                $mail->AddReplyTo($webmaster_email, "Squall.f");

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->Subject = "信件標題";
                $mail->Body = <<< HTML
    <h5>此為MAXGEAR瑪斯佶科技公司再次發送的密碼遺失驗證信</h5><br>
    <p>這是您的驗證碼:{$miss_passwd_code}</p>
    <p>請於1小時內輸入驗證碼，過期即失效... </p>
    <p>一天內最多發送4封密碼遺失驗證信</p>
    <P>失效時間為{$miss_passwd_code_expire}</P>
    HTML;

                if (!$mail->Send()) {
                    $send_mail_err =  "發送信件時發生錯誤，請確定email是否正確";
                }
                // ================================== 寄信結束 ==================================
            } else {
                echo "mysql存入資料時錯誤";
            }
            unset($stmt);
            unset($pdo);
        }
    } else if (@$_SESSION['send_mail'] == 1) {
        //抓取今天結束時間，從第一封信開始的晚上23:59
        $_SESSION['today_end'] = strtotime(date("Y-m-d H:i:s", mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1));
        $_SESSION['send_mail']++;

        if (@$_SESSION["verification"] == 1) {
            $sql = "UPDATE member_maxgear SET miss_passwd_code = :miss_passwd_code, miss_passwd_code_expire = :miss_passwd_code_expire WHERE email = :email ";
            $stmt = $pdo->prepare($sql);

            $miss_passwd_code = rand(1000, 9999); //rand範圍0-32767
            $miss_passwd_code_expire = date('Y-m-d H:i:s', strtotime('+1 hours'));
            $email = $_SESSION['email'];
            $stmt->bindParam(":miss_passwd_code", $miss_passwd_code, PDO::PARAM_STR);
            $stmt->bindParam(":miss_passwd_code_expire", $miss_passwd_code_expire, PDO::PARAM_STMT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if ($stmt->execute()) {
                // ================================== 開始寄信 ==================================
                $mail = new PHPMailer\PHPMailer\PHPMailer(); //匯入PHPMailer類別
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->CharSet = "utf-8";

                $mail->Username = "todaytime0311@gmail.com";
                $mail->Password = "today0311";
                $mail->FromName = "驗證信";
                $webmaster_email = "todaytime0311@gmail.com";
                //$_SESSION["email"]
                $email = $_SESSION['email'];
                $name = "1";
                $mail->From = $webmaster_email;

                $mail->AddAddress($email, $name);
                $mail->AddReplyTo($webmaster_email, "Squall.f");

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->Subject = "信件標題";
                $mail->Body = <<< HTML
    <h5>此為MAXGEAR瑪斯佶科技公司再次發送的密碼遺失驗證信</h5><br>
    <p>這是您的驗證碼:{$miss_passwd_code}</p>
    <p>請於1小時內輸入驗證碼，過期即失效... </p>
    <p>一天內最多發送4封密碼遺失驗證信</p>
    <P>失效時間為{$miss_passwd_code_expire}</P>
    HTML;

                if (!$mail->Send()) {
                    $send_mail_err =  "發送信件時發生錯誤，請確定email是否正確";
                }
                // ================================== 寄信結束 ==================================
            } else {
                echo "mysql存入資料時錯誤";
            }
            unset($stmt);
            unset($pdo);
        }
        //當寄信數量超過三封時
    } else if (@$_SESSION['send_mail'] > 3) {
        //將現在時間存到SESSION['now_time']
        $_SESSION['now_time'] = strtotime(date('Y-m-d H:i:s'));
        //如果現在時間超過了162行所抓取的今天結束時間時，歸零今天結束時間與現在時間，信封數改為1，下次同樣帳戶進來時，會從175行開始
        if ($_SESSION['now_time'] > $_SESSION['today_end']) {
            $_SESSION['send_mail'] = 1;
            $_SESSION['today_end'] = 0;
            $_SESSION['now_time'] = 0;
            if ($_SESSION["verification"] == 1) {
                $sql = "UPDATE member_maxgear SET miss_passwd_code = :miss_passwd_code, miss_passwd_code_expire = :miss_passwd_code_expire WHERE email = :email ";
                $stmt = $pdo->prepare($sql);

                $miss_passwd_code = rand(1000, 9999); //rand範圍0-32767
                $miss_passwd_code_expire = date('Y-m-d H:i:s', strtotime('+1 hours'));
                $email = $_SESSION['email'];
                $stmt->bindParam(":miss_passwd_code", $miss_passwd_code, PDO::PARAM_STR);
                $stmt->bindParam(":miss_passwd_code_expire", $miss_passwd_code_expire, PDO::PARAM_STMT);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                if ($stmt->execute()) {
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
                    $mail->FromName = "驗證信";
                    $webmaster_email = "todaytime0311@gmail.com";
                    //$_SESSION["email"]
                    $email = $_SESSION['email'];
                    $name = "1";
                    $mail->From = $webmaster_email;

                    $mail->AddAddress($email, $name);
                    $mail->AddReplyTo($webmaster_email, "Squall.f");

                    $mail->WordWrap = 50;
                    $mail->IsHTML(true);
                    $mail->Subject = "信件標題";
                    $mail->Body = <<< HTML
        <h5>此為MAXGEAR瑪斯佶科技公司再次發送的密碼遺失驗證信</h5><br>
        <p>這是您的驗證碼:{$miss_passwd_code}</p>
        <p>請於1小時內輸入驗證碼，過期即失效... </p>
        <p>一天內最多發送4封密碼遺失驗證信</p>
        <P>失效時間為{$miss_passwd_code_expire}</P>
        HTML;

                    if (!$mail->Send()) {
                        $send_mail_err =  "發送信件時發生錯誤，請確定email是否正確";
                    }
                    // ================================== 寄信結束 ==================================
                } else {
                    echo "mysql存入資料時錯誤";
                }
                unset($stmt);
                unset($pdo);
            }
            $member_verify = 'http://' . $_SERVER['HTTP_HOST'] . '/MAXGEAR' . '/member' . '/verify.php'; //使郵件寄送時，讓使用者連接至驗證網址
        } else {
            //echo "今日寄信上線已到達，請明天在嘗試";
            $_SESSION['send_mail'] = 4;
        }
    } else {
        $_SESSION['send_mail'] = 1;
        if (@$_SESSION["verification"] == 1) {
            $sql = "UPDATE member_maxgear SET miss_passwd_code = :miss_passwd_code, miss_passwd_code_expire = :miss_passwd_code_expire WHERE email = :email ";
            $stmt = $pdo->prepare($sql);

            $miss_passwd_code = rand(1000, 9999); //rand範圍0-32767
            $miss_passwd_code_expire = date('Y-m-d H:i:s', strtotime('+1 hours'));
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
            }
            $stmt->bindParam(":miss_passwd_code", $miss_passwd_code, PDO::PARAM_STR);
            $stmt->bindParam(":miss_passwd_code_expire", $miss_passwd_code_expire, PDO::PARAM_STMT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            if ($stmt->execute()) {
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
                $mail->FromName = "驗證信";
                $webmaster_email = "todaytime0311@gmail.com";
                //$_SESSION`["email"]
                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];
                }
                $name = "1";
                $mail->From = $webmaster_email;

                $mail->AddAddress($email, $name);
                $mail->AddReplyTo($webmaster_email, "Squall.f");

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->Subject = "信件標題";
                $mail->Body = <<< HTML
    <h5>此為MAXGEAR瑪斯佶科技公司再次發送的密碼遺失驗證信</h5><br>
    <p>這是您的驗證碼:{$miss_passwd_code}</p>
    <p>請於1小時內輸入驗證碼，過期即失效... </p>
    <p>一天內最多發送4封密碼遺失驗證信</p>
    <P>失效時間為{$miss_passwd_code_expire}</P>
HTML;

                if (!$mail->Send()) {
                    $send_mail_err = "發送信件時發生錯誤，請確定email是否正確";
                    // ================================== 寄信結束 ==================================
                } else {
                    echo "mysql存入資料時錯誤";
                }
                unset($stmt);
                unset($pdo);
            }
        }
    }
    ?>
    <div class="MG-member-background MG-email-background"></div>
    <div>
        <div class="MG-header-space"></div>
        <div class="MG-email-box MG-resend-tmp-auth-code-box-padding MG-tmp-auth-code-type">
            <div class="MG-resend-tmp-code-box-top">
                <?php if (isset($send_mail_err)) {
                    echo $send_mail_err;
                } else {
                    if ($_SESSION['send_mail'] < 3) { ?>
                        <p class="MG-add-finish-title">郵件已發送，請至信箱收信</p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "今日已發送次數" . @$_SESSION['send_mail'] . "次"; ?>
                <?php } else {
                        echo "今日寄信上線已到達，請明天在嘗試";
                    }
                } ?>
                <div class="MG-email-box-content">
                </div>
                <button class="MG-add-finish-btn btn  btn-info" onclick="return closeMyWindow()">確認</button>
            </div>
        </div>
        <div class="footer"></div>


        <script type="text/javascript">
            function closeMyWindow() {
                window.setTimeout("window.close()", 1000);
            }
        </script>
</body>