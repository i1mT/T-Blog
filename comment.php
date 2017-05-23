<form class="comment">
    <div class="name">
        <span>昵称：</span>
        <input name="name" type="text">
    </div>
    <div class="email">
        <span>邮箱：</span>
        <input name="email" type="email">
    </div>
    <div class="site">
        <span>个人站点：</span>
        <input name="site" type="url">
    </div>
    <textarea name="content" placeholder="输入评论内容......"></textarea>
    <button type="submit" aid="<?php echo $art_id; ?>">提交评论</button>
</form>
<?php $comments = $func->getArticleCommentArr($art_id);
?>
<ul class="comment-list">
    <div class="count">
        <span>
            共<?php echo count($comments); ?>个评论
        </span>
    </div>
    <?php for($i = 0; $i < count($comments); $i++){ ?>
    <li>
        <a href="<?php echo $comments[$i]['site']; ?>">
            <?php echo $comments[$i]['name']; ?>：
        </a>
        <p class="comment-con">
            <?php echo $comments[$i]['content']; ?>
        </p>
        <span class="time">
            <?php echo $comments[$i]['commenttime']; ?>
        </span>
        <span class="comment-like" aid="<?php echo $comments[$i]['id']; ?>">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-jushoucang"></use>
            </svg>
            <span class="num">
                <?php echo $comments[$i]['likes']; ?>
            </span>
        </span>
    </li>
    <?php } ?>
</ul>