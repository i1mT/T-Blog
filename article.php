<?php
include "API/function.php";
$art_id = $_GET['id'];
$func = new T_function();
$article = $func->getArticleById($art_id);
$func->addArticleViewed($art_id);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="asset/main.css">
    <link rel="stylesheet" href="asset/markdown.css">
    <script src="asset/jquery-3.1.1.min.js"></script>
    <script src="asset/iconfont.js"></script>
    <script src="asset/HyperDown.js/Parser.js"></script>
    <title><?php echo $article['title']; ?></title>
</head>
<body>
<!--页头区域-->
<nav class="article-nav banner-mask" style='background-image: url("<?php echo $article["cover"]; ?>")'>
    <div class="container">
        <div class="home">
            <a href="<?php $func->bloginfo("siteurl"); ?>">
                <img src="asset/images/tesla.png">
            </a>
        </div>
        <div class="titles">
            <p class="title">
                <?php
                    echo $article['title'];
                ?>
            </p>
            <p class="detail">
                <!--<span class="cate">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-tag"></use>
                    </svg>
                    <a href="#">
                        <?php /*echo $article['cate']; */?>
                    </a>
                </span>-->
                <span class="time">
                    <?php echo substr($article['lastEdit'],0,strlen($article['lastEdit'])-9); ?>
                </span>
            </p>
        </div>
    </div>
</nav>
<div class="container">
    <!--  正文区域    -->
    <article class="markdown-body">
        <?php
            echo htmlspecialchars($article['content'],ENT_QUOTES);
        ?>
    </article>
    <!--社交-打赏等内容-->
    <div class="like" id="<?php echo $_GET['id']; ?>">
        <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-jushoucang"></use>
        </svg>
        <span class="text">喜欢</span>
        <span class="num"><?php echo $article['likes']; ?></span>
    </div>
    <div class="admired">赏</div>
    <img src="asset/images/admired-weixin.png" class="admire">
    <p class="admired-tips"><em>如果这篇文章对你有帮助，欢迎你对我打赏</em></p>
    <!-- 个人介绍 -->
    <div class="aboutme">
        <img src="asset/images/avatar.jpg" class="avatar">
        <p class="name">iimT</p>
        <p class="motto">大一计科狗，喜欢音乐、运动、编程、摄影，人生最大的快感来自于创造。目前致力于前端开发方向，坐标浙江绍兴，很乐意你与我交流。</p>
        <div class="social">
            <a href="http://weibo.com/ATmxj" target="_blank"><svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-iconfontweibowukuang"></use>
            </svg></a>
            <a href="https://github.com/tfh93121" target="_blank"><svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-github"></use>
            </svg></a>
            <a href="https://www.zhihu.com/people/tao-feng-hua" target="_blank"><svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-zhihu"></use>
            </svg></a>
            <a href="http://space.bilibili.com/69824765#!/" target="_blank"><svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-bilibili"></use>
            </svg></a>
        </div>
    </div>
    <!-- 上一篇 下一篇-->
    <ul class="reletive">

    </ul>
    <!-- 评论  -->
    <?php
        include "comment.php";
    ?>
</div>

<!-- 小火箭 -->
<div class="fly-to-top" style="display: none;">
    <svg class="icon" aria-hidden="true">
        <use xlink:href="#icon-xiangshangjiantou"></use>
    </svg>
</div>
<!-- 页脚 -->
<?php include "footer.php"; ?>
<script src="asset/article.js"></script>
<script src="asset/xss.js"></script>
<script>
$(document).ready(function () {
    $codes = $("code")
    $codes.each(function () {
        var code = $(this).html()
        code = code.replace(/&amp;lt;/g, "<")
        code = code.replace(/&amp;gt;/g, ">")
        var result = filterXSS(code)
        $(this).text(code)
    })
})
    
</script>
</body>
</html>
