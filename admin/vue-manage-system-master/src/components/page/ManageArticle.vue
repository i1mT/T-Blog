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
        <el-table :data="Articles" border style="width: 100%" ref="multipleTable" @selection-change="handleSelectionChange">
            
            <el-table-column prop="id" label="编号" sortable width="90">
            </el-table-column>
            <el-table-column prop="title" label="博文标题">
                <template scope="scope">
                    {{ scope.row.title }}
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
                    :total="totalPage">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            let that = this
            let data = {
                page: '1',
                pageNum: '3'
            }
            //获取文章总数
            this.$axios.get(this.$API.Article.getCount)
            .then((res) => {
                that.totalArticle = res.data.data
                that.totalPage = Math.round(that.totalArticle / that.perPageArticles)
            })
            //获取第一页文章
            this.$axios.post(this.$API.Article.getPage, data)
            .then((res) => {
                that.Articles = res.data.data
            })
            return {
                perPageArticles: 3,
                totalArticle: 0,
                totalPage: 3,
                Articles: [],
                tableData: [],
                curPage: 1,
                multipleSelection: [],
                del_list: [],
                searchKey: "",
            }
        },
        methods: {
            add(scope1) {
                console.log(scope1)
            },
            resetEditFlag(flag) {
                for(var i = 0; i < this.cate.length; i++) 
                    this.cate[i].editFlag = flag
            },
            handleCurrentChange(val){
                this.curPpage = val;
            },
            search(key){
                key = key.trim()
                let searchRes = []
                for(var i = 0; i < this.cateBack.length; i++) {
                    if(this.cateBack[i].name.indexOf(key) != -1)
                        searchRes.push(this.cateBack[i])
                }
                this.cate = searchRes
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
                    this.cate = this.cateBack
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
</style>