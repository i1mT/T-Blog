<?php include "header.php"; ?>

<?php for($i = 0; $i < count($articles); $i++){ ?>
<div class="container article-list">
    <div class="art-card-container" style="background: ;background-size: cover;">
        <img class="art-cover" src="<?php echo $articles[$i]->cover; ?>">
        <div class="art-info">
            <p class="art-title">
                <a href="<?php
                        if (@$cate) echo "article.php?id=".$articles[$i]['id'];
                        else echo "article.php?id=".$articles[$i]->id;
                    ?>
                ">
                    <?php
                        if (@$cate) echo $articles[$i]['title'];
                        else echo $articles[$i]->title;
                    ?>
                </a>
            </p>
            <div class="art-info-detail">
                <span class="art-viewed">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-jushoucang"></use>
                </svg>
                    <?php
                        if (@$cate) echo $articles[$i]['likes'];
                        else echo $articles[$i]->likes;
                    ?>
            </span>
                <span class="art-likes">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-yanjing"></use>
                </svg>
                    <?php
                        if (@$cate) echo $articles[$i]['viewed'];
                        else echo $articles[$i]->viewed;
                    ?>
            </span>
                <span class="art-time">
                    <?php
                        $lastEdit = @$cate? $articles[$i]['lastEdit']:$articles[$i]->lastEdit;
                        $lastEdit = substr($lastEdit,0,strlen($lastEdit)-9);
                        echo $lastEdit;
                    ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!------------ 分页 ---------------->
<div class="container">
<?php
if(@$cate){
    $cate = "&cate=$cate";
    $countArt = $func->getArticleNum($cate);
}else{
    $cate = "";
    $countArt = $func->getArticleNum();
}
if($page == 1 && $countArt<=$page_art_num*$page){
    //只有一页
    $templete = '<ul class="div-page">';
    $templete .= '<li>None</li>';
    $templete .= '</ul>';
}else if($page == 1 && $countArt>$page_art_num*$page){
    //第一页  还有下一页
    $templete = '<ul class="div-page">';
    $templete .= '<li><a href="?page='. ($page+1) . $cate .'">Older post</a></li>';
    $templete .= '</ul>';
} else if($page>1 && $countArt<=$page_art_num*$page){
    //最后一页  显示前一页
    $templete = '<ul class="div-page">';
    $templete .= '<li><a href="?page='. ($page-1) . $cate .'">Pre post</a></li>';
    $templete .= '</ul>';
}else{
    //中间一页  显示前后
    $templete = '<ul class="div-page">';
    $templete .= '<li><a href="?page='. ($page-1) . $cate .'">Pre post</a></li>';
    $templete .= '<li><a href="?page='. ($page+1) . $cate .'">Older post</a></li>';
    $templete .= '</ul>';
}
echo $templete;
?>
</div>
<!-- 小火箭 -->
<div class="fly-to-top" style="display: none;">
    <svg class="icon" aria-hidden="true">
        <use xlink:href="#icon-xiangshangjiantou"></use>
    </svg>
</div>
<?php include "footer.php"; ?>