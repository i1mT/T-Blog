$(document).ready(function () {
    init();
})

function init() {
    //设置nav的高度为窗口高度
    var winHeight;
    if (window.innerHeight)
        winHeight = window.innerHeight;
    else if ((document.body) && (document.body.clientHeight))
        winHeight = document.body.clientHeight;
    $("nav").css( {height : winHeight} );
    $('html').css( {
        height : winHeight,
        'overflow' : 'hidden'
    } );
    //end
    //文章卡片按照图片真实宽高比来确定自身宽高
    
    //end
    //设置小火箭点击事件
    $('.fly-to-top').click(function (){
        var speed = 300;//滑动的速度
        $('body,html').animate({ scrollTop: 0 }, speed);
    });
    //设置鼠标滚轮事件
    if(document.addEventListener){
        document.addEventListener('DOMMouseScroll',scrollFunc,false);
    }//W3C
    window.onmousewheel=document.onmousewheel=scrollFunc;//IE/Opera/Chrome
    //监听页面滚动事件
    $(window).scroll(function () {
        var h = $(window).scrollTop();
        if(h==0){
            $('html').css( {
                height : winHeight,
                'overflow' : 'hidden'
            } );
        }
        //如果高度超过900px 就显示火箭头如果小于的话就隐藏
        if(h > 900){
            $('.fly-to-top').show();
        }else{
            $(".fly-to-top").hide();
        }
    })
    //设置分页居中问题
    var div_pages = $(".div-page");
    var div_pages_lis = div_pages.find('li');
    var lis_width = 0;
    for(var i = 0; i < div_pages_lis.length; i++){
        lis_width += $(div_pages_lis[i]).width()+10;
    }
    div_pages.css({
        'width' : lis_width+10
    });
}

function getWidthRatio(img){//获取图片宽高比，传入图片对象
    return img.naturalWidth/img.naturalHeight;
}

function scrollFunc(e) {
    e = e || window.event;
    var dir = "";

    if(e.wheelDelta){//webkit
        if(e.wheelDelta>0){
            dir = "up";
        }else{
            dir = "down";
        }
    }else if(e.detail){
        console.log(e.detail);
    }
    var h = $(window).scrollTop();
    if(h==0 && dir == "up") return;

    $('html').css( {
        height : 'auto',
        'overflow' : 'visible'
    } );
}