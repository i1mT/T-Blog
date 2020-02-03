<template>
    <div class="table">
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-menu"></i> 活动</el-breadcrumb-item>
                <el-breadcrumb-item>活动列表</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="hr"></div>
        <div class="handle-box">
            <el-input v-model="searchKey" placeholder="筛选关键词" class="handle-input mr10"></el-input>
            <el-button type="primary" icon="search" @click="search">搜索</el-button>
            <el-button type="success" icon="el-icon-edit" @click="addData">发布动态</el-button>
        </div>
        <el-table :data="tableData" border ref="multipleTable" @selection-change="handleSelectionChange">
            
            <el-table-column prop="id" label="编号" sortable width="90">
            </el-table-column>
             <el-table-column prop="ctime" label="发布时间" sortable width="180">
            </el-table-column>
            <el-table-column prop="brief" label="摘要">
                <template scope="scope">
                    <a class="article-title" @click="linkToDetail(scope.row)">{{ scope.row.brief }}</a>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="80">
                <template scope="scope">
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
                    :total="totalCloumn"
                    :page-size="pageSize">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            this.getActivityTotal()
            this.getPage(1, 10)
            return {
                pageSize: 10,
                totalCloumn: 0,
                tableData: [],
                tableDataBackup: [],
                tableData: [],
                multipleSelection: [],
                searchKey: "",
                currentDeleteItem: {},
                confirmDeleteVisible: false
            }
        },
        methods: {
            addData () {
                this.$router.push("/activity/add")
            },
            deleteCalcel(){
                console.log(this.currentDeleteItem)
                this.tableData[this.currentDeleteItem.index].confirmDeleteVisible = false
                this.currentDeleteItem = {}
                console.log("取消")
            },
            deleteSubmit() {
                let id = this.currentDeleteItem.id
                const that = this
                this.$axios.post(this.$API.Activity.deleteById, {'id': id})
                .then((res) => {
                    console.log(res.data.data)
                    that.$message.success("删除成功！")
                    that.tableData.splice(that.currentDeleteItem.index,1)
                })
                console.log("删除")
            },
            linkToDetail(row) {
                this.$router.push('/activity/edit/' + row.id)
            },
            getActivityTotal() {
                //获取活动总数
                let that = this
                this.$axios.get(this.$API.Activity.getCount)
                .then((res) => {
                    that.totalCloumn = parseInt(res.data.data)
                })
            },
            getPage(page, pageNum) {
                //获取第一页活动
                let that = this
                let data = {
                    page: page,
                    pageNum: pageNum
                }
                this.$axios.post(this.$API.Activity.getPage, data)
                .then((res) => {
                    for(var i in res.data.data) {
                        res.data.data.confirmDeleteVisible = false
                    }
                    that.tableData = res.data.data
                    that.tableDataBackup = that.tableData
                })
            },
            resetEditFlag(flag) {
                for(var i = 0; i < this.cate.length; i++) 
                    this.cate[i].editFlag = flag
            },
            handleCurrentChange(val){
                this.getPage(val, this.pageSize)
            },
            search(key){
                key = key.trim()
                let searchRes = []
                for(var i = 0; i < this.tableDataBackup.length; i++) {
                    if(this.tableDataBackup[i].brief.indexOf(key) != -1)
                        searchRes.push(this.tableDataBackup[i])
                }
                this.tableData = searchRes
            },
            handleEdit(index, row) {
                this.resetEditFlag(false)
                this.cate[index].editFlag = false
                console.log(this.cate)
                this.$message('编辑第'+(index+1)+'行');
            },
            handleDelete(index, row) {
                row.index = index
                this.currentDeleteItem = row
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            
        },
        watch: {
            searchKey(key) {
                if(key == "")
                    this.tableData = this.tableDataBackup
                else
                    this.search(key)
            }
        },
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