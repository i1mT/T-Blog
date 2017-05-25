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
        console.log(src);
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
        })
    })
    /*
    * 发布评论
    */
    $('.comment button').click(function (e) {
        e.preventDefault();
        var src = $(this);
        var url = "API/open_api.php";
        var id = src.attr('aid');
        var name = $(".comment input[name='name']").val();
        var email = $(".comment input[name='email']").val();
        var site = $(".comment input[name='site']").val();
        var content = $(".comment textarea").val();
        var date = new Date();
        var time = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate() + ' ';
        time  +=  date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
        console.log(time);
        var data = {
            method : "addComment",
            id : id,
            name : name,
            email : email,
            site : site,
            content : content
        };
        $.ajax({
            url : url,
            type : "GET",
            data : data,
            async : false,
            success : function (data) {
                console.log(data);
                if(data == "true"){
                    console.log("评论成功");
                    $(".comment input").val('');
                    $(".comment textarea").val('');
                    var temp = '<li>'+
                        '<a href="'+ site +'" target="_blank">'+ name + '：</a>'+
                    '<p class="comment-con">'+ content + '</p>'+
                    '<span class="time">' + time +
                    '</span>'+
                    '<span class="comment-like" aid="">'+
                        '<svg class="icon" aria-hidden="true">'+
                        '<use xlink:href="#icon-jushoucang"></use>'+
                        '</svg>'+
                       ' <span class="num">'+
                '</span>'+
                    '</span>'+
                    '</li>';
                    $('.count').after(temp);
                }
            }
        })
        
    })
}