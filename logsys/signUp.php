<?php 
	session_start();
	header("Content-Type:text/html;charset=utf-8;");
	$json_string = file_get_contents('connect.json');
	$data = json_decode($json_string,true);
	$link = mysqli_connect($data['ip'],$data['name'],$data['pwd'],$data['basename']);//服务器,用户名,密码,数据库
	mysqli_set_charset($link,'utf8');//设定字符集
	if ($link) {
		if(($_POST['name']!=NULL)&&($_POST['tel']!=NULL))	{
			$name = $_POST['name'];
			$tel = $_POST['tel'];
			$sel1 = $_POST['sel1'];
			$sel2 = $_POST['sel2'];
			$schoolnum = $_SESSION['schoolnum'];//提取用户名
			$pw = $_SESSION['pw'];//提取密码
			date_default_timezone_set("Asia/Shanghai");
			$date = date("y-m-d\:G-i-s");
			$update = "UPDATE stulist SET name=?,tel=?,sel1 =?,sel2=?,flag='TRUE',date='$date' WHERE schoolnum=? and password=? ";
			$stmt = mysqli_prepare($link,$update);//准备一条查询语句
			mysqli_stmt_bind_param($stmt,'sissss',$name,$tel,$sel1,$sel2,$schoolnum,$pw);//绑定参数
			$sql=mysqli_stmt_execute($stmt);//执行查询语句
			
			if($sql){
				//$update2 = "UPDATE stulist SET flag='TRUE'WHERE schoolnum=? and password=? ";
				//mysqli_query($link,$update2);
				echo "<script>alert('报名成功');location='../views/tip.php';</script>";
				exit();
			}
		}
		else{
			echo "<script>alert('请输入姓名和手机号');location='../views/signUp.html';</script>";
		}
	}
	else{
		echo "<script>alert('连接数据库失败');</script>".mysqli_connect_error();
		exit();
	}
 ?>