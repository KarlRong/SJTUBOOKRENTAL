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
		<title>我要借书</title>
		<style type="text/css">
		#pages {width:100%;margin:auto;}
		#d1 {width:50%;float:left;}
		#d2 {width:40%;float:left;}
		</style>


	</head>
	<body style="width:100%;margin:0px auto;">
		<div style="position:fixed; width:100%; height:100%; z-index:-1">
			<img src="images/22.jpg" height="100%" width="100%" />
		</div>

		<h1 style="text-align:center;">交大图书共享--我要借书</h1><br/>

		<div  align="center">
			账号：<?php echo $pnumber; ?><span>&nbsp;&nbsp;</span><a href="logout.php">退出</a><br/><br/><br/>
		</div>

		<div align="center">
			<a href="book_share.php"><input type="button" value="我要分享" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_borrow.php"><input type="button" value="我要借书" style="width:80px;height:30px;text-align:center;color: red;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_back.php"><input type="button" value="我要还书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_mine.php"><input type="button" value="我的图书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
		</div><br/><br/>
		
		<div style="flex-direction: row;align-items: center">
<!--<div style="flex-direction: row;display: flex;align-items: center">-->
			<center><form action="BookSearch/BookSearch.php"  method="get" enctype="multipart/form-data" style=" width: 1000px; text-align: center;">
			按书名搜索
			<input type="text" name="searchName" style="width:40%;height:25px;"/><span>&nbsp;&nbsp;</span>
			<input type="submit" value="确认" style="width:50px;height:25px;align-items: center;"/><br/><br/>
			</form></center>
		</div>



		<div id="pages">
		<div id="d1" style="margin-left:2%; float:left; display:inline;" >
			<h3>"我要借书"网站使用说明：</h3>
			<ol>
				<li>“我要分享”：点击进入分享上传页面，上传愿意出借图书的完整书名。</li><br/>
				<li>“我要借书”：点击进入借书查询页面，查询当前是否存在想借阅的图书。</li><br/>
				<li>“我要还书”：点击进入还书确认页面，归还完成后注销当前仍显示已借阅的图书。</li><br/>
				<li>“我的图书”：点击进入我的图书页面，查看当前上传、借阅、发出的请求，接收到的请求。</li><br/>
			</ol>
		</div>

		<div id="d2" style="margin-right:2%;float:right; display:inline;" >
			<fieldset>
			<legend><h3>热门图书</h3></legend>
<!--select bookname,count(*) from book group by bookname order by count(*) DESC -->
            <table style="background-color:#99bbbb;" border="1" align="center">
<?php   	
	 	$servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cdcol";

        // 创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检测连接
        if ($conn->connect_error) {
           die("数据库连接失败: " . $conn->connect_error . "<br>");
        } 
//    echo "数据库连接成功" . "<br>";
        mysqli_set_charset($conn,"utf8");
        
        $sql = "select bookname,count(*) from book group by bookname order by count(*) DESC" ;
        if(($result = $conn->query($sql)) == TRUE){
        	$count_leadr = -1;
        	$count = 0;
        	 while(($row = $result->fetch_assoc()) && $count_leadr < 7) {
        	 	$count_leadr++;
        	 	$count++;
        	 	
        	 	if(($count_leadr%4) == 0){
                echo <<<HTML
                <tr> 
HTML;
                }
//      	 	echo $row['bookname']. "<br>";
//      	 	echo $row['count(*)'];
                $sql = "SELECT * FROM `book` WHERE `bookname` = '{$row["bookname"]}' ";
                $result_pre = $conn->query($sql);
                $row_pre = $result_pre->fetch_assoc();
//              echo $row_pre['bookphoto'];
        	 	echo <<<HTML
                <td style="background-color:#ffff99;width:15px;text-align:center;"><b>$count</b></td>
				<td style="background-color:#EEEEEE;width:100px;text-align:center;"> 
				<img src= "/bookorder/upload/{$row_pre['bookphoto']}" height="150px" width="100px" /><br>
			    {$row["bookname"]}</td> 
HTML;
        	 }
        }
        else{
	    echo "创建数据表错误: " . $conn->error;
	    }

?>
	            </table>
			</fieldset>
		</div>
		</div>



		<div  align="center" style="position:fixed;bottom:3px;width:100%">
			<p>联系号码: 18818270804，邮箱:sjturjk@icloud.com ，设计制作：:荣岌昆，Copyright &copy; 2017-2017 sjtubookrent . All rights reserved.</p>
		</div>
	</body>
</html>


<?php 
}
?>