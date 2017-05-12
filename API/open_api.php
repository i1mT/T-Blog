<?php 
include_once "function.php";

$t = new T_function();

$method = $_GET["method"];

switch ($method) {
	case 'login':
		$username = $_GET["username"];
		$password = $_GET["password"];
		$res = $t->login($username,$password);
		if($res) echo "true";
		else echo "false";
		break;
    case 'logout':
        $t->logout();
        echo "true";
        break;
	default:
		break;
}


?>