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
                        icon: 'el-icon-menu',
                        index: '/Situation',
                        title: '博客概况'
                    },
                    {
                        icon: 'el-icon-edit',
                        index: '/publish',
                        title: '创作'
                    },
                    {
                        icon: 'el-icon-upload',
                        index: '/uploadPublish',
                        title: '上传MD创作'
                    },
                    {
                        icon: 'el-icon-document',
                        index: '/article',
                        title: '我的创作'
                    },
                    {
                        icon: 'el-icon-menu',
                        index: '/activity',
                        title: '动态',
                        subs: [
                            {
                                index: '/activity',
                                title: '我的动态',
                            },{
                                index: '/activity/add',
                                title: '新增动态',
                            },
                        ]
                    },
                    {
                        icon: 'el-icon-star-on',
                        index: '/cate',
                        title: '分类管理'
                    },
                    {
                        icon: 'el-icon-setting',
                        index: '/ManageBlog',
                        title: '管理博客'
                    },
                ]
            }
        },
        computed:{
            onRoutes(){
                return this.$route.path.replace('/','');
            }
        },
        created() {
            //先判断是否已经登陆
            const that = this
            that.$axios.get(that.$API.Admin.getAdminInfo)
            .then((res) => {
                let admin = res.data.data
                if(admin.islogin == 0) {
                    console.log("未登录")
                    that.$router.push('/login');
                }
            })
        },
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
