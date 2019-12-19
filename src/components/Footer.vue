<template>
  <footer class="foot">
    <p>iimT的独立博客 <a href="#">@iimT</a></p>
    <p>友情链接 <a class="add-friends" @click="applyFriends">申请友链</a></p>
    <p class="friends">
      <a v-for="item in friends" :key="item.id" :href="item.url">
        <template v-if="item.status == 1">
          {{ item.title }}
        </template>
      </a>
    </p>
    <p>
      CDN 支持 by
      <a href="https://www.upyun.com/" target="_blank">Upyun</a>
      又拍云
    </p>
    <p>
      Power by
      <a href="https://github.com/tfh93121/T-Blog" target="_blank">T-Blog</a>
      | Designed by
      <a href="#">iimT</a>
    </p>
    <p><a href="www.miitbeian.gov.cn">浙ICP备17000556号</a></p>
    <div v-if="dialogShow" class="mask">
      <div class="form-wrapper">
        <p>申请友链</p>
        <input type="text" v-model="title" placeholder="友链标题">
        <input type="text" v-model="url" placeholder="友链地址(带http)">
        <p class="hint">{{hint}}</p>
        <button type="button" @click="submitFriends">{{ btnContent }}</button>
        <button type="button" @click="hideDialog" class="cancel">取消</button>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    console.log("IIMT!")
    return {
      dialogShow: false,
      title: '',
      url: '',
      btnContent: '提交',
      friends: [],
      hint: ''
    }
  },
  methods: {
    applyFriends () {
      this.dialogShow = true
    },
    submitFriends () {
      this.hint = ''
      this.url = this.url.trim()
      this.title = this.title.trim()
      if(this.btnContent == "已提交") return
      if(this.url == '' || this.title == '') {
        this.hint = "标题或地址不能为空！"
        return
      }
      if(!this.checkUrl(this.url)) {
        this.hint = '请填入正确的url'
        return
      }
      let data = {
        title: this.title,
        url: this.url
      }
      this.$api.addFriend(data).then(res => {
        console.log(res)
        this.btnContent = "已提交"
        setTimeout(e => {
          this.title = ''
          this.url = ''
          this.dialogShow = false
        }, 1000)
      })
    },
    hideDialog (e) {
      this.dialogShow = false
    },
    getAllFriends () {
      this.$api.getAllFriends().then(res => {
        console.log(res)
        this.friends = res.data.data
      })
    },
    checkUrl(urlString){
      var reg=/(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?/;
      if(!reg.test(urlString)){
        return false
      }
      return true
    }
  },
  mounted () {
    this.getAllFriends()
  }
}  
</script>
<style scoped>
.mask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.5);
}
.mask .form-wrapper p.hint {
  font-size: 1.4rem;
  color: #ff4f66;
}
.mask .form-wrapper {
  border-radius: 8px;
  background: #fff;
  background: linear-gradient(130deg, #fff, #f2f3f6);
  -webkit-box-shadow: 0 25px 60px rgba(64, 72, 90, 0.2),
    0 0 30px rgba(0, 0, 0, 0.1);
  box-shadow: 0 25px 60px rgba(64, 72, 90, 0.2), 0 0 30px rgba(0, 0, 0, 0.1);
  color: #2f2c2c;
  padding: 4rem;
  padding-top: 1rem;
  position: relative;
  top: -6rem;
}
.mask .form-wrapper p {
  font-size: 1.8rem;
  color: #495057;
  text-align: left;
  padding-bottom: 2rem;
}
.mask .form-wrapper input {
  display: block;
  margin: 1rem 0;
  width: 30rem;
  height: calc(2.25rem + 2px);
  padding: 0.5rem 1rem;
  font-size: 1.5rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  -webkit-transition: border-color 0.15s ease-in-out,
    -webkit-box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out,
    -webkit-box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out,
    -webkit-box-shadow 0.15s ease-in-out;
}
.mask .form-wrapper button {
  padding: 0.7rem 1.3rem;
  font-size: 1.5rem;
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
  border-radius: 4px;
  border: 1px solid transparent;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
  outline: none;
  float: right;
}
.mask .form-wrapper button.cancel {
  background-color: #cdcdcd;
  margin-right: 1rem;
}
.foot {
  font-size: 1.2rem;
}
.friends {
  padding: 3px 0;
}
footer .friends a {
  margin: 0 5px;
  text-decoration: underline;
  
  display: inline-block;
  color: #ccc;
}
.add-friends {
  padding: 0 5px;
  background-color: #ddd;
  color: #333;
  text-shadow: none;
  border-radius: 3px;
  cursor: pointer;
}
</style>

