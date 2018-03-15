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
        <el-table :data="cate" border ref="multipleTable" @selection-change="handleSelectionChange">
            
            <el-table-column prop="id" label="编号" sortable width="120">
            </el-table-column>
            <el-table-column prop="name" label="分类名" width="200">
                <template scope="scope">
                    <span v-if="!scope.row.editFlag">{{ scope.row.name }}</span>
                    <span v-if="scope.row.editFlag" class="cell-edit-input">
                        <el-input v-model="scope.row.name"></el-input>
                    </span>
                </template>
            </el-table-column>
            <el-table-column prop="sum" label="文章数">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template scope="scope">
                    <el-button size="small"
                            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button size="small" type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="pagination">
            <el-pagination
                    @current-change ="handleCurrentChange"
                    layout="prev, pager, next"
                    :total="page">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            let that = this
            this.$axios.get(this.$API.Cate.getAll)
            .then((res) => {
                that.cate = res.data.data
                that.resetEditFlag(true)
                that.cateBack = that.cate
                console.log(res.data.data)
            })
            return {
                page: 1,
                cate: [],
                cateBack: [],
                tableData: [],
                cur_page: 1,
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
                this.cur_page = val;
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