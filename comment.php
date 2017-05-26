<form class="comment">
    <div class="name">
        <span>昵称：</span>
        <input name="name" type="text" placeholder="你的名字">
    </div>
    <div class="email">
        <span>邮箱：</span>
        <input name="email" type="email" placeholder="留个邮箱">
    </div>
    <div class="site">
        <span>个人站点：</span>
        <input name="site" type="text" placeholder="不需要输入http://">
    </div>
    <textarea name="content" placeholder="你也有独到的见解和想法......"></textarea>
   <button aid="<?php echo $art_id; ?>">提交评论</button>
    <span class="status"></span>
</form>
<?php $comments = $func->getArticleCommentArr($art_id);
?>
<ul class="comment-list">
    <div class="count">
        <span>
            共<?php echo count($comments); ?>个评论
        </span>
    </div>
    <?php for($i = count($comments)-1; $i >=0 ; $i--){ ?>
    <li>
        <a href="<?php echo $comments[$i]['site']; ?> " target="_blank">
            <?php echo $comments[$i]['name']; ?>：
        </a>
        <p class="comment-con">
            <?php
                $this_con = strip_tags($comments[$i]['content']);
                echo $this_con;
            ?>
        </p>
        <span class="time">
            <?php echo $comments[$i]['commenttime']; ?>
        </span>
        <span class="comment-like" cid="<?php echo $comments[$i]['id']; ?>">
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