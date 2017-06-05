<?php
session_start();
$pnumber = $_SESSION['validate']['pnumber'];
$pass = $_SESSION['validate']['passwd'];
if(!$pnumber || !$pass){
			header('location:index.html');
		}else{
?>


<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>我的图书</title>
		<style type="text/css">
		#pages {width:100%;margin:auto;}
		#d1 {width:40%;float:left;}
		#d2 {width:40%;float:left;}
		</style>
	</head>
	<body style="width:100%;margin:0px auto;">
		<div style="position:fixed; width:100%; height:100%; z-index:-1">
			<img src="images/11.jpg" height="100%" width="100%" />
		</div>

		<h1 style="text-align:center;">交大图书共享--我的图书</h1><br/>

		<div  align="center">
			账号：<?php echo $pnumber; ?><span>&nbsp;&nbsp;</span><a href="logout.php">退出</a><br/><br/><br/>
		</div>

		<div align="center">
			<a href="book_share.php"><input type="button" value="我要分享" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_borrow.php"><input type="button" value="我要借书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_back.php"><input type="button" value="我要还书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_mine.php"><input type="button" value="我的图书" style="width:80px;height:30px;text-align:center;color: red;"/></a><span>&nbsp;&nbsp;</span>
		</div><br/><br/><br/><br/>
		

		<div id="pages">
		<div id="d1" style="margin-left:2%; float:left; display:inline;" >
			<h3>"我的图书"网站使用说明：</h3>
			<ol>
				<li>“本人上传图书”：点击可查看本人已经上传的图书及下架操作。</li><br/>

				<li>“本人借入图书”：点击可查看本人借入的图书及相应归还日期。</li><br/>				
			
				<li>“本人借出图书”：包含在本人上传图书中。</li><br/>
			</ol>
		</div>

		<div id="d2" style="margin-right:2%;float:right; display:inline;" >
			<fieldset>
			<legend><h3>我的图书</h3></legend>
				<div  align="center">
				<a href="book_myown/book_myown.php"><input type="button" value="本人上传图书" style="width:50%;height:40px;align-items: center;"/></a><br/><br/>

				<a href="book_myborrow/book_myborrow.php"><input type="button" value="本人借入图书" style="width:50%;height:40px;align-items: center;"/></a><br/><br/>

				</div>
			</fieldset>
		</div>
		</div>



		<div  align="center" style="position:fixed;bottom:3px;width:100%">
			<p>联系号码: 189 1689 3352，邮箱:1652705695@qq.com ，设计制作：庄子龙，Copyright &copy; 2017-2021 zhuangzilong . All rights reserved.</p>
		</div>
	</body>
</html>


<?php 
}
?>