<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-menu"></i> 表格</el-breadcrumb-item>
                <el-breadcrumb-item>基础表格</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="handle-box">
            <el-input v-model="searchKey" placeholder="筛选关键词" class="handle-input mr10"></el-input>
            <el-button type="primary" icon="search" @click="search">搜索</el-button>
        </div>
        <el-table :data="Articles" border ref="multipleTable" @selection-change="handleSelectionChange">
            
            <el-table-column prop="id" label="编号" sortable width="90">
            </el-table-column>
            <el-table-column prop="title" label="博文标题">
                <template scope="scope">
                    <a class="article-title" @click="linkToArticle(scope.row)">{{ scope.row.title }}</a>
                </template>
            </el-table-column>
            <el-table-column prop="cateName" label="分类" width="90">
            </el-table-column>
            <el-table-column prop="lastEdit" label="上次编辑" width="165">
            </el-table-column>
            <el-table-column prop="viewed" label="浏览" width="65">
            </el-table-column>
            <el-table-column prop="likes" label="喜欢" width="65">
            </el-table-column>
            <el-table-column prop="comments" label="评论" width="65">
            </el-table-column>
            <el-table-column label="操作" width="80">
                <template scope="scope">
                    <el-button size="small" type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="pagination">
            <el-pagination
                    @current-change ="handleCurrentChange"
                    layout="prev, pager, next"
                    :total="totalArticle"
                    :page-size="perPageArticles">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            this.getArticalTotal()
            this.getPage(1, 4)
            return {
                perPageArticles: 4,
                totalArticle: 0,
                Articles: [],
                ArticleBack: [],
                tableData: [],
                curPage: '',
                multipleSelection: [],
                del_list: [],
                searchKey: "",
            }
        },
        methods: {
            linkToArticle(row) {
                this.$router.push({path:'/publish',query:{article:row}})
            },
            getArticalTotal() {
                //获取文章总数
                let that = this
                this.$axios.get(this.$API.Article.getCount)
                .then((res) => {
                    that.totalArticle = parseInt(res.data.data)
                })
            },
            getPage(page, pageNum) {
                //获取第一页文章
                let that = this
                let data = {
                    page: page,
                    pageNum: pageNum
                }
                this.$axios.post(this.$API.Article.getPage, data)
                .then((res) => {
                    that.Articles = res.data.data
                    that.ArticleBack = that.Articles
                })
            },
            resetEditFlag(flag) {
                for(var i = 0; i < this.cate.length; i++) 
                    this.cate[i].editFlag = flag
            },
            handleCurrentChange(val){
                this.getPage(val, this.perPageArticles)
            },
            search(key){
                key = key.trim()
                let searchRes = []
                for(var i = 0; i < this.ArticleBack.length; i++) {
                    if(this.ArticleBack[i].title.indexOf(key) != -1)
                        searchRes.push(this.ArticleBack[i])
                }
                this.Articles = searchRes
            },
            handleEdit(index, row) {
                this.resetEditFlag(false)
                this.cate[index].editFlag = false
                console.log(this.cate)
                this.$message('编辑第'+(index+1)+'行');
            },
            handleDelete(index, row) {
                console.log(index)
                console.log(row)
                this.$message.error('删除第'+(index+1)+'行');
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            
        },
        watch: {
            searchKey(key) {
                if(key == "")
                    this.Articles = this.ArticleBack
                else
                    this.search(key)
            }
        }
    }
</script>

<style scoped>
.handle-box{
    margin-bottom: 20px;
}
.handle-select{
    width: 120px;
}
.handle-input{
    width: 300px;
    display: inline-block;
}
.article-title:hover {
    cursor: pointer;
    color: #20a0ff;
}
.article-title:visited {
    color: black;
}
</style>