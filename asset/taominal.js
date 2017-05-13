/*
 * 处理指令
 * 分页中：默认每页十个数据
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
        var data = {
            method : "setBlogname",
            blogname : name
        };
        var return_text;
        $.ajax({
            url : "../API/open_api.php",
            type : "GET",
            data : data,
            async : false,
            success : function (data) {
                if(data == "true")
                    return_text = "博客名设置成功。";
                else
                    return_text = "博客名设置失败。";
            },
            error : function () {
                return_text = "请求失败。";
            }
        });
        return return_text;
    },
    //设置博客介绍
    blogdesc : function (desc) {
        console.log("将博客描述设置为：" + desc);
        var data = {
            method : "setBlogdesc",
            blogdesc : desc
        };
        var return_text;
        $.ajax({
            url : "../API/open_api.php",
            type : "GET",
            data : data,
            async : false,
            success : function(data){
                if(data == "true")
                    return_text = "博客介绍设置成功。";
                else
                    return_text = "博客介绍设置失败。";
            },
            error : function () {
                return_text = "请求失败。";
            }
        });
        return return_text;
    },
    //设置博客站点地址
    blogurl　: function (url){
        console.log("将博客地址设置为：" + url);
        var data = {
            method : "setBlogurl",
            blogurl : url
        };
        var return_text;
        $.ajax({
            url : "../API/open_api.php",
            type : "GET",
            data : data,
            async : false,
            success : function (data) {
                if(data == "true")
                    return_text = "博客地址设置成功。";
                else
                    return_text = "博客地址设置失败。";
            },
            error : function () {
                return_text = "请求失败。";
            }
        });
        return return_text;
    }
};
/**********文章类**********/
t.iimt.article = {
    publish : function () {
        //开启编辑模式
        window.iimt_mood = "edit";
        //文章对象
        window.article = {
            start : false,
            title : {
                val : "",
                state : false,
                text : "标题："
            },
            cate : {
                val : "",
                state : false,
                text : "分类："
            },
            content : {
                val : "",
                state : false,
                text : "正文内容："
            },
            cover : {
                val : "",
                state : false,
                text : "封面地址："
            }
        };//定义全局article空对象
        return "要进入编辑模式并发布新文章吗?(Y/N)";
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
    var return_text;
    $.ajax({
        url : "../API/open_api.php",
        type : "GET",
        data : data,
        async : false,  //不异步请求
        success : function(data){
            if(data.trim() == "true"){
                window.loginStatus = true;
                return_text = "登录成功~";
            }
            else
                return_text = "用户名或密码错误。";
        },
        error : function () {
            return_text = "请求失败。";
        },
    });
    return return_text;
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
/********************编辑模式下**********************/
t.iimt.editHandler  = function(val){
    val = val.trim();
    if(!article.start){
        switch (val){
            case "N":
                return "你已取消。";
            case "Y":
                break;
            default:
                return "输入有误，默认取消。";
        }
    }
    if (!article.start){
        article.start = true;
        return article.title.text;
    }
    //先遍历  遇到空的用val填充
    for(var item in article){
        if(item == "start") continue;
        if(article[item].val == ""){
            article[item].val = val;
            break;
        }
    }
    var book = false;
    //再遍历，遇到空的提示下一次输出这个
    for(var item in article){
        if(item == "start") continue;
        if(article[item].val == ""){
            book = true;
            return article[item].text;
        }
    }
    if(!book){
        window.iimt_mood = "command";
        return "文章信息收录完成，进入编辑模式。";
    }
}