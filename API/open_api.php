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
    case 'updateArticle':
        $article = $_GET["article"];
        $res = $t->updateArticle($article);
        if ($res) echo "true";
        else echo "false";
        break;
    case 'uploadMD':
        //上传md格式文件，并返回内容
        break;
    case 'readMD':
        $path = $_GET["path"];
        $con = file_get_contents($path);
        $con = iconv("gb2312","utf-8",$con);
        echo $con;
	default:
		break;
}


?>