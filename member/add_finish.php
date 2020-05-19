<?php session_start();
header("Cache-control:private");
?>
<?php require_once('../Connections/connSQL.php'); ?>
<!DOCTYPE html>
<html ng-app="app" lang="zh-TW">
<!--        信箱點選連結激活帳戶成功頁面        -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAX GEAR瑪斯佶註冊會員</title>
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="MG-member-background MG-email-background"></div>
    <div>
        <div class="MG-header-space"></div>
        <div class="MG-email-box">
            <div class="MG-email-box-top">
                <p class="MG-add-finish-title">您的帳戶已成功激活</p>
                <div class="MG-email-box-content MG-email-box-content-right">
        <a class="MG-add-finish-btn btn  btn-info" href="login.php">確認</a>
                </div>
            </div>
    <div class="footer"></div>
        </div>
    </div>
    <script>
</script>
</body>
<!--
    表單參考資料
    https://icodding.blogspot.com/2015/09/php_92.html?m=1
-->