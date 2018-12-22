<template>
  <li>
    <a :href="site" target="_blank">
      {{ name }} :
    </a>
    <p class="comment-con">
      {{ content }}
    </p>
    <span class="time">
      {{ time }}
    </span>
    <span class="comment-like" @click="likeComment">
      <i v-if="liked" class="iconfont">&#xe61e;</i>
      <i v-else class="iconfont">&#xe69c;</i>
      <span class="num">
        {{ commentLike }}
      </span>
    </span>
  </li>
</template>
<script>
export default {
  data() {
    return {
      liked: false,
      commentLike: this.like,
    }
  },
  methods: {
    likeComment() {
      if(this.liked) return
      let likes = JSON.parse(window.localStorage.getItem("tblog_comment_likes"))
      if(!likes) {
        likes = [this.id]
      } else {
        likes.push(this.id)
      }
      likes = JSON.stringify(likes)
      window.localStorage.setItem("tblog_comment_likes", likes)
      //发送请求
      this.doAddLike()
    },
    hasLike() {
      let likes = JSON.parse(window.localStorage.getItem("tblog_comment_likes"))
      if(!likes) return
      let aid = this.id
      for(var i in likes) {
        if(parseInt(likes[i]) == parseInt(aid)) {
          this.liked = true
          break
        }
      }
    },
    doAddLike() {
      this.$api.addCommentLikeById(this.id).then( res => {
        this.liked = true
        this.commentLike++
      })
    }
  },
  mounted() {
    this.hasLike()
  },
  watch: {
    like() {
      this.commentLike = this.like
    }
  },
  props: ["id","name", "content", "time", "like", "site"]
}
</script>
<style>
</style>

