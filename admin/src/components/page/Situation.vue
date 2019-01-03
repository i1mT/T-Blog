<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-setting"></i> 概况</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="plugins-tips">
            <div class="content-title">
                共创作了<span class="number cursor" @click="jumpToArticleManage">{{totalArticle}}</span>篇博文。
                发布了<span class="number cursor" @click="jumpToActivityManage">{{totalActivity}}</span>条动态。
            </div>
        </div>
        <div class="ms-doc">
            <h3>README.md</h3>
            <article>
                <h1>T-Blog</h1>
                <p>基于Vue + Element + PhalAPI的博客后台</p>
                <h2>前言</h2>
                <p>对之前Shell风格的后台重新做的一套可视化面板。</p>
                <h2>TODO:</h2>
                <el-checkbox disabled checked>评论管理</el-checkbox>
                <br>
                <el-checkbox disabled checked>创作时的实时保存</el-checkbox>
                <br>
                <el-checkbox disabled checked>前台博文中的评论升级为批注样式</el-checkbox>
                <br>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                totalArticle: 0,
                totalActivity: 0,
            }
        },
        methods: {
            jumpToArticleManage() {
                this.$router.push("/article")
            },
            jumpToActivityManage () {
                this.$router.push("/activity")
            },
            getArticalTotal() {
                //获取文章总数
                let that = this
                this.$axios.get(this.$API.Article.getCount)
                .then((res) => {
                    that.totalArticle = parseInt(res.data.data)
                })
            },
            getActivityTotal() {
                //获取活动总数
                let that = this
                this.$axios.get(this.$API.Activity.getCount)
                .then((res) => {
                    that.totalActivity = parseInt(res.data.data)
                })
            },
        },
        mounted () {
            this.getActivityTotal()
            this.getArticalTotal()
        }
    }
</script>

<style scoped>
    .number {
        color: #ff6655;
        font-size: 50px;
        padding: 0 8px;
    }
    .cursor {
        cursor: pointer;
    }
    .content-title{
        padding: 0 30px;
        font-weight: 400;
        line-height: 50px;
        margin: 10px 0;
        font-size: 24px;
        color: #1f2f3d;
    }
    .ms-doc{
        width:100%;
        max-width: 980px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
    }
    .ms-doc h3{
        padding: 9px 10px 10px;
        margin: 0;
        font-size: 14px;
        line-height: 17px;
        background-color: #f5f5f5;
        border: 1px solid #d8d8d8;
        border-bottom: 0;
        border-radius: 3px 3px 0 0;
    }
    .ms-doc article{
        padding: 45px;
        word-wrap: break-word;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    .ms-doc article h1{
        font-size:32px;
        padding-bottom: 10px;
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }
    .ms-doc article h2 {
        margin: 24px 0 16px;
        font-weight: 600;
        line-height: 1.25;
        padding-bottom: 7px;
        font-size: 24px;
        border-bottom: 1px solid #eee;
    }
    .ms-doc article p{
        margin-bottom: 15px;
        line-height: 1.5;
    }
    .ms-doc article .el-checkbox{
        margin-bottom: 5px;
    }
</style>