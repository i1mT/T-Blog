<?php 
try{
	$servername = "localhost";
	$username = "iimt";
	$password = "ATyangguang"
	$dbname = "t-blog";
	$conn = new mysqli("localhost", "iimt", "ATyangguang", "t-blog");
	$conn->set_charset("utf8");
}catch(Exception $e) {
	echo "Msg:" . $e->getMessage();
}
?>