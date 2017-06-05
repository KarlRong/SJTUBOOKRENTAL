<?php
session_start();
$pnumber = $_SESSION['validate']['pnumber'];
$pass = $_SESSION['validate']['passwd'];
if(!$pnumber || !$pass){
			header('location:index.html');
}else{
?>
<?php
// 允许上传的图片后缀
/*************upload处理函数****************/
$uploadState = "";
        
function uploadPhoto(){
$GLOBALS['uploadState'] = "";
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["bookPhoto"]["name"]);
echo $_FILES["bookPhoto"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["bookPhoto"]["type"] == "image/gif")
|| ($_FILES["bookPhoto"]["type"] == "image/jpeg")
|| ($_FILES["bookPhoto"]["type"] == "image/jpg")
|| ($_FILES["bookPhoto"]["type"] == "image/pjpeg")
|| ($_FILES["bookPhoto"]["type"] == "image/x-png")
|| ($_FILES["bookPhoto"]["type"] == "image/png"))
&& ($_FILES["bookPhoto"]["size"] < 10004800)   // 小于 200 kb
&& in_array($extension, $allowedExts))
{
	if ($_FILES["bookPhoto"]["error"] > 0)
	{
		echo "错误：: " . $_FILES["bookPhoto"]["error"] . "<br>";
	}
	else
	{
//		echo "上传文件名: " . $_FILES["bookPhoto"]["name"] . "<br>";
//		echo "文件类型: " . $_FILES["bookPhoto"]["type"] . "<br>";
//		echo "文件大小: " . ($_FILES["bookPhoto"]["size"] / 1024) . " kB<br>";
//		echo "文件临时存储的位置: " . $_FILES["bookPhoto"]["tmp_name"] . "<br>";
		// 判断当期目录下的 upload 目录是否存在该文件
		// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        //数据库
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
//      echo "数据库连接成功" . "<br>";
        mysqli_set_charset($conn,"utf8");
        
        $_FILES["bookPhoto"]["name"] = $_SESSION['validate']['pnumber'] . "_" .$_FILES["bookPhoto"]["name"];
		if (file_exists("upload/" . $_FILES["bookPhoto"]["name"]))
		{
//			echo $_FILES["bookPhoto"]["name"] . " 文件已经存在。 ";
//          $_FILES["bookPhoto"]["name"] = $_SESSION['validate']['pnumber'] . $_FILES["bookPhoto"]["name"];
		}
		else
		{
			// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
			move_uploaded_file($_FILES["bookPhoto"]["tmp_name"], "upload/" . $_FILES["bookPhoto"]["name"]);
//			echo "文件存储在: " . "upload/" . $_FILES["bookPhoto"]["name"];
		}
		
		$sql = "INSERT INTO `book` (`id`, `bookname`, `bookphoto`, `ownerid`, `state`) 
        VALUES (NULL, '{$_POST["bookName"]}', '{$_FILES["bookPhoto"]["name"]}', '{$_SESSION['validate']['pnumber']}', '1');";
        
        if ($conn->query($sql) === TRUE) {
//       echo "新记录插入成功";
        } else {
         echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
        }
        
        $GLOBALS['uploadState'] = "图书分享成功";
        
		$conn->close();
	}
}
else
{
	$GLOBALS['uploadState'] = "非法的文件格式";
}
}

?>

<?php
//输入检查
function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
// 定义变量并默认设置为空值
    $nameErr = $photoErr = "";
    $bookName = $bookPhoto = "";
/*****************表单处理-必需字段-文件处理*********************/
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  	 if (empty($_POST["bookName"])) {
       $nameErr = "书名是必需的。";
     } else {
       $bookname = test_input($_POST["bookName"]);
     }
   
    if (empty($_FILES["bookPhoto"]["name"])) {
       $photoErr = "图片是必需的。";
     } 
    if ( !( $nameErr || $photoErr ))
    {
    	uploadPhoto();
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>我要分享</title>
		<style type="text/css">
		#pages {width:100%;margin:auto;}
		#d1 {width:40%;float:left;}
		#d2 {width:40%;float:left;}

		</style>


	</head>
	<body style="width:100%;margin:0px auto;">
		<div style="position:fixed; width:100%; height:100%; z-index:-1">
			<img src="images/33.jpg" height="100%" width="100%" />
		</div>
    	<h1 style="text-align:center;">交大图书共享--我要分享</h1><br/>

		<div  align="center">
			账号：<?php echo $pnumber; ?><span>&nbsp;&nbsp;</span><a href="logout.php">退出</a><br/><br/><br/>
		</div>

		<div align="center">
			<a href="book_share.php"><input type="button" value="我要分享" style="width:80px;height:30px;text-align:center;color: red;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_borrow.php"><input type="button" value="我要借书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>

			<a href="book_back.php"><input type="button" value="我要还书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
			<a href="book_mine.php"><input type="button" value="我的图书" style="width:80px;height:30px;text-align:center;"/></a><span>&nbsp;&nbsp;</span>
		</div><br/><br/><br/><br/>
		

		<div id="pages">
			<div id="d1" style="margin-left:2%; float:left; display:inline;" >
				<h3>"我要分享"网站使用说明：</h3>
				<ol>
					<li>“完整书名”：在相应的提示框，输入完整书名，便于他人准确查询。</li><br/>
					<li>“封面图片”：在相应的提示框，提交相应封面图片，便于他人查阅</li><br/>
					<li>“确定上传”：确认完整书名和封面无误后，点击确认上传按钮。</li><br/>
				</ol>
			</div>

			<div id="d2" style="margin-right:2%;float:right; display:inline;" >
				<fieldset>
				<legend><h3>分享图书信息上传</h3></legend>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post" enctype="multipart/form-data">
					<div id="bookName" style="flex-direction: row;display: flex;align-items: center">
						<p style="text-align:right">完整书名</p><input type="text" name = "bookName"style="width:80%;height:25px;"/> 
					    <span class="error" style="color: #FF0000;">* <?php echo $nameErr;?></span>
					</div>

					<div id="bookPhoto" style="flex-direction: row;display: flex;align-items: center">				
						<p style="text-align:right">封面图片</p><input type="file" name="bookPhoto"style="width:80%;height:25px;"/>
					    <span class="error" style="color: #FF0000;">* <?php echo $photoErr;?></span>
					</div>
					<div  align="center">
					<input type="submit" value="确认上传" style="width:80px;height:40px;align-items: center;"/>
					<span class="error" style="color: #FF0000;">* <?php echo $uploadState;?></span>
					<!-- 和数据库交互 -->
					</form>
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