<template>
    <div class="sidebar">
        <el-menu :default-active="onRoutes" class="el-menu-vertical-demo" theme="dark" unique-opened router>
            <template v-for="item in items">
                <template v-if="item.subs">
                    <el-submenu :index="item.index">
                        <template slot="title"><i :class="item.icon"></i>{{ item.title }}</template>
                        <el-menu-item v-for="(subItem,i) in item.subs" :key="i" :index="subItem.index">{{ subItem.title }}
                        </el-menu-item>
                    </el-submenu>
                </template>
                <template v-else>
                    <el-menu-item :index="item.index">
                        <i :class="item.icon"></i>{{ item.title }}
                    </el-menu-item>
                </template>
            </template>
        </el-menu>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [
                    {
                        icon: 'el-icon-setting',
                        index: 'Situation',
                        title: '自述'
                    },{
                        icon: 'el-icon-menu',
                        index: 'cate',
                        title: '分类管理'
                    },{
                        icon: 'el-icon-menu',
                        index: 'article',
                        title: '我的创作'
                    },
                    {
                        icon: 'el-icon-menu',
                        index: 'ManageBlog',
                        title: '管理博客'
                    },
                    {
                        icon: 'el-icon-menu',
                        index: 'publish',
                        title: '创作'
                    },
                    {
                        icon: 'el-icon-menu',
                        index: 'uploadPublish',
                        title: '上传MD创作'
                    },
                    {
                        icon: 'el-icon-star-on',
                        index: 'basecharts',
                        title: '图表'
                    },
                ]
            }
        },
        computed:{
            onRoutes(){
                return this.$route.path.replace('/','');
            }
        }
    }
</script>

<style scoped>
    .sidebar{
        display: block;
        position: absolute;
        width: 250px;
        left: 0;
        top: 70px;
        bottom:0;
        background: #2E363F;
    }
    .sidebar > ul {
        height:100%;
    }
</style>
