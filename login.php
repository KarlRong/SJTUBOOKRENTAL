<?php

$pnumber = $_POST['number'];
$pass = $_POST['pass'];

$_mysqli = new mysqli();
@$_mysqli->connect('localhost','root','','cdcol');
$_mysqli->set_charset('utf8');
$_sql = "SELECT*FROM user where pnumber=$pnumber;";
$_result = $_mysqli->query($_sql);

if(!!$_row = $_result->fetch_row()){
	if($_row[2] != md5($pass)){
		header('location:index.html');
		} else{
		session_start();
		$_SESSION['validate']= array(
		'pnumber' => $_row[1],
		'passwd' => $_row[2],
		);
		$_result->free();
		$_mysqli->close();
		header('location:book_borrow.php');
	}

}else{
	$_result->free();
	$_mysqli->close();
	header('location:index.html');
}









?>