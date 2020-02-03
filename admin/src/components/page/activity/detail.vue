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
    <div class="hr"></div>
    <el-form>
      <el-form-item label="内容">
        <el-input
          type="textarea"
          :autosize="{ minRows: 4, maxRows: 4}"
          placeholder="有什么想说的?"
          v-model="data.content"
        ></el-input>
      </el-form-item>
      <el-form-item label="配图">
        <div
          class="img-item"
          v-for="(item, i) in images"
          :src="item"
          :key="i"
        >
          <img :src="item"/>
          <span class="delete-img" @click="deleteImg(item, i)"></span>
        </div>
      </el-form-item>
      <!-- <el-form-item>
        <el-input v-model="tempImage" placeholder="输入图片地址...">
          <template slot="append">
            <el-button @click="addImage">添加</el-button>
          </template>
        </el-input>
      </el-form-item> -->
      <el-form-item>
        <img-uploader v-model="tempImage" @uploaded="addImage"></img-uploader>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="handlePublish">提交</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import ImgUploader from "../../com/Uploader"
import { markdownEditor } from "vue-simplemde";
export default {
  data: function() {
    return {
      data: {
        content: "",
        images: ""
      },
      tempImage: "",
      images: [],
      isReEdit: false,
    };
  },
  mounted() {
    if (this.$route.params.hasOwnProperty('id')) {
      this.isReEdit = true;
      this.initData()
      console.log(2)
    }
  },
  methods: {
    deleteImg (item, i) {
      this.images.splice(i, 1)
    },
    initData () {
      this.$axios
        .post(this.$API.Activity.getById, {id: this.$route.params.id})
        .then(res => {
          this.data = res.data.data
          this.images = JSON.parse(this.data.images)
        })
    },
    addImage() {
      this.images.push(this.tempImage);
      this.tempImage = "";
    },
    handlePublish() {
      if (this.isReEdit) {
        this.edit();
      } else {
        this.publish();
      }
    },
    edit() {
      const that = this;
      this.data.images = JSON.stringify(this.images);
      this.$axios
        .post(this.$API.Activity.update, this.data)
        .then(res => {
          if (res.data.data >= 0) {
            //更新成功 跳转到文章
            this.$message({
              type: "success",
              message: "更新成功!"
            })
            this.$router.go(-1);
            return
          } else {
            //更新失败
            that.$message.error("更新失败！");
          }
          console.log(res.data.data);
        })
        .catch(err => {
          console.log(err);
          that.$message.error("更新失败！");
        });
    },
    publish() {
      const that = this;
      this.data.images = JSON.stringify(this.images);
      this.$axios
        .post(this.$API.Activity.add, this.data)
        .then(res => {
          console.log(res.data.data.id)
          if (res.ret == 200) {
            //发表成功 跳转到文章
            that.$message({
              type: "success",
              message: "发表成功!"
            })
            that.$router.go(-1);
            return
          } else {
            //发表失败
            that.$message.error("发表失败！");
          }
          console.log(res.data.data);
        })
        .catch(err => {
          console.log(err);
          that.$message.error("发表失败！");
        });
    },
    querySearch(queryString, cb) {
      var cates = this.cate;
      var results = [];

      for (var i in cates) {
        if (cates[i].name.indexOf(queryString) != -1)
          results.push({
            value: cates[i].name,
            id: cates[i].id
          });
      }
      cb(results);
    }
  },
  components: {
    markdownEditor,
    ImgUploader
  }
};
</script>

<style>
.img-item {
  position: relative;
  width: 10rem;
  height: 5.6rem;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  border: 2px solid #d7d7d7;
  border-radius: 0.2rem;
  padding: 0.2rem;
  margin: 0 .5rem;
  cursor: pointer;
}
.img-item img{
  height: 100%;
  width: 100%;
}
.img-item .delete-img::after {
  content: '-';
  color: #fff;
  font-size: 24px;
  position: absolute;
  right: 3px;
  top: -13px;
}
.img-item .delete-img {
  font-size: 18px;
  color: #fff;
  background-color: #F56C6C;
  border-radius: 50%;
  width: 14px;
  height: 14px;
  position: absolute;
  right: -5px;
  top: -5px;
  cursor: pointer;
  overflow: hidden;
}
</style>
