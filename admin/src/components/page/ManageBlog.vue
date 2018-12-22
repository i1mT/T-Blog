<template>
    <div>
        <div class="crumbs">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item><i class="el-icon-date"></i> 表单</el-breadcrumb-item>
                <el-breadcrumb-item>基本表单</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="form-box">
            <el-form ref="form" label-width="80px">
                <el-form-item label="博客名">
                    <el-input v-model="name"></el-input>
                </el-form-item>
                <el-form-item label="博客描述">
                    <el-input v-model="description"></el-input>
                </el-form-item>
                <el-form-item label="日期时间">
                    <el-col :span="11">
                        <el-date-picker
                        type="datetime"
                        placeholder="选择日期"
                        v-model="starttime"
                        format="yyyy 年 MM 月 dd 日 HH:mm:ss"
                        value-format="yyyy-MM-dd"
                        style="width: 100%;"></el-date-picker>
                    </el-col>
                </el-form-item>
                <el-form-item label="博客域名">
                    <el-input v-model="siteurl"></el-input>
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
                name: '',
                description: '',
                siteurl: '',
                starttime: '',
                time: ''
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
                    let blogInfo     = response.data.data
                    blogInfo.time    = blogInfo.starttime.substr(11)
                    this.name        = blogInfo.name
                    this.description = blogInfo.description
                    this.siteurl     = blogInfo.siteurl
                    this.starttime   = blogInfo.starttime
                    this.time        = blogInfo.time
                })
            },
            onSubmit() {
                this.starttime = this.formatDate(this.starttime)
                let that = this
                let blogInfo = {
                    name: this.name,
                    description: this.description,
                    siteurl: this.siteurl,
                    starttime: this.starttime,
                    time: this.time
                }
                this.$axios.post(this.$API.BlogInfo.update, blogInfo)
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