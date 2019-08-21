<template>
  <div class="like-admire">
    <!--社交-打赏等内容-->
    <div class="like" :class="{'liked': liked}" @click="likeArticle">
      <span class="text">
        <i class="iconfont">&#xe69c;</i>
        喜欢 ({{ like }})
      </span>
    </div>
    <div class="admired">赏</div>
    <img src="http://upy.iimt.me/2018/12/27/upload_3f73f42e9ada4fa0b9c2959d7719d8aa.png" class="admire">
    <p class="admired-tips">
      <em>可以请我喝可乐，如果本文对你有帮助的话。</em>
    </p>
  </div>
</template>
<script>
export default {
  data() {
    return {
      liked: false,
      id: this.$route.params.id,
    }
  },
  methods: {
    likeArticle() {
      if(this.liked) return
      let likes = JSON.parse(window.localStorage.getItem("tblog_article_likes"))
      if(!likes) {
        likes = [this.id]
      } else {
        likes.push(this.id)
      }
      likes = JSON.stringify(likes)
      window.localStorage.setItem("tblog_article_likes", likes)
      //发送请求
      this.doAddLike()
    },
    hasLike() {
      let likes = JSON.parse(window.localStorage.getItem("tblog_article_likes"))
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
      this.$api.addArticleLikeById(this.id).then( res => {
        this.liked = true
        this.like++
      })
    }
  },
  mounted() {
    this.hasLike()
  },
  props: ['like']
};
</script>
<style>
.like-admire {
  padding-top: 4rem;
}
.like-admire .like span.text {
  line-height: 3rem;
}
.like-admire .liked {
  background: rgb(234, 111, 90);
  color: #fff;
}
</style>

