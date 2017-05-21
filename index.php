<?php include "header.php"; ?>

<?php for($i = 0; $i < count($articles); $i++){ ?>
<div class="container article-list">
    <div class="art-card-container" style="background: ;background-size: cover;">
        <img class="art-cover" src="<?php echo $articles[$i]->cover; ?>">
        <div class="art-info">
            <p class="art-title">
                <a href="#">
                    <?php echo $articles[$i]->title; ?>
                </a>
            </p>
            <div class="art-info-detail">
                <span class="art-viewed">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-jushoucang"></use>
                </svg>
                    <?php echo $articles[$i]->likes; ?>
            </span>
                <span class="art-likes">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-yanjing"></use>
                </svg>
                    <?php echo $articles[$i]->viewed; ?>
            </span>
                <span class="art-time">
                    <?php echo $articles[$i]->lastEdit; ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!------------ 分页 ---------------->



<?php include "footer.php"; ?>