/*
 * 处理指令
 */

/***************定义处理类***************/
var t = {};
/***************分析指令方法****************/
t.commandHandler = function (cmd) {
    if(cmd == "clear"){
        //清屏
        console.log("清屏");
        return;
    }
    cmd = cmd.trim();
    var cmds = cmd.split(' ');
    if(cmds.length>1){
        var level_1 = cmds[0];//一级指令  iimt
        var level_2 = cmds[1];//二级指令  set/article/comment
        var level_3 = cmds[2];//三级指令
    }else{
        return "指令不正确！";
    }
    var param_1,param_2;  //两个参数
    /*
     * 指令最少有两级
     */
    if(level_3[0] == '"'){
        //如果三级指令是参数的话，就是全局设置
        return "全局设置";
    }else{
        //非全局情况下
        var params = cmd.split('"');
        if(params.length > 0){
            //有参数，获取参数并调用接口
            param_1 = params[1];
            if(params.length>3){
                //两个参数
                param_2 = params[3];
                t[level_1][level_2][level_3](param_1,param_2);
            }else{
                t[level_1][level_2][level_3](param_1);
            }
        }else{
            //直接调用接口
            t[level_1][level_2][level_3]();
        }
    }
    return "指令正确，结果：";
}
/******************指令调用接口******************/
t.iimt = {};
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

