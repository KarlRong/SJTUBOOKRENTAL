<?php 
header('Content-Type: text/xml');
header("cache-control:no-cache,must-revalidate");
$xml="<?xml version='1.0' encoding='utf8'?>";
$xml=$xml."<response>";
$name = $_POST["pnumbers"];


$link = mysqli_connect('127.0.0.1','root','','cdcol');

$query = "SELECT*FROM user where pnumber=$name;";
$result = mysqli_query($link, $query);

$content="";
$title="";
while($row = mysqli_fetch_assoc($result)){
    $number=$row['pnumber'];
	$content=$content."<name>".$number."</name>";
}
$xml=$xml.$content."</response>";
echo $xml;

mysqli_free_result($result);


mysqli_close($link);
?>