<?php
session_start();
$pnumber = $_SESSION['validate']['pnumber'];
$pass = $_SESSION['validate']['passwd'];
if(!$pnumber || !$pass){
			header('\bookorder\index.html');
		}else{
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>本人上传图书</title>
	</head>
	
	<body >
		<div style="position:fixed; width:100%; height:100%; z-index:-1"><img src="Mao7.jpg" height="100%" width="100%" /></div><br/>
		<h1 style="text-align: center;">本人上传图书</h1><br>
		<div  align="center">
			账号：<?php echo $pnumber; ?><span>&nbsp;&nbsp;</span><a href="logout.php">退出</a><br/><br/><br/>
		</div>

		<table style="background-color:#99bbbb;" border="1" align="center">
			<tr>
				<td colspan="5" style="background-color:#99bbbb;">
					<h2 style="text-align: center;">本人上传图书列表</h2>
				</td>
			</tr>

			<tr valign="center">
				<td style="background-color:#ffff99;width:30px;text-align:center;"><b>序号</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>书籍</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>书主</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>书籍状态</b></td> 
				<td style="background-color:#EEEEEE;height:20px;width:200px;text-align:center;"><b>操作</b></td>
			</tr>

				
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
        
        $sql = "SELECT * FROM `book` WHERE `id` = {$_POST["bookid"]} ";
        if($conn->query($sql) == TRUE){
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
	echo <<<HTML
	            <tr>
				<td colspan="5" style="background-color:#EEEEEE;"> 
				<pre>
					
<h2>书籍 《{$row["bookname"]}》 已下架</h2>
</pre>
				<a href="./book_myown.php">继续</a></center>
			    </td> 
                </tr>
HTML;
         }
         
        $sql = "DELETE FROM `book` WHERE `id` = {$_POST["bookid"]} ";
        if($conn->query($sql) == TRUE){
        }
        else{
	    echo "创建数据表错误: " . $conn->error;
	    }
}
else{
	echo "创建数据表错误: " . $conn->error;
	}
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
        
        $sql = "SELECT * FROM `book` WHERE `ownerid` = '{$_SESSION['validate']['pnumber']}' ";
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
			    <td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;"> <input type="text" id="field1" value="{$row["ownerid"]}" style="border:none;height:30px;width:130px;font-size:20px;background-color:#EEEEEE;"><br></td>

HTML;
        if( $row["state"] == 1){
            echo	<<< HTML
                 <td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;"> <input type="text" id="field1" value="在架上" style="border:none;height:30px;width:100px;font-size:20px;background-color:#EEEEEE;"><br></td> 
				<td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;">
				<form method="post" action="{$_SERVER["PHP_SELF"]}"> 
				<input type="hidden" name="bookid"  value="{$row["id"]}">
				<input type="submit" name="button" style="height:30px;width:100px;text-align:center;font-size:20px;" value="下架"></button> </td>
				</form>
				</tr> 
HTML;
        } else {
            echo	<<< HTML
                 <td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;"> <input type="text" id="field1" value="已借出" style="border:none;height:30px;width:100px;font-size:20px;background-color:#EEEEEE;"><br></td> 
				<td style="background-color:#EEEEEE;height:100px;width:200px;text-align:center;">
				<input type="button" disabled="disabled" onclick="changeText()" id="button1" style="height:30px;width:100px;text-align:center;font-size:20px;" value="下架"></button> </td>
				</tr> 
HTML;
        }
    }
  }
else{
	 	    echo	<<< HTML
	 	    	<tr>
				<td colspan="5" style="background-color:#EEEEEE;"> 
				您尚未上传图书
			    </td> 
                </tr>
HTML;
}
}
?>
		</table>				
	</body>
</html>
<?php
		}
?>