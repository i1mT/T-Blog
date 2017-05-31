<?php
/*$conn = new mysqli("127.0.0.1","test","1234");
$name = "ttt";
$create = "CREATE DATABASE `" . $name . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ";
$create_res = $conn->query($create);
var_dump($create_res);
$conn->selece_db($name);
$import = file_get_contents("blog.sql");
$res = $conn->query($import);
var_dump($res);*/
$database = "aaaa";
$conn=mysql_connect("127.0.0.1","test","1234");

mysql_query("source '".$file."';");
mysql_select_db($database);
?>
