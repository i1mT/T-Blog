/*
 * 处理指令
 */

/***************定义处理类***************/
var t = {};
/***************分析指令方法****************/
t.commandHandler = function (cmd) {
    if(cmd == "clear"){
        //清屏
        var lis = $(".cmd li");
        lis.remove();
        console.log("清屏");
        return "Clear ok.";
    }
    cmd = cmd.trim();
    var cmds = cmd.split(' ');
    console.log(cmds);
    var return_text = "";
    if(cmds.length>1){
        var level_1 = cmds[0];//一级指令  iimt
        var level_2 = cmds[1];//二级指令  set/article/comment
        var level_3 = cmds[2];//三级指令
    }else{
        return "指令不正确！";
    }
    if (!loginStatus) {
        if(level_1!="iimt"||level_2!="login")
            return "未登录,不能进行操作！";
    };
    var param_1,param_2;  //两个参数
    /*
     * 指令最少有两级
     */
    if(!level_3 || level_3[0] == '"'){
        //如果三级指令是参数的话，就是全局设置
        var params = cmd.split('"');
        console.log(params.length);
        if(params.length > 1){
            //有参数，获取参数并调用接口
            param_1 = params[1];
            if(params.length>3){
                //两个参数
                param_2 = params[3];
                return_text = t[level_1][level_2](param_1,param_2);
            }else{
                return_text = t[level_1][level_2](param_1);
            }
        }else{
            //直接调用接口
            return_text = t[level_1][level_2]();
        }
    }else{
        //非全局情况下
        var params = cmd.split('"');
        if(params.length > 0){
            //有参数，获取参数并调用接口
            param_1 = params[1];
            if(params.length>3){
                //两个参数
                param_2 = params[3];
                return_text = t[level_1][level_2][level_3](param_1,param_2);
            }else{
                return_text = t[level_1][level_2][level_3](param_1);
            }
        }else{
            //直接调用接口
            return_text = t[level_1][level_2][level_3]();
        }
    }
    return return_text;
}
/******************指令调用接口******************/
t.iimt = {};
/*********设置类***********/
t.iimt.set = {
    //设置博客标题
    blogname : function (name) {
        console.log("将博客名设置为：" + name);
    },
    blogdesc : function (desc) {
        console.log("将博客描述设置为：" + desc);
    },
    blogurl　: function (url){
        console.log("将博客地址设置为：" + url);
    }
};
/**********文章类**********/
t.iimt.article = {
    publish : function () {
        console.log("发布文章");
    },
    update : function (id) {
        console.log("更新文章，文章id：" + id);
    },
    delete : function (id) {
        console.log("删除文章，文章id：" + id);
    },
    search : function (keyword) {
        console.log("搜索文章，关键词：" + keyword);
    },
    showbycate : function (catename,page_num) {
        if(!page_num) page_num = 1;
        console.log("显示分类下的文章，分类：" + catename + "页数：" + page_num);
    },
    showall : function (page_num) {
        if(!page_num) page_num = 1;
        console.log("显示所有文章，页数：" + page_num);
    },
    showcomment : function (id,page_num) {
        if(!page_num) page_num = 1;
        console.log("显示文章评论，文章id：" + id + "页数：" + page_num);
    },
    deletecomment : function (article_id,comment_id) {
        console.log("删除文章下的评论，文章id：" + article_id + "评论id：" + comment_id);
    }
};
/*************评论类**********/
t.iimt.comment = {
    show : function (page_num) {
        if(!page_num) page_num = 1;
        console.log("显示所有评论，页数：" + page_num);
    },
    delete : function (id) {
        console.log("删除评论，评论id：" + id);
    }
};
/*********登录方法*********/
t.iimt.login = function(username,password){
    if(loginStatus) return "你已经登录！";
    var data = {
        method : "login",
        username : username,
        password : password
    };
    console.log(data);
    var ajax_status = false;
    var return_val;
    $.ajax({
        url : "../API/open_api.php",
        type : "GET",
        data : data,
        async : false,  //不异步请求
        success : function(data){
            if(data.trim() == "true"){
                window.loginStatus = true;
                return_val = "登录成功~";
            }
            else
                return_val = "用户名或密码错误。";
        },
        error : function () {
            return_val = "请求失败。";
        },
        processData : function(){
            console.log("正在登录");
        }
    });
    return return_val;
}
/********登出方法**********/
t.iimt.logout = function(){
    var data = {method : "logout"};
    var return_text;
    $.ajax({
        url : "../API/open_api.php",
        type : "GET",
        data : data,
        async : false,
        success : function (data) {
            console.log(data);
            if (data.trim() == "true"){
                window.loginStatus = false;
                return_text = "登出成功";
            }
            else
                return "登出失败。";
        },
        error : function () {
            return_text = "请求失败。";
        }
    });
    return return_text;
}
