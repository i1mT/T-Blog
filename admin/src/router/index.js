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
                    component: resolve => require(['../components/page/Publish.vue'], resolve)
                },
                {
                    path: '/publishSuccess',
                    name: 'publishSuccess',
                    component: resolve => require(['../components/page/PublishSuccess.vue'], resolve)
                },
                {
                    path: '/uploadPublish',
                    component: resolve => require(['../components/page/UploadPublish.vue'], resolve)
                },
                {
                    path: '/basecharts',
                    component: resolve => require(['../components/page/BaseCharts.vue'], resolve)
                },
                {
                    path: '/cate',
                    component: resolve => require(['../components/page/ManageCate.vue'], resolve)
                },
                {
                    path: '/article',
                    component: resolve => require(['../components/page/ManageArticle.vue'], resolve)
                },
                {
                    path: '/activity',
                    component: resolve => require(['../components/page/activity/index.vue'], resolve)
                },
                {
                    path: '/activity/edit',
                    component: resolve => require(['../components/page/activity/detail.vue'], resolve)
                },
                {
                    path: '/activity/add',
                    component: resolve => require(['../components/page/activity/detail.vue'], resolve)
                },
            ]
        },
        {
            path: '/login',
            component: resolve => require(['../components/page/Login.vue'], resolve)
        },
    ]
})
