const DEV_ROOT =   'http://www.myblog.me/API/public/?s='
const PROD_ROOT = 'http://www.iimt.me/API/public/?s='
let ROOT = process.env.NODE_ENV === 'development' ? DEV_ROOT:PROD_ROOT


export default {
    BlogInfo: {
        'update': ROOT + "BlogInfo.update",
        'getInfo': ROOT + "BlogInfo.getBlogInfo"
    },
    Cate: {
        'getAll': ROOT + "Cate.getAll",
        'updateCate': ROOT + "Cate.updateById",
        'deleteById': ROOT + "Cate.deleteById"
    },
    Article: {
        'getPage': ROOT + "Article.getPage",
        'getCount': ROOT + "Article.getCount",
        'publish': ROOT + "Article.publish",
        'publishByUpload': ROOT + "Article.publishByUpload",
        'deleteById': ROOT + "Article.deleteById",
        'update': ROOT + "Article.updateById",
    },
    Admin: {
        'login': ROOT + "Admin.login",
        'isLogin': ROOT + "Admin.isLogin",
        'getAdminInfo': ROOT + "Admin.getAdminInfo",
        'logout': ROOT + "Admin.logout"
    },
    Activity: {
        'getPage': ROOT + "Activity.getPage",
        'update': ROOT + "Activity.updateById",
        'add': ROOT + "Activity.add",
        'deleteById': ROOT + "Activity.deleteById",
        'getCount': ROOT + "Activity.getCount",
        'getById': ROOT + "Activity.getById",
    }
}