<?php 
    session_start();
    header("Content-Type:text/html;charset=utf-8");
    $json_string = file_get_contents('connect.json');
    $data = json_decode($json_string,true);
    $link = mysqli_connect($data['ip'],$data['name'],$data['pwd'],$data['basename']);//服务器,用户名,密码,数据库
    mysqli_set_charset($link,'utf8');
    $schoolnum = $_SESSION['schoolnum'];//提取用户名
    $pw = $_SESSION['pw'];//提取密码
    
    $sql = "SELECT `name`,`sel1`,`sel2`,`schoolnum`,`password`,`tel` FROM `stulist` WHERE schoolnum='$schoolnum'and password='$pw'";
    $result=mysqli_query($link,$sql);//返回查询结果
    $row= mysqli_fetch_array($result);//单行数据引入数组
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
	<meta name="renderer" content="webkit"><!--360渲染模式-->
	<meta name="format-detection" content="telephone=notelphone=no, email=no" />
    <meta name="apple-touch-fullscreen" content="yes"/><!-- 是否启用 WebApp 全屏模式，删除苹果默认的工具栏和菜单栏 -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/><!-- 设置苹果工具栏颜色:默认值为 default，可以定为 black和 black-translucent-->
	<meta http-equiv="Cache-Control" content="no-siteapp" /><!-- 不让百度转码 -->
	<meta name="HandheldFriendly" content="true"><!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
	<meta name="MobileOptimized" content="320"><!-- 微软的老式浏览器 -->
	<meta name="screen-orientation" content="portrait"><!-- uc强制竖屏 -->
	<meta name="x5-orientation" content="portrait"><!-- QQ强制竖屏 -->
	<meta name="browsermode" content="application"><!-- UC应用模式 -->
	<meta name="x5-page-mode" content="app"><!-- QQ应用模式 -->
	<meta name="msapplication-tap-highlight" content="no"><!-- windows phone 点击无高光 -->
    <link rel="shortcut icon" href="http://ou2r9nim8.bkt.clouddn.com/bitbug_favicon%20%281%29.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/index.css">
    <title>提示</title>
</head>

<body>
    <div class="tip_main">
        <div class="head">
            <span class="head_title">当前状态</span>
            <a href="../index.html" class="close">
                <img src="../img/close.png" alt="">
            </a>
        </div>
        <div id="status">
            <p><?php echo $row['name'];?>你好 : </p>
            你选择的部门 : <p class="words"><?php echo $row['sel1'];?> &
            <?php echo $row['sel2']; ?> </p>
            你的手机号:<p class="words"><?php echo $row['tel']; ?></p>   
        </div>
        <div id="tip_btn">
            <a href="../views/signUp.php">修改</a>
        </div>
        <div class="tip_find">
            <p>通院科协预备役QQ群:659358016</p>
            <p>科协活动室:教四304/314</p>
        </div>
    </div>
    <script src="../js/jquery.min.js"></script>
</body>

</html>
