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
    case 'readMD':
        $path = $_GET["path"];
        $con = file_get_contents($path);
        $con = iconv("gb2312","utf-8",$con);
        echo $con;
        break;
    case 'deleteArticle':
        $id = $_GET["id"];
        $res = $t->deleteArticle($id);
        if ($res) echo "true";
        else echo "false";
        break;
    case 'searchArticle':
        $key = $_GET["key"];
        $res = $t->searchArticle($key);
        echo $res;
        break;
    case 'searchByCate':
        $cate = $_GET["val"];
        $res = $t->searchByCate($cate);
        if($res == -1){
            echo "nocate";
            break;
        }
        $res = urldecode(json_encode($res));
        echo $res;
        break;
    case 'showArticleAll':
        $res = $t->getAllArticle();
        echo $res;
        break;
    case 'showArticleComment':
        $id = $_GET["id"];
        $res = $t->getArticleComment($id);
        echo $res;
        break;
    case 'deleteComment':
        $id = $_GET["id"];
        $res = $t->deleteComment($id);
        if($res)
            echo "true";
        else
            echo "false";
        break;
    case 'showComment':
        $res = $t->getCommentAll();
        echo $res;
        break;
    case 'raiseArticleLikes':
        $id = $_GET['id'];
        $res = $t->raiseArticleLikes($id);
        if($res) echo "true";
        else echo "false";
        break;
    case 'creaseCommentLike':
        $id = $_GET['id'];
        $res = $t->addCommentLike($id);
        if($res) echo "true";
        else echo "false";
        break;
    case 'addComment':
        $res = $t->addComment($_GET);
        if($res) echo "true";
        else echo "false";
        break;
    default:
        break;
}


?>