$(document).ready(function () {
    init();
})

function init() {
    //设置nav的高度为窗口高度
    console.log("set nav height")
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
    })
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