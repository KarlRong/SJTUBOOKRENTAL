<?php
$pnumber = $_POST['rnumber'];
$pass = $_POST['rpass'];
$_mysqli = new mysqli();
@$_mysqli->connect('localhost','root','','cdcol');
$_mysqli->set_charset('utf8');
$_sql = "SELECT*FROM user where pnumber=$pnumber;";
$_result = $_mysqli->query($_sql);
if(!!$_row = $_result->fetch_row()){
	$_result->free();
	$_mysqli->close();
	echo '注册失败!';
	exit();
}else{
	$_sqli = "INSERT INTO user (pnumber,password) VALUES ('".$pnumber."','".md5($pass)."')";
	$_mysqli->query($_sqli);
	$_result->free();
	$_mysqli->close();
	header('location:welcom.html');
}


?>