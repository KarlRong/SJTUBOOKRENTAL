<?php
session_start();
$pnumber = $_SESSION['validate']['pnumber'];
$pass = $_SESSION['validate']['passwd'];
if(!$pnumber || !$pass){
			header('location:index.html');
		}else{
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>交大图书共享系统</title>
	</head>
	<body style="width:100%;margin:0px auto;">
		<div style="position:fixed; width:100%; height:100%; z-index:-1">
			<img src="images/1.jpg" height="100%" width="100%" />
		</div>

		<h1 style="text-align:center;">欢迎来到交大图书共享系统！</h1><br/>

		<div  align="center">
			账号：<?php echo $pnumber; ?><span>&nbsp;&nbsp;</span><a href="logout.php">退出</a><br/><br/><br/>
		</div>

		<div align="center">
			<a href="book_share.php"><input type="button" value="我要分享" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_borrow.php"><input type="button" value="我要借书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_back.php"><input type="button" value="我要还书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_mine.php"><input type="button" value="我的图书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
		</div><br/><br/><br/><br/>

		<div style="margin-left:25%;" >
			<h3>网站使用说明：</h3>
			<ol>
				<li>“我要借书”：点击进入借书查询页面，查询当前是否存在想借阅的图书。</li><br/>
				<li>“我要分享”：点击进入分享上传页面，上传愿意出借图书的完整书名和ISBN码。</li><br/>
				<li>“我要还书”：点击进入还书确认页面，归还完成后注销当前仍显示已借阅的图书。</li><br/>
				<li>“我的图书”：点击进入我的图书页面，查看当前上传、借阅、发出的请求，接收到的请求。</li><br/>
			</ol>
		</div>
		
		<div  align="center" style="position:fixed;bottom:3px;width:100%">
			<p>联系号码: 189 1689 3352，邮箱:1652705695@qq.com ，设计制作：庄子龙，Copyright &copy; 2017-2021 zhuangzilong . All rights reserved.</p>
		</div>
	</body>
</html>
<?php
		}
?>