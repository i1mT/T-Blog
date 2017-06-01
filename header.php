<?php
//判断是否已经配置好  如果没配置好跳转到安装页面
$json = file_get_contents("install_info.json");
$_INFO = json_decode($json);
if($_INFO->install_status == 0){
    //echo "<script>alert(". $_INFO .");</script>";
    header("Location: install.php");
    $_INFO->install_status = 1;
    file_put_contents("install_info.json", json_encode($_INFO));
    exit;
}
include 'API/function.php';
$page_art_num = 8;//每页8篇博文
$articles = array();//要在页面中循环输出的数组
$func = new T_function();

//首页，获取第一页
if(!count($_GET)){
    $page = 1;
    $articles = $func->getArticle();
}
//指定页
if(@$_GET['page']&& @!$_GET['cate']){
    $page = $_GET['page'];
    $articles = $func->getArticle($page);
}
//所有该分类下的文章
if(@$_GET['cate']){
    $cate = $_GET['cate'];
    if(@$_GET['page']){
        //指定分类下的页
        $page = $_GET['page'];
        $articles = $func->getArticle($page,$cate);
    }else{
        $page = 1;
        $articles = $func->getArticle(1,$cate);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="asset/main.css">
    <script src="asset/jquery-3.1.1.min.js"></script>
    <script src="asset/HyperDown.js/Parser.js"></script>
    <script src="asset/iconfont.js"></script>
    <script src="asset/index.js"></script>
    <title><?php $func->bloginfo("name"); ?></title>
</head>
<body>
<nav class="banner-mask">
	<div class="container header">
		<!-- 左上角图片 -->
<!--		<div class="avatar">
			<a href="#"><img src="asset/images/avatar.jpg"></a>
		</div>-->
        <p class="blogname"><a href="#">Hope in the things unseen.</a></p>
        <p class="motto">对 未 知 充 满 期 待</p>
		<!-- 个人信息 -->
		<div class="myinfo">
			<!-- 头像 -->
			<div class="avatar">
				<img src="asset/images/avatar.jpg">
			</div>
		</div>
        <ul class="desc-tab">
            <li class="li-f">大学生</li>
            <li>浙江 · 绍兴</li>
            <li>JSer</li>
            <li class="li-e">可能是一只吃货</li>
        </ul>
	</div>
</nav>