<template>
  <div class="comment">

    <form class="comment">
      <div class="name">
        <span>昵称：</span>
        <input v-model="newComment.name" type="text" placeholder="你的名字">
      </div>
      <div class="email">
        <span>邮箱：</span>
        <input v-model="newComment.email" type="email" placeholder="留个邮箱">
      </div>
      <div class="site">
        <span>个人站点：</span>
        <input name="site" v-model="newComment.site" type="text" placeholder="不需要输入http://">
      </div>
      <textarea v-model="newComment.content" placeholder="你也有独到的见解和想法......"></textarea>
      <button @click="submitComment"
      :class="{'error': submitError}" type="button" :disabled="submitError">{{ submitText }}</button>
      <span class="status">{{ tips }}</span>
    </form>
    <ul class="comment-list">
      <div class="count">
        <span>
          共
          {{ comments.length }}
          个评论
        </span>
      </div>
      <a-comment v-for="item in comments"
      :key="item.id"    :id="item.id"     :site="item.site"
      :name="item.name" :time="item.commenttime" :content="item.content"
      :like="item.likes"></a-comment>
    </ul>
  </div>
</template>
<script>
import aComment from "./aComment"
export default {
  data() {
    return {
      comments: [],
      newComment: {
        name: "",
        site: "",
        email: "",
        content: "",
        articleid: this.$route.params.id,
      },
      commentBack: {
        name: "",
        site: "",
        email: "",
        content: "",
        articleid: this.$route.params.id,
      },
      submitText: "提交评论",
      timer: {},
      tips: "",
      submitError: false,
    }
  },
  methods: {
    getAllComments() {
      this.$api.getCommentsByAid(this.$route.params.id).then(res => {
        console.log(res)
        this.comments = res.data.data
      })
    },
    submitComment() {
      this.newComment.name = this.newComment.name.trim()
      this.newComment.email = this.newComment.email.trim()
      this.newComment.site = this.newComment.site.trim()
      this.newComment.content = this.newComment.content.trim()
      //验证
      if(this.newComment.name == "") {
        return this.setSubmitError("请留下你的名字")
      }
      if(this.newComment.email == "" || !this.validEmail(this.newComment.email)) {
        return this.setSubmitError("邮箱格式不正确")
      }
      if(this.newComment.content == "") {
        return this.setSubmitError("请输入评论内容")
      }
      if(this.newComment.site == "") this.newComment.site = "#"
      this.$api.addComment(this.newComment).then(res => {
        this.tips = "发表成功！"
        this.timer = setTimeout( e => {
          this.tips = ""
        }, 800)
        this.newComment = this.commentBack
        this.getAllComments()
      })
    },
    validEmail(email) {
      let emailReg = /[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?/i

      return emailReg.test(email)
    },
    setSubmitError(text) {
      clearInterval(this.timer)
      this.submitError = true
      this.tips = text
      this.timer = setInterval( e => {
        this.submitText = "提交评论"
        this.submitError = false
      }, 2000)
    }
  },
  mounted() {
    this.getAllComments()
  },
  components: {
    aComment,
  },
}
</script>
<style>
form.comment button.error {
  background: #ccc;
}
form.comment textarea {
  font-family: 'Exo';
}
</style>