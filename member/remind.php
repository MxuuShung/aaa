<?php session_start();
header("Cache-control:private");
require_once('../Connections/connSQL.php'); ?>

<!--註冊完成後的提醒驗證頁，登入時如果信箱未驗證通過，也跳轉至此-->
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
    <script src="../js/jquery.min.js"></script>

<body>
<div class="MG-member-background MG-email-background"></div>
    <div>
        <div class="MG-header-space"></div>
        <div class="MG-email-box">
            <div class="MG-email-box-top">
                <p class="MG-add-finish-title">請至信箱收信!</p>
                <div class="MG-email-box-content">
        <a class="MG-add-finish-btn btn  btn-info" href="login.php">確認</a>
            </div>
        </div>
    <div class="footer"></div>

    <script>
    $(document).ready(function() {
        $("#go_index").click(function() {
            window.close();
            window.close();
        });
    });
</script>
</body>
<!--
    表單參考資料
    https://icodding.blogspot.com/2015/09/php_92.html?m=1
-->