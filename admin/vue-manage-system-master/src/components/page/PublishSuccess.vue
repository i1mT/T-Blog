<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-date"></i> 创作</el-breadcrumb-item>
                <el-breadcrumb-item>发表成功</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="plugins-tips">
            发表成功！
            访问地址：<a href="https://github.com/F-loat/vue-simplemde" target="_blank"> {{ article.title }}</a>
        </div>
        <el-button type="success" @click="backToArticles">返回文章列表</el-button>
        <div class="plugins-tips">
            <p>既然用了markdown语法了，那么就有一个很实际的问题了。要怎么在前台展示数据呢？</p>
            <br>
            <p>这个时候就需要解析markdown语法了。可以使用 <a href="https://github.com/miaolz123/vue-markdown" target="_blank">vue-markdown</a>：一个基于vue.js的markdown语法解析插件。（这里不作展开，有需要自行了解）</p>
        </div>
    </div>
</template>

<script>
    import { markdownEditor } from 'vue-simplemde';
    export default {
        data: function(){
            let article = this.$route.params.article
            return {
                article: article,
                content:'',
                configs: {
                    status: true,
                    initialValue: 'Hello BBK',
                    renderingConfig: {
                        codeSyntaxHighlighting: true,
                        highlightingTheme: 'atom-one-light'
                    }
                }
            }
        },
        components: {
            markdownEditor
        },
        methods: {
            backToArticles() {
                this.$router.push('/article')
            }
        }
    }
</script>