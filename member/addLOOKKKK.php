<?php session_start();
require_once('./Connections/connSQL.php');
require_once("./src/PHPMailer.php");
require_once("./src/SMTP.php");
require_once("./src/Exception.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MAX GEAR瑪斯佶註冊會員</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/member.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-3.4.1.min.js"></script>
</head>

<body>
    <div class="background-full"></div>
    <div>
        <div class="body_add">
            <div class="header_space"></div>
            <div class="paceTop">
                <div class="bg_content">
                    <h2 class="h2_center font-weight-bold">註冊</h2>
                    <form action="member_add.php?" method="post">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group <?php echo (!empty($first_name_err)) ? '1' : ''; ?>  ">
                                    <label style="color:white">名稱</label>
                                    <input type="text" name="first_name" class="form-control1 member-Textfield" value="<?php echo $first_name; ?>">
                                    <span style="color:white" class="help-block "><?php echo $first_name_err; ?></span>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <div class="form-group <?php echo (!empty($last_name_err)) ? '1' : ''; ?>">
                                    <label style="color:white">姓氏</label>
                                    <input type="text" name="last_name" class="form-control1 member-Textfield" value="<?php echo $last_name; ?>">
                                    <span style="color:white" class="help-block"><?php echo $last_name_err; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group <?php echo (!empty($password_err)) ? '1' : ''; ?>">
                                    <label style="color:white">密碼</label>
                                    <input type="password" name="password" class="form-control1 member-Textfield" value="<?php echo $password; ?>" placeholder="">
                                    <span style="color:white" class="help-block"><?php echo $password_err; ?></span>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <div class="form-group <?php echo (!empty($confirm_password_err)) ? '1' : ''; ?>">
                                    <label style="color:white">確認密碼</label>
                                    <input type="password" name="confirm_password" class="form-control1 member-Textfield" value="<?php echo $confirm_password; ?>" placeholder="">
                                    <span style="color:white" class="help-block"><?php echo $confirm_password_err; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-5">
                                <div class="form-group <?php echo (!empty($birthday_err)) ? '1' : ''; ?>">
                                    <label style="color:white">生日</label>
                                    <input type="date" name="birthday" class="form-control1 member-Textfield" value="<?php echo $birthday; ?>" placeholder="">
                                    <span style="color:white" class="help-block"><?php echo $birthday_err; ?></span>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-5">
                                <label style="color:white" for="area" class="form-group-label">國&nbsp;家&nbsp;/&nbsp;地&nbsp;區</label>
                                <select onChange="citychange(this.form)" name="area" class="form-control1 member-Textfield">
                                    <option value="臺灣">臺灣</option>
                                    <option value="日本">日本</option>
                                    <option value="美國">美國</option>
                                    <option value="德國">德國</option>
                                    <option value="阿富汗">阿富汗</option>
                                    <option value="亞美尼亞">亞美尼亞</option>
                                    <option value="阿塞拜疆">阿塞拜疆</option>
                                    <option value="巴林">巴林</option>
                                    <option value="孟加拉">孟加拉</option>
                                    <option value="不丹">不丹</option>
                                    <option value="文萊">文萊</option>
                                    <option value="柬埔寨">柬埔寨</option>
                                    <option value="中國">中國</option>
                                    <option value="科科斯群島">科科斯群島</option>
                                    <option value="塞浦路斯">塞浦路斯</option>
                                    <option value="格魯吉亞">格魯吉亞</option>
                                    <option value="香港">香港</option>
                                    <option value="印度">印度</option>
                                    <option value="印度尼西亞">印度尼西亞</option>
                                    <option value="伊朗">伊朗</option>
                                    <option value="伊拉克">伊拉克</option>
                                    <option value="以色列">以色列</option>
                                    <option value="約旦">約旦</option>
                                    <option value="哈薩克斯坦">哈薩克斯坦</option>
                                    <option value="朝鮮">朝鮮</option>
                                    <option value="韓國">韓國</option>
                                    <option value="科威特">科威特</option>
                                    <option value="吉爾吉斯斯坦">吉爾吉斯斯坦</option>
                                    <option value="寮國">寮國</option>
                                    <option value="黎巴嫩">黎巴嫩</option>
                                    <option value="澳門">澳門</option>
                                    <option value="馬來西亞">馬來西亞</option>
                                    <option value="馬爾代夫">馬爾代夫</option>
                                    <option value="蒙古">蒙古</option>
                                    <option value="緬甸">緬甸</option>
                                    <option value="尼泊爾">尼泊爾</option>
                                    <option value="尼日爾">尼日爾</option>
                                    <option value="尼日利亞">尼日利亞</option>
                                    <option value="阿曼">阿曼</option>
                                    <option value="巴基斯坦">巴基斯坦</option>
                                    <option value="巴勒斯坦">巴勒斯坦</option>
                                    <option value="菲律賓">菲律賓</option>
                                    <option value="葡萄牙帝汶">葡萄牙帝汶</option>
                                    <option value="卡塔爾">卡塔爾</option>
                                    <option value="沙特阿拉伯">沙特阿拉伯</option>
                                    <option value="新加坡">新加坡</option>
                                    <option value="斯里蘭卡">斯里蘭卡</option>
                                    <option value="敘利亞">敘利亞</option>
                                    <option value="塔吉克斯坦">塔吉克斯坦</option>
                                    <option value="泰國">泰國</option>
                                    <option value="東帝汶">東帝汶</option>
                                    <option value="土耳其">土耳其</option>
                                    <option value="土庫曼斯坦">土庫曼斯坦</option>
                                    <option value="阿拉伯聯合酋長國">阿拉伯聯合酋長國</option>
                                    <option value="烏茲別克斯坦">烏茲別克斯坦</option>
                                    <option value="越南">越南</option>
                                    <option value="也門">也門</option>
                                    <option value="安圭拉島">安圭拉島</option>
                                    <option value="安提瓜和巴布達島">安提瓜和巴布達島</option>
                                    <option value="阿魯巴島">阿魯巴島</option>
                                    <option value="巴哈馬群島">巴哈馬群島</option>
                                    <option value="巴巴多斯">巴巴多斯</option>
                                    <option value="伯利茲">伯利茲</option>
                                    <option value="百慕大">百慕大</option>
                                    <option value="博奈爾、聖尤斯特歇斯和薩巴">博奈爾、聖尤斯特歇斯和薩巴</option>
                                    <option value="加拿大">加拿大</option>
                                    <option value="開曼群島">開曼群島</option>
                                    <option value="哥斯達黎加">哥斯達黎加</option>
                                    <option value="古巴">古巴</option>
                                    <option value="多米尼克聯邦">多米尼克聯邦</option>
                                    <option value="多米尼加共和國">多米尼加共和國</option>
                                    <option value="薩爾瓦多">薩爾瓦多</option>
                                    <option value="格陵蘭">格陵蘭</option>
                                    <option value="格林納達">格林納達</option>
                                    <option value="瓜得羅普島">瓜得羅普島</option>
                                    <option value="危地馬拉">危地馬拉</option>
                                    <option value="海地">海地</option>
                                    <option value="洪都拉斯">洪都拉斯</option>
                                    <option value="牙買加">牙買加</option>
                                    <option value="馬提尼克">馬提尼克</option>
                                    <option value="墨西哥">墨西哥</option>
                                    <option value="蒙特塞拉特">蒙特塞拉特</option>
                                    <option value="荷蘭安的列斯群島">荷蘭安的列斯群島</option>
                                    <option value="尼加拉瓜">尼加拉瓜</option>
                                    <option value="巴拿馬">巴拿馬</option>
                                    <option value="波多黎各">波多黎各</option>
                                    <option value="聖巴泰勒米島">聖巴泰勒米島</option>
                                    <option value="聖基茨和尼維斯聯邦">聖基茨和尼維斯聯邦</option>
                                    <option value="聖盧西亞">聖盧西亞</option>
                                    <option value="法屬聖馬丁島">法屬聖馬丁島</option>
                                    <option value="聖皮埃爾島和密克隆島">聖皮埃爾島和密克隆島</option>
                                    <option value="聖文森特和格林納丁斯">聖文森特和格林納丁斯</option>
                                    <option value="荷屬聖馬丁">荷屬聖馬丁</option>
                                    <option value="特立尼達和多巴哥">特立尼達和多巴哥</option>
                                    <option value="特克斯和凱科斯群島">特克斯和凱科斯群島</option>
                                    <option value="美屬維爾京群島">美屬維爾京群島</option>
                                    <option value="英屬維爾京群島">英屬維爾京群島</option>
                                    <option value="南極洲">南極洲</option>
                                    <option value="布韋島">布韋島</option>
                                    <option value="赫德島和麥克唐納群島">赫德島和麥克唐納群島</option>
                                    <option value="南喬治亞島和南桑威奇群島">南喬治亞島和南桑威奇群島</option>
                                    <option value="阿根廷共和國">阿根廷共和國</option>
                                    <option value="玻利維亞">玻利維亞</option>
                                    <option value="巴西">巴西</option>
                                    <option value="智利">智利</option>
                                    <option value="哥倫比亞">哥倫比亞</option>
                                    <option value="庫拉索島">庫拉索島</option>
                                    <option value="厄瓜多爾">厄瓜多爾</option>
                                    <option value="法屬圭亞那">法屬圭亞那</option>
                                    <option value="圭亞那">圭亞那</option>
                                    <option value="巴拉圭">巴拉圭</option>
                                    <option value="秘魯">秘魯</option>
                                    <option value="蘇里南">蘇里南</option>
                                    <option value="烏拉圭">烏拉圭</option>
                                    <option value="委內瑞拉">委內瑞拉</option>
                                    <option value="美屬薩摩亞">美屬薩摩亞</option>
                                    <option value="澳大利亞">澳大利亞</option>
                                    <option value="聖誕島">聖誕島</option>
                                    <option value="庫克群島">庫克群島</option>
                                    <option value="斐濟">斐濟</option>
                                    <option value="法屬波利尼西亞">法屬波利尼西亞</option>
                                    <option value="關島">關島</option>
                                    <option value="基里巴斯">基里巴斯</option>
                                    <option value="馬紹爾群島">馬紹爾群島</option>
                                    <option value="密克羅尼西亞">密克羅尼西亞</option>
                                    <option value="瑙魯">瑙魯</option>
                                    <option value="新喀里多尼亞">新喀里多尼亞</option>
                                    <option value="新西蘭">新西蘭</option>
                                    <option value="紐埃">紐埃</option>
                                    <option value="諾福克島">諾福克島</option>
                                    <option value="帕勞">帕勞</option>
                                    <option value="巴布亞新幾內亞">巴布亞新幾內亞</option>
                                    <option value="皮特凱恩島">皮特凱恩島</option>
                                    <option value="薩摩亞">薩摩亞</option>
                                    <option value="所羅門群島">所羅門群島</option>
                                    <option value="托克勞">托克勞</option>
                                    <option value="湯加">湯加</option>
                                    <option value="圖瓦魯">圖瓦魯</option>
                                    <option value="瓦努阿圖">瓦努阿圖</option>
                                    <option value="瓦利斯和富圖納群島">瓦利斯和富圖納群島</option>
                                    <option value="北馬里亞納群島">北馬里亞納群島</option>
                                    <option value="奧蘭群島">奧蘭群島</option>
                                    <option value="阿爾巴尼亞">阿爾巴尼亞</option>
                                    <option value="安道爾">安道爾</option>
                                    <option value="奧地利">奧地利</option>
                                    <option value="白俄羅斯">白俄羅斯</option>
                                    <option value="比利時">比利時</option>
                                    <option value="波黑">波黑</option>
                                    <option value="英國（聯合王國）">英國（聯合王國）</option>
                                    <option value="保加利亞">保加利亞</option>
                                    <option value="克羅地亞">克羅地亞</option>
                                    <option value="捷克">捷克</option>
                                    <option value="丹麥">丹麥</option>
                                    <option value="愛沙尼亞">愛沙尼亞</option>
                                    <option value="歐盟">歐盟</option>
                                    <option value="法羅群島">法羅群島</option>
                                    <option value="芬蘭">芬蘭</option>
                                    <option value="法國">法國</option>
                                    <option value="直布羅陀">直布羅陀</option>
                                    <option value="希臘">希臘</option>
                                    <option value="根西島">根西島</option>
                                    <option value="匈牙利">匈牙利</option>
                                    <option value="冰島">冰島</option>
                                    <option value="愛爾蘭">愛爾蘭</option>
                                    <option value="馬恩島">馬恩島</option>
                                    <option value="意大利">意大利</option>
                                    <option value="澤西島">澤西島</option>
                                    <option value="拉脫維亞">拉脫維亞</option>
                                    <option value="列支敦士登">列支敦士登</option>
                                    <option value="立陶宛">立陶宛</option>
                                    <option value="盧森堡">盧森堡</option>
                                    <option value="馬耳他">馬耳他</option>
                                    <option value="摩爾多瓦">摩爾多瓦</option>
                                    <option value="摩納哥">摩納哥</option>
                                    <option value="黑山">黑山</option>
                                    <option value="荷屬">荷屬</option>
                                    <option value="北馬其頓">北馬其頓</option>
                                    <option value="挪威">挪威</option>
                                    <option value="波蘭">波蘭</option>
                                    <option value="葡萄牙">葡萄牙</option>
                                    <option value="羅馬尼亞">羅馬尼亞</option>
                                    <option value="俄羅斯">俄羅斯</option>
                                    <option value="聖馬力諾">聖馬力諾</option>
                                    <option value="塞爾維亞">塞爾維亞</option>
                                    <option value="斯洛伐克">斯洛伐克</option>
                                    <option value="斯洛文尼亞">斯洛文尼亞</option>
                                    <option value="蘇聯">蘇聯</option>
                                    <option value="西班牙">西班牙</option>
                                    <option value="斯瓦爾巴和揚馬延群島">斯瓦爾巴和揚馬延群島</option>
                                    <option value="瑞典">瑞典</option>
                                    <option value="瑞士">瑞士</option>
                                    <option value="烏克蘭">烏克蘭</option>
                                    <option value="梵蒂岡">梵蒂岡</option>
                                    <option value="阿爾及利亞">阿爾及利亞</option>
                                    <option value="安哥拉">安哥拉</option>
                                    <option value="阿森松島">阿森松島</option>
                                    <option value="貝寧">貝寧</option>
                                    <option value="博茨瓦納">博茨瓦納</option>
                                    <option value="布基納法索">布基納法索</option>
                                    <option value="布隆迪">布隆迪</option>
                                    <option value="喀麥隆">喀麥隆</option>
                                    <option value="佛得角">佛得角</option>
                                    <option value="中非共和國">中非共和國</option>
                                    <option value="乍得">乍得</option>
                                    <option value="科摩羅">科摩羅</option>
                                    <option value="剛果民主共和國">剛果民主共和國</option>
                                    <option value="剛果共和國">剛果共和國</option>
                                    <option value="科特迪瓦；象牙海岸">科特迪瓦；象牙海岸</option>
                                    <option value="吉布提">吉布提</option>
                                    <option value="埃及">埃及</option>
                                    <option value="赤道幾內亞">赤道幾內亞</option>
                                    <option value="厄立特里亞">厄立特里亞</option>
                                    <option value="斯威士蘭">斯威士蘭</option>
                                    <option value="埃塞俄比亞">埃塞俄比亞</option>
                                    <option value="加蓬">加蓬</option>
                                    <option value="岡比亞">岡比亞</option>
                                    <option value="加納">加納</option>
                                    <option value="幾內亞">幾內亞</option>
                                    <option value="幾內亞-比紹">幾內亞-比紹</option>
                                    <option value="肯尼亞">肯尼亞</option>
                                    <option value="萊索托">萊索托</option>
                                    <option value="利比里亞">利比里亞</option>
                                    <option value="利比亞">利比亞</option>
                                    <option value="馬達加斯加">馬達加斯加</option>
                                    <option value="馬拉維">馬拉維</option>
                                    <option value="馬里">馬里</option>
                                    <option value="毛里塔尼亞">毛里塔尼亞</option>
                                    <option value="毛里求斯">毛里求斯</option>
                                    <option value="馬約特">馬約特</option>
                                    <option value="摩洛哥">摩洛哥</option>
                                    <option value="莫桑比克">莫桑比克</option>
                                    <option value="納米比亞">納米比亞</option>
                                    <option value="留尼汪島">留尼汪島</option>
                                    <option value="盧旺達">盧旺達</option>
                                    <option value="聖赫勒拿、阿森松和特里斯坦-達庫尼亞群島">聖赫勒拿、阿森松和特里斯坦-達庫尼亞群島</option>
                                    <option value="聖多美和普林西比">聖多美和普林西比</option>
                                    <option value="塞內加爾">塞內加爾</option>
                                    <option value="塞舌爾">塞舌爾</option>
                                    <option value="塞拉利昂">塞拉利昂</option>
                                    <option value="索馬里">索馬里</option>
                                    <option value="南非共和國">南非共和國</option>
                                    <option value="南蘇丹">南蘇丹</option>
                                    <option value="蘇丹">蘇丹</option>
                                    <option value="坦桑尼亞">坦桑尼亞</option>
                                    <option value="多哥">多哥</option>
                                    <option value="突尼斯">突尼斯</option>
                                    <option value="烏干達">烏干達</option>
                                    <option value="西撒哈拉">西撒哈拉</option>
                                    <option value="贊比亞">贊比亞</option>
                                    <option value="津巴布韋">津巴布韋</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 "><input style="position: absolute" type="reset" class="btn-lg btn btn-warning float-right" value="重設"></div>
                            <div class="col-5 ">
                                <div class="form-group btn_down">
                                    <input type="submit" class="btn-lg btn btn-info float-right" value="確定">
                                    <input type="button" class="btn-lg btn btn-info " onclick="javascript:location.href='index.php'" value="取消"></input>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2"><input style="position: absolute" type="reset" class="btn-lg btn btn-warning float-right" value="重設">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="footer"></div>
    </div>
    <script type="text/javascript">
        var app = angular.module('app', ["wui.date"]);
    </script>

    <?php if (isset($_SESSION['email'])) {
        echo $_SESSION['email'];
    } ?>

</body>