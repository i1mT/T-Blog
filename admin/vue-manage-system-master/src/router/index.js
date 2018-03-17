import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            redirect: '/login'
        },
        {
            path: '/Situation',
            component: resolve => require(['../components/common/Home.vue'], resolve),
            children:[
                {
                    path: '/',
                    component: resolve => require(['../components/page/Situation.vue'], resolve)
                },
                {
                    path: '/manageBlog',
                    component: resolve => require(['../components/page/ManageBlog.vue'], resolve)
                },
                {
                    path: '/publish',
                    component: resolve => require(['../components/page/Publish.vue'], resolve)     // Vue-Quill-Editor组件
                },
                {
                    path: '/publishSuccess',
                    name: 'publishSuccess',
                    component: resolve => require(['../components/page/PublishSuccess.vue'], resolve)     // Vue-Quill-Editor组件
                },
                {
                    path: '/uploadPublish',
                    component: resolve => require(['../components/page/UploadPublish.vue'], resolve)       // Vue-Core-Image-Upload组件
                },
                {
                    path: '/basecharts',
                    component: resolve => require(['../components/page/BaseCharts.vue'], resolve)   // vue-schart组件
                },
                {
                    path: '/cate',
                    component: resolve => require(['../components/page/ManageCate.vue'], resolve)   // vue-schart组件
                },
                {
                    path: '/article',
                    component: resolve => require(['../components/page/ManageArticle.vue'], resolve)   // vue-schart组件
                },
            ]
        },
        {
            path: '/login',
            component: resolve => require(['../components/page/Login.vue'], resolve)
        },
    ]
})
