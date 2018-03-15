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
                    <span v-if="scope.row.editFlag" class="cell-edit-input">
                        <el-input v-model="scope.row.name"></el-input>
                    </span>
                    <span v-else>{{ scope.row.name }}</span>
                </template>
            </el-table-column>
            <el-table-column prop="sum" label="文章数">
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template scope="scope">
                    <el-button size="small"
                            @click="handleEdit(scope.$index, scope.row)">{{ scope.row.editFlag? "完成":"编辑"}}</el-button>
                    <el-popover
                        ref="deleteConfirm"
                        placement="top"
                        width="160"
                        v-model="scope.row.confirmDeleteVisible">
                        <p>确定删除吗？</p>
                        <div style="text-align: right; margin: 0">
                            <el-button size="mini" type="text" @click="deleteCalcel">取消</el-button>
                            <el-button type="primary" size="mini" @click="deleteSubmit">确定</el-button>
                        </div>
                    </el-popover>
                    <el-button
                        size="small"
                        type="danger"
                        v-popover:deleteConfirm
                        @click="handleDelete(scope.$index, scope.row)"
                    >删除</el-button>
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
            return {
                page: 1,
                cate: [],
                currentDeleteItem: {},
                cateBack: [],
                tableData: [],
                cur_page: 1,
                multipleSelection: [],
                del_list: [],
                searchKey: "",
            }
        },
        mounted() {
            this.getAllCate()
        },
        methods: {
            deleteCalcel(){
                console.log(this.currentDeleteItem)
                this.cate[this.currentDeleteItem.index].confirmDeleteVisible = false
                this.currentDeleteItem = {}
                console.log("取消")
            },
            deleteSubmit() {
                let id = this.currentDeleteItem.id
                const that = this
                this.$axios.post(this.$API.Cate.deleteById, {'id': id})
                .then((res) => {
                    console.log(res.data.data)
                    that.$message.success("删除成功！")
                    that.cate.splice(that.currentDeleteItem.index,1)
                })
            },
            getAllCate() {
                let that = this
                this.$axios.get(this.$API.Cate.getAll)
                .then((res) => {
                    for(var i in res.data.data) {
                        res.data.data[i].confirmDeleteVisible = false
                    }
                    that.cate = res.data.data
                    that.resetEditFlag(false)
                    that.cateBack = that.cate
                    console.log(res.data.data)

                    
                })
            },
            add(scope1) {
                console.log(scope1)
            },
            resetEditFlag(flag) {
                for(var i = 0; i < this.cate.length; i++)
                    this.$set(this.cate[i], 'editFlag', flag)
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
                if(this.cate[index].editFlag) {
                    //更新分类
                    this.updateCate(index,row);
                    return;
                }
                this.$set(this.cate[index], 'editFlag', !this.cate[index].editFlag)
            },
            updateCate(index,cate) {
                console.log(cate)
                const that = this
                let data = {
                    id: cate.id,
                    name: cate.name
                }
                this.$axios.post(this.$API.Cate.updateCate, data)
                .then((res) => {
                    console.log(res.data.data)
                    that.$set(that.cate[index], 'editFlag', !that.cate[index].editFlag)
                    that.$message.success("修改成功！")
                })
                .catch((err) => {
                    console.log(err)
                    that.$set(that.cate[index], 'editFlag', !that.cate[index].editFlag)
                    that.$message.success("修改失败！")
                })
            },
            handleDelete(index, row) {
                console.log(index)
                console.log(row)
                row.index = index
                this.currentDeleteItem = row
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