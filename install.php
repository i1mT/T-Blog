<?php

if(count($_GET) > 0){
	//有传内容，开始安装
	$_INFO = array(
			"install_status"=>1,
			"servername"=>$_GET["servername"],  //数据库服务器地址
			"username"=>$_GET["username"],   //数据库用户名
			"password"=>$_GET["password"],  //数据库密码
			"dbname"=>$_GET["dbname"], //数据库名
			"user"=>$_GET["user"],  //博客管理用户名
			"nickname"=>$_GET["nickname"],  //博客用户昵称
			"adminpass"=>$_GET["adminpass"],  //博客管理用户密码
			"siteurl"=>$_GET["siteurl"]  //博客域名
			);
	$json = json_encode($_INFO);
	file_put_contents("install_info.json", $json);

	$temp_conn = new mysqli($_INFO["servername"],$_INFO["username"], $_INFO["password"]);
	if($temp_conn->connect_error){
		die("connect error");
	}else{
		echo "connect success";
		$sql = "CREATE DATABASE `" . $_INFO["dbname"] . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ";
		$create_res = $temp_conn->query($sql);
		var_dump($create_res);
		echo "切换数据库";
		$sele = $temp_conn->select_db($_INFO["dbname"]);
		$import_sql = file_get_contents("asset/blog.sql");
		$sql_arr = GetSqlArr($import_sql);
		$import_status = true;
		for($i = 0; $i < count($sql_arr); $i++){
			$import_status = $temp_conn->query($sql_arr[$i]);
			if(!$import_status) break;
		}
		if(!$import_status){
			echo "false";
			exit();
		}
		//插入博客管理用户信息
		$sql_admininfo = "UPDATE `admin` SET `nickname` = '" . $_INFO["nickname"] . "', `username` = '" . $_INFO["user"] . "', `pwd` = '" . $_INFO["adminpass"] . "' WHERE `admin`.`id` = 1";
		$sql_res = $temp_conn->query($sql_admininfo);
		if(!$sql_res) {
			echo "false";
			exit();
		}
		//更新博客主页域名
		$sql_index = "UPDATE `bloginfo` SET `siteurl` = '" . $_INFO["siteurl"] . "' WHERE `bloginfo`.`id` = 1";
		$sql_res = $temp_conn->query($sql_index);
		if(!$sql_res) {
			echo "false";
			exit();
		}
	}
}
function GetSqlArr($str) {
	$sql_arr = array();
        //去除注释
        $str = preg_replace('/--.*/i', '', $str);
        $str = preg_replace('/\/\*.*\*\/(\;)?/i', '', $str);
        //去除空格 创建数组
        $str = explode(";\n", $str);
        foreach ($str as $v) {
            $v = trim($v);
            if (empty($v)) {
                continue;
            } else {
                array_push($sql_arr, $v);
            }
        }
        return $sql_arr;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="asset/main.css">
	<script src="asset/jquery-3.1.1.min.js"></script>
	<title>博客安装</title>
	<style>
		html{
			background: #000;
		}
	</style>
</head>
<body>
	<div class="terminal">
	<div class="terminal-output">
	</div>
	<ul class="cmd">
		<li class="output"><span>第一次使用博客，请填写下列信息安装。</span></li>
		<li class="output"><span>服务器地址：</span></li>
		<li class="input" id="onInput"><span></span><i class="cursor blink">&nbsp;</i>
		</li>
	</ul>
</div>
<textarea id="getText" spellcheck="false"></textarea>
</body>
<script>
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
window.info_json = {
	install_status:{
		text : "安装状态",
		value : 0
	},
	servername:{
		text : "服务器地址：",
		value : "",
		get : true
	},
	username:{
		text : "数据库用户名：",
		value : "",
		get : false
	},
	password:{
		text : "数据库用户密码：",
		value : "",
		get : false
	},
	dbname:{
		text : "数据库名称(如t-blog)：",
		value : "",
		get : false
	},
	user:{
		text : "博客管理账户名：",
		value : "",
		get : false
	},
	nickname:{
		text : "博客所有者昵称：",
		value : "",
		get : false
	},
	adminpass : {
		text : "博客管理密码：",
		value : "",
		get : false
	},
	siteurl : {
		text : "博客域名(请自行填写http://或者https://)：",
		value : "",
		get : false
	}
};
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
	var pageHeight = $(window).height();
	terminal.css({
		"height" : (pageHeight - parseInt(padding_top))
	});
}
//获取输入的文字并刷新
function getText(){
	var textarea = $("#getText");
	var output = $("#onInput span");
	textarea.focus();
	var text = textarea.val();
	console.log(text);

	//刷新
	output.html(text);
	//检测回车 提交
	if(text[text.length-1] == '\n'){
		clearInterval(timer);
		var outputs = $('.output');
		var last_info_name = $(outputs[outputs.length-1]).find('span').html().trim();
		for(var key in info_json){
			if(last_info_name == info_json[key].text){
				info_json[key].value = text.substr(0,text.length-1).toString();
				break;
			}
		}
		var status = false;
		for(var key in info_json){
			if(info_json[key].hasOwnProperty("get") && !info_json[key].get){
				outPut(info_json[key].text);
				info_json[key].get = true;
				status = true;
				break;
			}
		}
		if(!status){
			//全部信息收集完成
			console.log("收集完成");
			console.log(info_json);
			//start request to install
			outPut("开始安装.");
			$("#onInput").remove();
			var last_output = $(".output:last span");
			var dot_num = 1;
			var text_timer = setInterval(function (){
				var text = "开始安装";
				dot_num++;
				if (dot_num > 6) dot_num = 1;
				for (var i = 0; i < dot_num; i++) {
					text += ".";
				}
				console.log(text);
				last_output.html(text);
			},500);
			var data = {};
			for (var key in info_json) {
				data[key] = info_json[key].value;
			}
			console.log(data);
			$.ajax({
				url: '',
				type: 'GET',
				data: data,
			})
			.done(function() {
				clearInterval(text_timer);
				var second = 5;
				last_output.html("安装成功！将会在" + second +"秒之后转到博客首页");
				setInterval(function (){
					second--;
					last_output.html("安装成功！将会在" + second +"秒之后转到博客首页");
					if(!second){
						window.location = data.siteurl;
					}
				},1000);
			})
			.fail(function() {
				console.log("error");
			});
		}
		textarea.val('');
		//继续监听
		window.timer = setInterval(function(){
			getText();
		},fresh_time);
	}
	//将光标定位到行末
	$('#getText').focusEnd();
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
</script>
</html>