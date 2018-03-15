<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-date"></i> 表单</el-breadcrumb-item>
                <el-breadcrumb-item>markdown</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="plugins-tips">
            Vue-SimpleMDE：Vue.js的Markdown Editor组件。
            访问地址：<a href="https://github.com/F-loat/vue-simplemde" target="_blank">Vue-SimpleMDE</a>
        </div>
        <markdown-editor v-model="article.content" :configs="configs" ref="markdownEditor"></markdown-editor>
        <el-autocomplete
            v-model="state4"
            :fetch-suggestions="querySearchAsync"
            placeholder="请输入内容"
            @select="handleSelect"
        ></el-autocomplete>
        <el-button type="primary" @click="onSubmit">发表</el-button>
        <el-button>保存草稿</el-button>
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
            
            return {
                article: {
                    content: '',
                    title: '',
                    cate: '',
                    cateName: '',
                    lastEdit: '',
                },
                cate: [],
                state4: '',
                content:'',
                configs: {
                    status: true,
                    initialValue: '在这里开始你的创作吧~',
                    renderingConfig: {
                        codeSyntaxHighlighting: true,
                        highlightingTheme: 'atom-one-light'
                    }
                }
            }
        },
        mounted(){
            //DOM挂载之后
            if(this.$route.query.article) {
                this.article = this.$route.query.article
                this.configs.initialValue = this.article.content
            }
            //获取全部分类
            this.getAllCate()
        },
        methods: {
            getAllCate() {
                let that = this
                this.$axios.get(this.$API.Cate.getAll)
                .then((res) => {
                    that.cate = res.data.data
                })
            },
            onSubmit() {
                console.log(this.content)
            },
            handleSelect(item) {
                console.log(item);
            },
            querySearchAsync(queryString, cb) {
                var cates = this.cate
                var results = []

                for(cate in cates) {
                    if(cate.name.indexOf(queryString) != -1)
                        results.push(cate)
                }

                clearTimeout(this.timeout)
                this.timeout = setTimeout(() => {
                    cb(results);
                }, 1000 * Math.random());
            }
        },
        components: {
            markdownEditor
        }
    }
</script>