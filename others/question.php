<?php 
header("Content-Type: text/html; charset=UTF-8");

if(@count($_GET) <= 0){
	echo "没有参数";
	die;
}

$valCnt = 0;
$resp = "";
if($_GET["username"] != null && strlen($_GET["username"]) > 0) {
	$resp .= "用户名：". $_GET["username"] ." <br />";
	$valCnt++;
}
if($_GET["userpwd"] != null && strlen($_GET["userpwd"]) > 0) {
	$resp .= "密码：". $_GET["userpwd"] ." <br />";
	$valCnt++;
}
if($_GET["nickname"] != null && strlen($_GET["nickname"]) > 0) {
	$resp .= "QQ昵称n：". $_GET["nickname"] ." <br />";
	$valCnt++;
}
if($_GET["gender"] != null && strlen($_GET["gender"]) > 0) {
	$resp .= "性别：". $_GET["gender"] ."。  服务端读取的是radio中value值 <br />";
	$valCnt++;
}
if($_GET["major"] != null && strlen($_GET["major"]) > 0) {
	$resp .= "专业：". $_GET["major"] ."。  服务端读取的是select中option的value值  <br />";
	$valCnt++;
}
if($_GET["hobby"] != null && count($_GET["hobby"]) > 0) {
	$s = "";
	for ($i=0; $i < count($_GET["hobby"]); $i++)
		$s .= $_GET["hobby"][$i] . ",";

	$resp .= "兴趣：". $s ."。  服务端读取的是checkbox中value值  <br />";
	$valCnt++;
}
if($_GET["intro"] != null && strlen($_GET["intro"]) > 0) {
	$resp .= "简介：". $_GET["intro"] ." <br />";
	$valCnt++;
}

$resp .= "<br /><br />";

if($valCnt < 7)
	$resp .= "<em style='color:red;'>Wrong Error！</em>&nbsp;&nbsp;未能能读取到表单全部数据，请修改后重新提交。";
else
	$resp .= "<em style='color:green;'>Accepted！</em>";

echo $resp;

 ?>