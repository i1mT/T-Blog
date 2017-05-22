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
}