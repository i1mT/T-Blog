<template>
    <div class="login-wrap">
        <div class="quote">
        </div>
        <div class="ms-login">
            <div class="ms-title">
                - Coding till die -
            </div>
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="0px" class="demo-ruleForm">
                <el-form-item prop="username">
                    <el-input v-model="ruleForm.username" placeholder="username"></el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" placeholder="password" v-model="ruleForm.password" @keyup.enter.native="submitForm('ruleForm')"></el-input>
                </el-form-item>
                <div class="login-btn">
                    <el-button type="primary" @click="submitForm('ruleForm')">登录</el-button>
                </div>
                <p style="font-size:12px;line-height:30px;color:#999;">Tips : 请勤奋更新。</p>
            </el-form>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                ccap: {
                    image_src: '',
                    code: ''
                },
                ruleForm: {
                    username: '',
                    password: '',
                    ccap: ''
                },
                rules: {
                    username: [
                        { required: true, message: '请输入用户名', trigger: 'blur' }
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' }
                    ],
                }
            }
        },
        methods: {
            submitForm(formName) {
                const that = this;
                that.$refs[formName].validate((valid) => {
                    if (valid) {
                        that.login(that.ruleForm.username, that.ruleForm.password, function (res) {
                            if(res) {
                                localStorage.setItem('ms_username',that.ruleForm.username);
                                that.$message.success("登陆成功！")
                                that.$router.push('/Situation');
                            } else {
                                that.$message.error("登陆失败！用户名或密码错误")
                            }
                        })
                    } else {
                        that.$message.error("请填写完整！")
                        return false;
                    }
                });
            },
            login(user,pwd, cb) {
                const that = this
                that.$axios.post(that.$API.Admin.login, {
                    'user': user,
                    'pwd': pwd
                }).then( (res) => {
                    console.log(res.data.data)
                    if(res.data.data==0 || res.data.data==1){
                        that.$axios.get(that.$API.Admin.isLogin)
                        .then((resp) => {
                            console.log(resp.data.data)
                            if(resp.data.data) {
                                cb(true)
                            } else {
                                cb(false)
                            }
                        })
                    } else {
                        cb(false)
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .login-wrap{
        position: relative;
        width:100%;
        height:100%;
        background: url("http://upy.iimt.me/blog-cover-1.jpg");
        background-size: 100% 100%;
    }
    .ms-title{
        position: absolute;
        top:50%;
        left:0;
        width:100%;
        padding: 0;
        margin-top: -115px;
        text-align: center;
        font-size: 30px;
        font:'Lato', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.2rem;
        color: #222;
    }
    .demo-ruleForm {
        margin-top: 40px;
    }
    .ms-login{
        position: absolute;
        left:50%;
        top:50%;
        width:320px;
        height:200px;
        margin:-200px 0 0 -190px;
        padding:40px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 0px 0px 10px 0px #888;
    }
    .login-btn{
        text-align: center;
    }
    .login-btn button{
        width:100%;
        height:36px;
    }
</style>