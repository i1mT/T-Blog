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
    //end
}