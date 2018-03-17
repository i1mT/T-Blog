<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-date"></i> 表单</el-breadcrumb-item>
                <el-breadcrumb-item>图片上传</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="content-title">支持拖拽</div>
        <div class="plugins-tips">
            Element UI自带上传组件。
            访问地址：<a href="http://element.eleme.io/#/zh-CN/component/upload" target="_blank">Element UI Upload</a>
        </div>
        <el-form>
            <el-form-item>
                <el-input size="large" v-model="article.title" placeholder="创作标题">
                    <template slot="prepend">标题：</template>
                </el-input>
            </el-form-item>
            <el-form-item>
                <el-upload
                    class="upload-demo"
                    ref="upload"
                    name="file"
                    :action="$API.Article.publishByUpload"
                    drag
                    :on-success="uploadSuccess"
                    :on-error="uploadError"
                    :data="article"
                    :auto-upload="false">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    <div class="el-upload__tip" slot="tip">只能上传Markdown文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
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
                <el-button size="large" type="primary" @click="publish">发表</el-button>
                <el-button size="large">保存草稿</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    import VueCoreImageUpload  from 'vue-core-image-upload';
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
                fileList: {},
                file: {},
                cate: []
            }
        },
        components: {
                VueCoreImageUpload
        },
        mounted() {
            this.getAllCate()
        },
        methods:{
            publish() {
                this.$refs.upload.submit()
            },
            uploadSuccess(res) {
                console.log("上传成功")
                this.$message.success("发表成功！")
                this.$router.push({name:'publishSuccess',params:{article:res.data.data}})
            },
            uploadError(err) { 
                this.$message.error("发表失败！")
                console.log(err)
            },
            handleSelect(item) {
                this.article.cate = item.id
            },
            getAllCate() {
                let that = this
                this.$axios.get(this.$API.Cate.getAll)
                .then((res) => {
                    that.cate = res.data.data
                })
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
        }
    }
</script>

<style scoped>
    .content-title{
        font-weight: 400;
        line-height: 50px;
        margin: 10px 0;
        font-size: 22px;
        color: #1f2f3d;
    }
    .pre-img{
        width:250px;
        height: 250px;
        margin-bottom: 20px;
    }
</style>