$(document).ready(function(){
	init();
	
	window.fresh_time = 50;//字符获取频率 毫秒

	window.timer = setInterval(function(){
		getText();
	},fresh_time);
	//在页面任何部位点击就开始输入
	$("body").click(function(){
		$("#getText").focus();
	});
});
/*
 * 全局变量
 */
var iimt_mood = "command"; //command模式 指令模式   edit模式  编辑模式
/*
 * 页面初始化
 */
function init(){
	//设置登录状态
	var loginstatus = $("#islogin").html().trim();
	window.loginStatus = loginstatus=="0"? false : true;
	console.log("登录状态：" + window.loginStatus);
	var textarea = $("#getText");
	var output = $("#onInput span");
	textarea.focus();
	//terminal高度等于浏览器高度
	var terminal = $(".terminal");
	var padding_top = terminal.css("padding-top");
	console.log(padding_top);
	var pageHeight = $(window).height();
	terminal.css({
		"height" : (pageHeight - parseInt(padding_top))
	});

}
/*
 * 获取指令内容并发送给处理类
 */
function getText(){
	var textarea = $("#getText");
	var output = $("#onInput span");
	textarea.focus();
	var text = textarea.val();
	output.html(text);
	//将光标定位到行末
    $('#getText').focusEnd();

	console.log(text);
	if(text[text.length-1]=="\n"){
		clearInterval(timer);
		//回车=>提交
		textarea.val("");
		textarea.blur();
		var command = output.html().trim();
		processCmd(command);
		//继续监听
		window.timer = setInterval(function(){
			getText();
		},fresh_time);
	}
}
//输出一行内容
function outPut(msg) {
    var response_temp = '<li class="output">'+
        '<span>'+ msg +'</span>'+
        '</li>';
    $("#onInput").find(".cursor").remove();
    $("#onInput").removeAttr("id");
    var cmd = $(".cmd");
    cmd.append(response_temp);
    var new_line_temp = '<li class="input" id="onInput"><span></span>'+
        '<div class="cursor blink">&nbsp;</div>'+
        '</li>';
    cmd.append(new_line_temp);
}
//处理命令
function processCmd(request){
	var response = window.iimt_mood=="edit" ? t.iimt.editHandler(request):t.commandHandler(request);
	outPut(response);
}
//设置textarea的位置到文本末
$.fn.setCursorPosition = function( position ){
    if(this.length == 0) return this;
    return $(this).setSelection( position, position );
}

$.fn.setSelection = function(selectionStart, selectionEnd) {
    if(this.length == 0) return this;
    input = this[0];

    if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', selectionEnd);
        range.moveStart('character', selectionStart);
        range.select();
    } else if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    }

    return this;
}

$.fn.focusEnd = function(){
    this.setCursorPosition(this.val().length);
}