<!--PDO物件名稱 = new PDO("mysql:host = MYSQL伺服器位址; dbname = 資料庫名稱; charet = 預設字元集編碼", 帳號 , 密碼)try{}catch{//發生錯誤時執行}
//資料庫主機-->
<?php/*
$db_host = "127.0.0.1";
$db_name = "maxgear";
$db_username = "admin";
$db_password = "111111";
//錯誤時處理
try{
    //物件名稱           語法       伺服器位址     語法     資料庫      預設字元編碼        帳號            密碼
    $db_link =new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8",$db_username, $db_password);
        //錯誤時運作    變數e
} catch (PDOException $e){
    //錯誤訊息
    print "資料庫連結失敗，訊息:{$e->getMessage()}<br/>";
    //結束當前腳本運作，並可以傳回()內容
    die("錯誤!停止");
}*/
?>


<!--
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connSQL = "127.0.0.1";
$database_connSQL = "maxgear";
$username_connSQL = "admin";
$password_connSQL = "111111";
$connSQL = @mysqli_connect($hostname_connSQL, $username_connSQL, $password_connSQL) or die("伺服器連線失敗"); 
mysqli_query($connSQL,"SET NAMES UTF8");
-->
<?php
//Database credentials. Assuming you are running MySQL
//server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'maxgear');

// Attempt to connect to MySQL database 
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>



<!--- Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'maxgear');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
