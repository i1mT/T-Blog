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
    case 'setBlogname':
        $blogname = $_GET["blogname"];
        $res = $t->setBlogname($blogname);
        if ($res) echo "true";
        else echo "false";
        break;
    case 'setBlogdesc':
        $blogdesc = $_GET["blogdesc"];
        $res = $t->setBlogdesc($blogdesc);
        if ($res) echo "true";
        else echo "false";
        break;
    case 'setBlogurl':
        $blogurl = $_GET["blogurl"];
        $res = $t->setBlogurl($blogurl);
        if ($res) echo "true";
        else echo "false";
        break;
    case 'publishArticle':
        $article = $_GET["article"];
        $res = $t->publishArticle($article);
        if ($res) echo "true";
        else echo "false";
        break;
	default:
		break;
}


?>