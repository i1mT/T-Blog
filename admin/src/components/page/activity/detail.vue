<template>
  <div>
    <div class="crumbs">
      <el-breadcrumb separator="/">
        <el-breadcrumb-item>
          <i class="el-icon-date"></i> 动态
        </el-breadcrumb-item>
        <el-breadcrumb-item>发布</el-breadcrumb-item>
      </el-breadcrumb>
    </div>
    <el-form>
      <el-form-item>
        <markdown-editor v-model="data.content" :configs="configs" ref="markdownEditor"></markdown-editor>
      </el-form-item>
      <el-form-item label="配图">
        <img class="img-item" v-for="(item, i) in images" :src="item" :key="i">
      </el-form-item>
      <el-form-item>
        <el-input v-model="tempImage" placeholder="输入图片地址...">
          <template slot="append">
            <el-button @click="addImage">添加</el-button>
          </template>
        </el-input>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="handlePublish">发表</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
    import { markdownEditor } from 'vue-simplemde';
    export default {
        data: function(){
            return {
                data: {
                    content: '',
                    images: '',
                },
                tempImage: '',
                images: [],
                content:'',
                isReEdit: false,
                configs: {
                    status: true,
                    initialValue: '想说点什么?',
                    renderingConfig: {
                        codeSyntaxHighlighting: true,
                        highlightingTheme: 'atom-one-light'
                    }
                }
            }
        },
        mounted(){
            //DOM挂载之后 判断是否传入了已经发表的文章
            //如果是 就将此文章信息填入 开始编辑文章
            if(this.$route.query.data) {
                this.isReEdit = true
                this.data = this.$route.query.data
                this.configs.initialValue = this.data.content
            }
        },
        methods: {
            addImage () {
                this.images.push(this.tempImage)
                this.tempImage = ''
            },
            handlePublish () {
                if (this.isReEdit) {
                    this.edit()
                } else {
                    this.publish()
                }
            },
            edit () {
                const that = this
                this.data.images = JSON.stringify(this.images)
                this.$axios.post(this.$API.Activity.update,this.data)
                .then((res) => {
                    if(res.data.data.id) {
                        //更新成功 跳转到文章
                        this.$message({
                            type: 'success',
                            message: '更新成功!'
                        }).then(() => {
                            this.$router.go(-1)
                        });
                        that.$router.push({name:'publishSuccess',params:{data:res.data.data}})
                    } else {
                        //更新失败
                        that.$message.error("更新失败！")
                    }
                    console.log(res.data.data)
                })
                .catch((err) => {
                    console.log(err)
                    that.$message.error("更新失败！")
                })
            },
            publish() {
                const that = this
                this.data.images = JSON.stringify(this.images)
                this.data.cate = this.data.cateName
                this.$axios.post(this.$API.Activity.add,this.data)
                .then((res) => {
                    if(res.data.data.id) {
                        //发表成功 跳转到文章
                        this.$message({
                            type: 'success',
                            message: '发表成功!'
                        }).then(() => {
                            this.$router.go(-1)
                        });
                        that.$router.push({name:'publishSuccess',params:{data:res.data.data}})
                    } else {
                        //发表失败
                        that.$message.error("发表失败！")
                    }
                    console.log(res.data.data)
                })
                .catch((err) => {
                    console.log(err)
                    that.$message.error("发表失败！")
                })
            },
            querySearch(queryString, cb) {
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

<style>
img.img-item {
  width: 100px;
  margin: 0 5px;
  border: 2px solid #fff;
  box-shadow: 1px 1px 4px 1px #aaa;
  border-radius: 6px;
}
</style>
