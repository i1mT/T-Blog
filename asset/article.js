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
    * 小火箭监听
    */
    $(window).scroll(function () {
        var h = $(window).scrollTop();
        //如果高度超过900px 就显示火箭头如果小于的话就隐藏
        if(h > 900){
            $('.fly-to-top').show();
        }else{
            $(".fly-to-top").hide();
        }    })
    //将首页的文章卡片宽高按照背景图片宽高进行调整

    //小火箭点击事件
    $('.fly-to-top').click(function (){
        var speed=300;//滑动的速度
        $('body,html').animate({ scrollTop: 0 }, speed);
    });
    /*
    * 喜欢按钮被点击之后  文章喜欢数+1 如果之前喜欢过，就喜欢数-1
    */
    $('.like').click(function () {
        var url = "API/open_api.php";
        var id = $('.like').attr('id');
        //如果之前喜欢过  就减少喜欢数
        if(hasLike('article',id)){
            var data = {
                method : "deraiseArticleLikes",
                id : id
            }
            $.ajax({
                url : url,
                type : "GET",
                data : data,
                async : false,
                success : function (data) {
                    console.log("减少喜欢成功。");
                    $('.like').css({
                        'color' : '#ea6f5a',
                        'background' : '#fff'
                    })
                    var num = $('.like .num').html();
                    num = parseInt(num);
                    $('.like .num').html(num-1);
                    //localStorage中记录此值
                    localStorage.article = localStorage.article.replace(id.toString(),'');
                    console.log(localStorage);
                }
            })
            return;
        }
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
                console.log("喜欢成功。");
                $('.like').css({
                    'color' : '#fff',
                    'background' : '#ea6f5a'
                })
                var num = $('.like .num').html();
                num = parseInt(num);
                $('.like .num').html(num+1);
                //localStorage中记录此值
                if(!localStorage.article){
                    localStorage.setItem('article', id);
                }else{
                    localStorage.setItem('article',localStorage.getItem('article') + ',' + id);
                }
            }
        })
    })
    /*
    * 评论喜欢按钮被点击之后 如果之前喜欢过，就喜欢数-1
    */
    $('.comment-like').click(function (e) {
        var src = $(this);
        var url = "API/open_api.php";
        var id = src.attr('cid');
        if(hasLike('comment',id)){
            var data = {
                method : "minusCommentLike",
                id : id
            }
            $.ajax({
                url : url,
                type : "GET",
                data : data,
                async : false,
                success : function (data) {
                    console.log("减少评论喜欢成功。");
                    src.find('svg').html('<use xlink:href="#icon-jushoucang"></use>');
                    var num = parseInt(src.find('.num').html().trim());
                    src.find('.num').html(num-1);
                    //localStorage中记录此值
                    localStorage.comment_like = localStorage.comment_like.replace(id.toString(),'');
                }
            })
            return;
        }
        var data = {
            method : "creaseCommentLike",
            id : id
        };
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
                if(!localStorage.comment_like){
                    localStorage.comment_like = id;
                }else{
                    localStorage.comment_like += ',' + id;
                }
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
        site = "http://" + site;
        var content = $(".comment textarea").val();
        if(!hasComment(id)){
            $('.comment .status').html('X 评论太频繁了～');
                    setTimeout(function (){
                        $('.comment .status').html('');
                    },3000);
            return;
        }
        if(!name || !email || !site || !content){
            //有为空的信息
            $('.comment .status').html('X 信息不全');
            setTimeout(function (){
                        $('.comment .status').html('');
                    },3000);
            return;
        }
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
                console.log("评论成功");
                $('.comment .status').html('√ 评论成功');
                setTimeout(function (){
                    $('.comment .status').html('');
                },3000);
                $(".comment input").val('');
                $(".comment textarea").val('');
                content = removeHTMLTag(content);
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
                //设置评论过的痕迹
                var comment = localStorage.comment;
                comment = JSON.parse(comment);
                //5分钟内同一篇文章只能发布一条评论
                var ms = date.getTime() + 1000*60*5;
                var element = id.toString() + ':' + ms.toString();
                comment.push(element);
                comment = JSON.stringify(comment);
                localStorage.comment = comment;
            }
        })
    });
    localStorageHandler();
}
/*
  * localStorage的处理句柄
  */
function localStorageHandler(){
    if(localStorage.article === undefined){
        //如果不存在文章记录就新建一个
        localStorage.article = '';
    }
    if(localStorage.comment_like === undefined){
        //如果不存在评论喜欢记录就新建一个
        localStorage.comment_like = '';
    }
    if(localStorage.comment === undefined){
        //如果不存在评论记录就新建一个
        var temp = Array();
        localStorage.comment = JSON.stringify(temp);
    }
    var articl_like = $('.like');
    var article_id = articl_like.attr('id');
    var localStorage_article = localStorage.article.split(',');
    var localStorage_comment_like = localStorage.comment_like.split(',');
    if(localStorage_article.length > 0){
        //有记录值
        for (var i = localStorage_article.length - 1; i >= 0; i--) {
            if(localStorage_article[i] == article_id){
                //此文章已经喜欢过，设置已喜欢样式
                articl_like.css({
                        'color' : '#fff',
                        'background' : '#ea6f5a'
                    })
            }
        }
    }
    var comment_like = $('.comment-like');
    for (var i = comment_like.length - 1; i >= 0; i--) {
        comment_like[i] = $(comment_like[i]);
        var id = comment_like[i].attr('cid');
        if(localStorage_comment_like.length > 0){
            //有记录值
            for (var j = localStorage_comment_like.length - 1; j >= 0; j--) {
                if(localStorage_comment_like[j] == id){
                    comment_like[i].find('svg').html('<use xlink:href="#icon-jushoucanggift"></use>');
                    console.log(comment_like[j]);
                }
            }
        }
    }
    comment_id = id;
}
/*
* 是否喜欢过此文章/评论 返回真假
* 参数
* 1.文章/评论 : article/comment
* 2. id  文章或者评论id
*/
function hasLike(name,id){
    var localStorage_article = localStorage.article.split(',');
    var localStorage_comment_like = localStorage.comment_like.split(',');
    if(name == 'article'){
        if(localStorage_article.length > 0){
            //有记录值
            for (var i = localStorage_article.length - 1; i >= 0; i--) {
                if(localStorage_article[i] == id){
                    return true;
                }
            }
        }else{
            return false;
        }
    }else if (name == 'comment') {
        if(localStorage_comment_like.length > 0){
            //有记录值
            for (var j = localStorage_comment_like.length - 1; j >= 0; j--) {
                if(localStorage_comment_like[j] == id){
                    return true;
                }
            }
        }else{
            return false;
        }
    }
    return false;
}
/*
* 是否能够评这篇文章
* 返回布尔值
*/
function hasComment(id){
    var info = localStorage.comment;
    var date = new Date();
    info = JSON.parse(info);
    for (var i = info.length - 1; i >= 0; i--) {
        var j = info[i].split(':');
        var a_id = j[0];
        var time = j[1];
        var curTime = date.getTime();
        if(a_id == id && curTime <= time){
            return false;
        }
    }
    return true;
}
/*
* 去除HTML标签
*/
function removeHTMLTag(str) {
            str = str.replace(/<\/?[^>]*>/g,''); //去除HTML tag
            str = str.replace(/[ | ]*\n/g,'\n'); //去除行尾空白
            //str = str.replace(/\n[\s| | ]*\r/g,'\n'); //去除多余空行
            str=str.replace(/&nbsp;/ig,'');//去掉&nbsp;
            str=str.replace(/\s/g,''); //将空格去掉
            return str;
}