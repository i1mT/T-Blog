<template>
  <div class="img-uploader" @click="selectImg">
    <span class="add" v-if="src == ''">+</span>
    <img v-else :src="src">
    <form name="uploadForm" role="form" ref="form">
      <input type="file" @change="handleFileSelected" ref="file" name="file">
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      src: "",
      file: ""
    };
  },
  methods: {
    handleFileSelected(e) {
      console.log("image selected");
      let file = e.srcElement.files;
      this.doUpload(file);
    },
    selectImg() {
      let fileInput = this.$refs.file;
      fileInput.click();
    },
    doUpload() {
      this.upyunInit();
      console.log("正在开始上传...");
      let that = this
      upyun.upload("uploadForm", function(err, response, image) {
        if (err) console.error(err);
        console.log("返回信息：");
        console.log(response);
        console.log("图片信息：");
        console.log(image);
        if (image.code === 200 && image.message === "ok") {
            let waterMark =
            "!/watermark/text/aWltdC5tZQ==/font/helvetica/align/southeast//color/ffffff/opacity/80/size/28/border/33333333";
            image.absUrl = image.absUrl
            .toString()
            .replace("iimtimg.b0.upaiyun.com", "upy.iimt.me");

            that.$emit("input", image.absUrl)
            that.$emit("uploaded")
        }
      });
      return false;
    },
    upyunInit() {
      upyun.set("bucket", "iimtimg");
      upyun.set("form_api_secret", "nUckd70gkysSwdU9A5cu42TC+Qw=");
      // track uploading progress
      upyun.on("uploading", function(progress) {
        console.log("上传进度 " + progress + "%");
      });
    }
  },
  props: ["value"],
  watch: {
      value(now, old) {
          console.log(now)
          this.src = now
      }
  }
};
</script>

<style scpoed>
.img-uploader {
  width: 10rem;
  height: 6.5rem;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  border: 2px solid #d7d7d7;
  border-radius: 0.2rem;
  padding: 0.2rem;
  cursor: pointer;
}
.img-uploader img {
  height: 100%;
  width: 100%;
}
.img-uploader span.add {
  font-size: 2.8rem;
  color: #aaa;
}
.img-uploader input {
  display: none;
}
</style>
