<?php 
header("Content-Type: text/html; charset=UTF-8");

if(@count($_POST) <= 0){
	echo "没有参数";
	die;
}
$valCnt = 0;
$resp = "";
if($_POST["username"]!= null && strlen($_POST["username"]) > 0) {
	$resp .= "用户名:" . $_POST["username"] . "<br />";
	$valCnt++;
}
if($_POST["userpwd"]!= null && strlen($_POST["userpwd"]) > 0) {
	$resp .= "密码:" . $_POST["userpwd"] . "<br />";
	$valCnt++;
}
if($_POST["userpwd2"]!= null && strlen($_POST["userpwd2"]) > 0) {
	$resp .= "确认密码:" . $_POST["userpwd2"] . "<br />";
	$valCnt++;
}
if($_POST["gender"]!= null && strlen($_POST["gender"]) > 0) {
	$resp .= "性别:" . $_POST["gender"] . "<br />";
	$valCnt++;
}
if($_POST["email"]!= null && strlen($_POST["email"]) > 0) {
	$resp .= "电子邮件:" . $_POST["email"] . "<br />";
	$valCnt++;
}
$resp .= "<br /><br />";
if($valCnt < 5)
	$resp .= "<em style='color:red;'>Wrong Error！</em>&nbsp;&nbsp;未能能读取到表单全部数据，请修改后重新提交。";
else
	$resp .= "<em style='color:green;'>Accepted！</em>";

echo $resp;


?>