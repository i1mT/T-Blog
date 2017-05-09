/*
 * 处理指令
 */

var t = {};

t.iimt = {};
t.iimt.set = {
    //设置博客标题
    blogname : function (name) {
        console.log("将博客名设置为：" + name);
    },
    blogdesc : function (desc) {
        console.log("将博客描述设置为：" + desc);
    }
};

