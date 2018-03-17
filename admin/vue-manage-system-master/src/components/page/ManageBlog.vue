<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-date"></i> 表单</el-breadcrumb-item>
                <el-breadcrumb-item>基本表单</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="form-box">
            <el-form ref="form" :model="blogInfo" label-width="80px">
                <el-form-item label="博客名">
                    <el-input v-model="blogInfo.name"></el-input>
                </el-form-item>
                <el-form-item label="博客描述">
                    <el-input v-model="blogInfo.description"></el-input>
                </el-form-item>
                <el-form-item label="日期时间">
                    <el-col :span="11">
                        <el-date-picker
                        type="datetime"
                        placeholder="选择日期"
                        v-model="blogInfo.starttime"
                        format="yyyy 年 MM 月 dd 日 HH:mm:ss"
                        value-format="yyyy-MM-dd"
                        style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="博客域名">
                    <el-input v-model="blogInfo.siteurl"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit">修改</el-button>
                    <el-button>取消</el-button>
                </el-form-item>
            </el-form>
        </div>

    </div>
</template>

<script>
    import Moment from 'moment'

    export default {
        data: function() {
            return {
                blogInfo: {
                    name: '',
                    description: '',
                    siteurl: '',
                    starttime: '',
                    time: ''
                }
            }
        },
        mounted() {
            this.getBlogInfo()
        },
        methods: {
            getBlogInfo() {
                //获取博客信息
                let that = this
                this.$axios.get(this.$API.BlogInfo.getInfo)
                .then( (response) => {
                    console.log(response)
                    that.blogInfo = response.data.data[0]
                    that.blogInfo.time = that.blogInfo.starttime.substr(11)
                })
            },
            onSubmit() {
                this.blogInfo.starttime = this.formatDate(this.blogInfo.starttime)
                let that = this
                this.$axios.post(this.$API.BlogInfo.update, this.blogInfo)
                .then((response) => {
                    if(response.data.data == 1)
                        that.$message.success('修改成功！')
                    else if(response.data.data == 0)
                        that.$message.warning("博客信息无变化！")
                    else
                        that.$message.error("修改失败！")
                })
            },
            formatDate(date) {
                return Moment(date).format("YYYY-MM-DD HH:mm:ss")
            }
        }
    }
</script>