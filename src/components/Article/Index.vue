<template>
  <div class="article">
    <v-header :title="article.title" :time="article.lastEdit" :cate="article.cate[0]" :cover="article.cover"></v-header>
    <div class="container">
      <loading v-if="loading"></loading>
      <v-article v-else :content="article.content"></v-article>
      <like-admire :like="article.likes"></like-admire>
      <about-me></about-me>
      <comment></comment>
    </div>
    <fly-top :height="2000"></fly-top>
    <v-footer></v-footer>
  </div>
</template>
<script>
import header from "./Header"
import Article from "./Article"
import LikeAdmire from "./LikeAdmir"
import Comment from "../Comment/Index"
import AboutMe from "./Aboutme"
import FlyTop from "../FlyToTop"
import footer from "../Footer"
import Loading from "../Com/Loading"
export default {
  data() {
    return {
      loading: true,
      article: {
        id: 0,
        title: "",
        author: "",
        cate: [],
        comments: 0,
        cover: "",
        lastEdit: "2016-12-15 02:28:43",
        likes: 0,
        publishAt: "",
        viewed: "",
        content: "",
      }
    }
  },
  methods: {
    getArticle() {
      let id = this.$route.params.id
      this.$api.getArticleById(id).then( res => {
        this.article = res.data.data
        console.log(this.article)
        this.loading = false
        window.document.title = this.article.title + "- iimT的独立博客"
      })
    },
    addView() {
      this.$api.addArticleViewById(this.$route.params.id).then(res => {})
    }
  },
  mounted() {
    this.getArticle()
    this.addView()
  },
  watch: {
    $route () {
      this.getArticle()
    }
  },
  components: {
    'v-header': header,
    'v-article': Article,
    Comment: Comment,
    AboutMe: AboutMe,
    FlyTop: FlyTop,
    LikeAdmire: LikeAdmire,
    'v-footer': footer,
    'loading': Loading,
  }
}
</script>
<style>

</style>