<?php
session_start();
$pnumber = $_SESSION['validate']['pnumber'];
$pass = $_SESSION['validate']['passwd'];
if(!$pnumber || !$pass){
			header('\bookorder\index.html');
		}else{
?>

<!DOCTYPE html PUBLIC>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>我要借书</title>
</head>
<body>
<div style="position:fixed; width:100%; height:100%; z-index:-1">
			<img src="Mao7.jpg" height="100%" width="100%" />
		     </div>

				<br/><h1 style="text-align: center;">交大图书共享--我要借书</h1><br>
				<div  align="center">
				账号：<?php echo $pnumber; ?><span>&nbsp;&nbsp;</span><a href="logout.php">退出</a><br/><br/><br/>
				<center><a href="../book_borrow.php">返回</a></center>
				</div>

				<table style="background-color:#99bbbb;" border="1" align="center">

				<tr>
				<td colspan="5" style="background-color:#99bbbb;"> 
				<h2 style="text-align: center;">搜索结果</h2> 
			    </td> 
                </tr>


                <tr valign="center"> 
                <td style="background-color:#ffff99;width:30px;text-align:center;"><b>序号</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>书籍</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>书主</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>书籍状态</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>操作</b></td>
				</tr> 

                <!--<tr valign="center"> 
                <td style="background-color:#ffff99;width:30px;text-align:center;"><b>1</b></td>
				<td style="background-color:#EEEEEE;width:200px;text-align:center;"> 
				<img src="plkb.jpg" height="300px" width="200px" /><br>
			    《C#高级编程》</td> 
				<td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;"> <input type="text" id="field1" value="可以借阅" style="border:none;height:30px;width:100px;font-size:20px;background-color:#EEEEEE;"><br></td> 
				<td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;">
				<input type="button" onclick="changeText()" id="button1" style="height:30px;width:100px;text-align:center;font-size:20px;" value="查看详细"></button> </td>
				</tr> -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
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
        
        $sql = "UPDATE `book` SET `borrowerid`={$_SESSION['validate']['pnumber']}
        WHERE `id` = {$_POST["bookid"]} ";
        if($conn->query($sql) == TRUE){
        }
        else{
	    echo "创建数据表错误: " . $conn->error;
	    }
        $sql = "SELECT * FROM `book` WHERE `id` = {$_POST["bookid"]} ";
        if($conn->query($sql) == TRUE){
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
//$statusStr = array(
//"0" => "短信发送成功",
//"-1" => "参数不全",
//"-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
//"30" => "密码错误",
//"40" => "账号不存在",
//"41" => "余额不足",
//"42" => "帐户已过期",
//"43" => "IP地址限制",
//"50" => "内容含有敏感词"
//);
$smsapi = "http://api.smsbao.com/";
$user = "sjturjk"; //短信平台帐号
$pass = md5("ss940425"); //短信平台密码
$content="[交大借书]用户  {$_SESSION['validate']['pnumber']} 向您发出借阅 《{$row["bookname"]}》的请求，请登录交大借书网站查看";//要发送的短信内容
$phone = "{$row["ownerid"]}";//要发送短信的手机号码
$sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
//$result =
file_get_contents($sendurl) ;
//echo $statusStr[$result];
	echo <<<HTML
	            <tr>
				<td colspan="5" style="background-color:#EEEEEE;"> 
				<pre>
					
<h2>已通过系统短信向书主 {$row["ownerid"]} 发送了借阅 《{$row["bookname"]}》 的请求</h2>
</pre>
				<a href="../book_borrow.php">继续</a></center>
			    </td> 
                </tr>
HTML;
         }
}
else{
	echo "创建数据表错误: " . $conn->error;
	}
}
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
  	 if (empty($_GET["searchName"])) {
       header('location:BookSearch-notfound.php');
    }
    else{
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
        
        $sql = "SELECT * FROM `book` WHERE `bookname` LIKE '%{$_GET["searchName"]}%' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
    // 输出数据
    $count = 0;
    while($row = $result->fetch_assoc()) {
    	$count ++;
        echo	<<< HTML
        	    <tr valign="center"> 
                <td style="background-color:#ffff99;width:30px;text-align:center;"><b>$count</b></td>
				<td style="background-color:#EEEEEE;width:200px;text-align:center;"> 
				<img src= "../upload/{$row["bookphoto"]}" height="300px" width="200px" /><br>
			    {$row["bookname"]}</td> 
			    <td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;"> <input type="text" value="{$row["ownerid"]}" style="border:none;height:30px;width:130px;font-size:20px;background-color:#EEEEEE;"><br></td>

HTML;
        if( $row["state"] == 1 && $row["borrowerid"] == NULL){
            echo	<<< HTML
                 <td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;"> <input type="text" id="{$row["id"]}"."txt" value="可以借阅" style="border:none;height:30px;width:100px;font-size:20px;background-color:#EEEEEE;"><br></td> 
				<td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;">
				<form method="post" action="{$_SERVER["PHP_SELF"]}"> 
				<input type="hidden" name="bookid"  value="{$row["id"]}">
				<input type="submit" name="button" style="height:30px;width:100px;text-align:center;font-size:20px;" value="联系书主"></button> </td>
				</form>
				</tr> 
HTML;
        } else {
            echo	<<< HTML
                 <td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;"> <input type="text" id="field1" value="已借出" style="border:none;height:30px;width:100px;font-size:20px;background-color:#EEEEEE;"><br></td> 
				<td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;">
				<input type="button" disabled="disabled" onclick="changeText()" id="{$row["bookphoto"]}" style="height:30px;width:100px;text-align:center;font-size:20px;" value="联系书主"></button> </td>
				</tr> 
HTML;
        }
    }
  } else {
         header('location:BookSearch-notfound.php');
  }
      $conn->close();
  }
}
 
?>




				</table>              

</body>
</html>
<?php
		}
?>