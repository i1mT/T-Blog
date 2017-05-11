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
 * 页面初始化
 */
function init(){
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
	console.log(text);
	if(text[text.length-1]=="\n"){
		clearInterval(timer);
		//提交了
		textarea.val("");
		textarea.blur();
		var command = output.html().trim();
		processCmd(command);
		//继续
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
	var response = t.commandHandler(request);
	outPut(response);
}