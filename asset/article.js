$(document).ready(function () {
    init();
});


function init() {
    console.log("文章页");
    //将MD内容转换为html
    var parser = new HyperDown;
    var article_con = $('article').html().trim();
    var html = parser.makeHtml(article_con);
    $('article').html(html);
    /*
    * 喜欢按钮被点击之后  文章喜欢数+1
    */
    $('.like').click(function () {
        var url = "API/open_api.php";
        var id = $('.like').attr('id');
        var data = {
            method : "raiseArticleLikes",
            id : id
        }
        $.ajax({
            url : url,
            type : "GET",
            data : data,
            async : false,
            success : function (data) {
                if(data == "true"){
                    console.log("喜欢成功。");
                    $('.like').css({
                        'color' : '#fff',
                        'background' : '#ea6f5a'
                    })
                    var num = $('.like .num').html();
                    num = parseInt(num);
                    $('.like .num').html(num+1);
                }
            }
        })
    })
    /*
    * 评论喜欢按钮被点击之后
    */
    $('.comment-like').click(function (e) {
        var src = $(this);
        var url = "API/open_api.php";
        var id = src.attr('aid');
        var data = {
            method : "creaseCommentLike",
            id : id
        }
        $.ajax({
            url : url,
            type : "GET",
            data : data,
            async : false,
            success : function (data){
                    console.log("评论喜欢成功");
                    src.find('svg').html('<use xlink:href="#icon-jushoucanggift"></use>');
                    var num = parseInt(src.find('.num').html().trim());
                    src.find('.num').html(num+1);
                }
            }
        })
    })
}