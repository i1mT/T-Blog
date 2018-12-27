import Vue from 'vue';
import App from './App';
import router from './router';
import axios from 'axios';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';    // 默认主题
// import '../static/css/theme-green/index.css';       // 浅绿色主题
import "babel-polyfill";

Vue.use(ElementUI);
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.headers.get['Content-Type'] = 'application/x-www-form-urlencoded';
axios.defaults.transformRequest = [function (data) {
    let ret = ''
    for (let it in data) {
      ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it]) + '&'
    }
    return ret
}]
Vue.prototype.$axios = axios;

var baseU = "http://www.iimt.me/API/public/?s="
Vue.prototype.$API = {
    BlogInfo: {
        'update': baseU + "BlogInfo.update",
        'getInfo': baseU + "BlogInfo.getBlogInfo"
    },
    Cate: {
        'getAll': baseU + "Cate.getAll",
        'updateCate': baseU + "Cate.updateById",
        'deleteById': baseU + "Cate.deleteById"
    },
    Article: {
        'getPage': baseU + "Article.getPage",
        'getCount': baseU + "Article.getCount",
        'publish': baseU + "Article.publish",
        'publishByUpload': baseU + "Article.publishByUpload",
        'deleteById': baseU + "Article.deleteById",
        'update': baseU + "Article.updateById",
    },
    'Admin': {
        'login': baseU + "Admin.login",
        'isLogin': baseU + "Admin.isLogin",
        'getAdminInfo': baseU + "Admin.getAdminInfo",
        'logout': baseU + "Admin.logout"
    }
}

router.afterEach((to, from) => {
    //先判断是否已经登陆
    axios.get(Vue.prototype.$API.Admin.getAdminInfo)
    .then((res) => {
        let admin = res.data.data
        if(admin.islogin == 0) {
            router.push('/login')
        }
    })
})
new Vue({
    router,
    render: h => h(App)
}).$mount('#app');