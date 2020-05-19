<?php
session_start();
require_once('../Connections/connSQL.php');
/**
 * 使用者(member)帳號驗證頁面
 * 登入時，如果發現帳號沒有驗證通過，則會轉到這頁
 *   
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location:login.php");
    exit;
}
 */

// 判斷用戶的驗證狀態，若通過，則導入到登入後的首頁
// "重新產生並寄送驗證碼"頁面的連結
//$_SERVER['HTTP_HOST']：當前請求的Host頭中的內容(與取得Server的Port)
//$_SERVER['REQUEST_URI'] #訪問此頁面所需的 URI。例如，「/index.html」。在此為MAXGEAR
//resend_miss_passwd_code.php指定跳轉頁面(認證頁)
$resendTmpAuthCode = 'http://' . $_SERVER['HTTP_HOST'] . '/MAXGEAR_Eric' . '/member'.'/resend_tmp_auth_code.php';
$member_verify = 'http://' . $_SERVER['HTTP_HOST'] . '/MAXGEAR_Eric' . '/member'.'/verify.php';

//定義變量並空值初始化
$tmp_auth_code_err  = '';

//表單POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["tmp_auth_code"]))) {
        $tmp_auth_code_err = "請輸入驗證碼.";
    } else {
        //查詢 
        $sql = "SELECT tmp_auth_code,tmp_auth_code_expire FROM member_maxgear WHERE email = :email";
        if ($stmt = $pdo->prepare($sql)) {
            $email = trim($_SESSION['email']);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $member = $stmt->fetch();
            if ($member['tmp_auth_code'] != $_POST['tmp_auth_code']) {
                $tmp_auth_code_err  = '驗證碼錯誤，請點擊重新寄送驗證碼';
            } else if (strtotime(date('Y-m-d H:i:s')) > strtotime($member["tmp_auth_code_expire"])) {
                $tmp_auth_code_err  = '驗證碼已過期，請點擊重新寄送驗證碼';
            } else {
                echo "驗證成功";
                $_SESSION["verification"] = 1;
                header("location:verification.php");
            }
        }
        unset($stmt);
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8">
    <title>帳戶驗證</title>
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="MG-member-background MG-email-background"></div>
    <div>
        <div class="MG-header-space"></div>
        <div class="MG-verify-box">
            <div class="MG-email-box-top">
                <p class="MG-email-title">帳戶驗證</p>
                <div class="MG-email-box-content">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($tmp_auth_code_err)) ? '錯誤' : '1'; ?>">
                            <label>驗證碼</label>
                            <input type="text" name="tmp_auth_code" class="form-control" value="<?php $tmp_auth_code ?>" placeholder="輸入後請按Enter">
                            <span class="help-block"><?php echo $tmp_auth_code_err ?></span>
                        </div>
                        <input type="submit" class="MG-verify-btn btn btn-info " value="確定">
                    </form>
                    <button id="slow_button" class="MG-verify-btn-2 btn btn-outline-info"><a href="<?= $resendTmpAuthCode ?>" target="_blank">重新寄送驗證碼</a></button>
                </div>
            </div>
        </div>
    </div>
    <!--按鈕，延遲效果-->
    <script type="text/javascript">
        var waitTime = 300;
        document.getElementById("slow_button").onclick = function() {
            time(this);
        }

        function time(ele) {
            if (waitTime == 0) {
                ele.disabled = false;
                ele.innerHTML = "";
                waitTime = 300; // 恢復計時，設定為300秒，5分鐘
            } else {
                ele.disabled = true;
                ele.innerHTML = waitTime + "秒後可再次發送";
                waitTime--;
                setTimeout(function() {
                    time(ele) // 定時循環調節用
                }, 1000)
            }
        }
    </script>
</body>

</html>