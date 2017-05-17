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
var iimt_break = false;
//false时输出新行不换行，true时输出新行换行且不再监听回车，而是给回车加</br>

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

	if(text[text.length-1]=="\n"){
		clearInterval(timer);
        var sub_book = text.substr(text.length-5);
		if(iimt_break && sub_book != "@END\n" && sub_book != "@UPF\n"){
			//换行模式  并且不结束
			textarea.val(text + "<br>");
		}else{
            //非换行模式下，或者换行模式下但是提交了 回车=>提交
            var command = output.html().trim();
            console.log(command);
			if(sub_book == "@END\n"){
			    //文本结束标志
                console.log("break~");
                iimt_break = false;
                command = command.substr(0,command.length-4);
                command = command.replace(/<br>/g,"");
                console.log(command);
			}
			if(sub_book == "@UPF\n"){
			    //上传文件标志
                iimt_break = false;
			    console.log("上传md文件");
                command = command.substr(0,command.length-4);
                var path = command.replace(/<br>/g,"").trim();
                var data = {method:"readMD",path:path};
                $.ajax({
                    url : "../API/open_api.php",
                    async : false,
                    data : data,
                    success : function (data) {
                        command = data;
                    }
                })
            }
            textarea.val("");
            textarea.blur();
            processCmd(command);
		}
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

/*
 * 将查询文章返回的json包装为table_temp
 * 参数
 * 1.json
 * 2.page 页数
 * 返回相应页table   string
 */
function makeUpArticleTable(json,page) {
    var start,limit,tips;
    if(json == "nocate"){
        return "没有此分类";
    }
    json = JSON.parse(decodeURI(json));
    console.log(json);
    if(!json.length) {
        return "该分类下共有0篇文章";
    }
    if(!page) {
        page = 1;
        start = 0;
        tips = "共有" + json.length + "篇文章，" + "共"+ (parseInt(json.length/10)+1) +"页，默认显示第1页。"
    }else{
        start = (page-1)*10;
        tips = "共有" + json.length + "篇文章，" + "共"+ (parseInt(json.length/10)+1) +"页，当前第"+ page +"页。";
    }
    limit = (start+10) >= json.length ? json.length:(start+10);
    var table_temp = "<table class='article'>" +
        "<tr>" +
        "<td class='id'>ID</td>" +
        "<td class='title'>标题</td>" +
        "<td>发布时间</td>" +
        "<td>上次编辑</td>" +
        "<td class='num'>浏览数</td>" +
        "<td class='num'>喜欢数</td>" +
        "<td class='num'>评论数</td>" +
        "</tr>";
    for(var i = start; i < limit; i++){
        table_temp += "<tr>" +
            "<td class='id'>" + json[i].id + "</td>" +
            "<td class='title'>" + json[i].title + "</td>" +
            "<td>" + json[i].publishAt.substr(2,json[i].publishAt.length-5) + "</td>" +
            "<td>" + json[i].lastEdit.substr(2,json[i].publishAt.length-5) + "</td>" +
            "<td class='num'>" + json[i].viewed + "</td>" +
            "<td class='num'>" + json[i].likes + "</td>" +
            "<td class='num'>" + json[i].comments + "</td>" +
            "</tr>";
    }
    table_temp += "<tr><td class='sum' colspan='7'>" + tips + "</td></tr>"
    table_temp += "</table>";
    return table_temp;
}
/*
 * 
 */
function makeUpCommentTable(json,page) {
    var start,limit,tips;
    json = JSON.parse(decodeURI(json));
    console.log(json);
    if(!json.length) {
        return "该分类下共有0篇文章";
    }
    if(!page) {
        page = 1;
        start = 0;
        tips = "共有" + json.length + "个评论，" + "共"+ (parseInt(json.length/10)+1) +"页，默认显示第1页。"
    }else{
        start = (page-1)*10;
        tips = "共有" + json.length + "个评论，" + "共"+ (parseInt(json.length/10)+1) +"页，当前第"+ page +"页。";
    }
    limit = (start+10) >= json.length ? json.length:(start+10);
    var table_temp = "<table class='comment'>" +
        "<tr>" +
        "<td class='id'>ID</td>" +
        "<td class='title'>评论时间</td>" +
        "<td>内容</td>" +
        "<td>赞</td>" +
        "</tr>";
    for(var i = start; i < limit; i++){
        table_temp += "<tr>" +
            "<td class='id'>" + json[i].id + "</td>" +
            "<td>" + json[i].commenttime.substr(2,json[i].commenttime.length-5) + "</td>" +
            "<td class='num'>" + json[i].content.substr(0,10) + "</td>" +
            "<td class='num'>" + json[i].likes + "</td>" +
            "</tr>";
    }
    table_temp += "<tr><td class='sum' colspan='7'>" + tips + "</td></tr>"
    table_temp += "</table>";
    return table_temp;
}