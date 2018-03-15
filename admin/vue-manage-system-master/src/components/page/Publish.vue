<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-date"></i> 表单</el-breadcrumb-item>
                <el-breadcrumb-item>创作</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="plugins-tips">
            Vue-SimpleMDE：Vue.js的Markdown Editor组件。
            访问地址：<a href="https://github.com/F-loat/vue-simplemde" target="_blank">Vue-SimpleMDE</a>
        </div>
        <el-form>
            <el-form-item>
                <el-input size="large" v-model="article.title" placeholder="创作标题">
                    <template slot="prepend">标题：</template>
                </el-input>
            </el-form-item>
            <markdown-editor v-model="article.content" :configs="configs" ref="markdownEditor"></markdown-editor>
            <div class="plugins-tips">
                <p v-if="isReEdit">上次编辑 {{ article.lastEdit }}</p>
                <p>(自动保存-待开发)</p>
            </div>
            <el-form-item>
                <el-autocomplete
                    v-model="article.cateName"
                    :fetch-suggestions="querySearch"
                    placeholder="选择分类"
                    @select="handleSelect"
                >
                    <template slot="prepend">分类：</template>
                </el-autocomplete>
            </el-form-item>
            <el-form-item>
                <el-input v-model="article.cover" placeholder="输入封面图片地址...">
                    <template slot="prepend">封面：</template>
                </el-input>
            </el-form-item>
            
            <el-form-item>
                <el-button type="primary" @click="publish">发表</el-button>
                <el-button>保存草稿</el-button>
            </el-form-item>
        </el-form>
        <div class="plugins-tips">
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
                    cover:'',
                },
                cate: [],
                selectCate: '',
                content:'',
                isReEdit: false,
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
                this.isReEdit = true
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
            publish() {
                console.log(this.article)
                const that = this
                this.article.cate = this.article.cateName
                this.$axios.post(this.$API.Article.publish,this.article)
                .then((res) => {
                    if(res.data.data.id) {
                        //发表成功 跳转到文章
                        that.$message.success("发表成功！")
                        that.$router.push({name:'publishSuccess',params:{article:res.data.data}})
                    } else {
                        //发表失败
                        that.$message.error("发表失败！")
                    }
                    console.log(res.data.data)
                })
            },
            handleSelect(item) {
                this.article.cate = item.id
            },
            querySearch(queryString, cb) {
                this.getAllCate()
                var cates = this.cate
                var results = []

                for(var i in cates) {
                    if(cates[i].name.indexOf(queryString) != -1)
                        results.push( {
                            'value': cates[i].name,
                            'id': cates[i].id
                            })
                }
                cb(results);
            }
        },
        components: {
            markdownEditor
        }
    }
</script>