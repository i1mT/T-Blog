import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/Index'
import Article from "../components/Article/Index"

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'index',
      meta: {
        title: "iimT的独立博客 - 首页"
      },
      component: (resolve) => require(['../components/Index.vue'], resolve),
    },
    {
      path: '/article/:id',
      name: 'blog',
      meta: {
        title: "文章 - iimT的独立博客"
      },
      component: (resolve) => require(['../components/Article/Index.vue'], resolve),
    },
    {
      path: '/tag/:id',
      name: 'tag',
      meta: {
        title: "标签 - iimT的独立博客"
      },
      component: (resolve) => require(['../components/Index.vue'], resolve),
    },
  ]
})
