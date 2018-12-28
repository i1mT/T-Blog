<template>
  <div class="index">
    <v-header :avatar="false" :tab="true" title="All about" :vicetitle="'「 ' + cate + ' 」'"></v-header>
    <template v-if="loading">
      <loading></loading>
    </template>
    <template v-else>
      <article-card v-for="article in articles"
        :key="article.id"
        :title="article.title"
        :cover="article.cover"
        :time="article.lastEdit"
        :like="article.likes"
        :view="article.viewed"
        :aid="article.id"
        :cate="article.cateName"
        :cid="article.cid"
      >
      </article-card>
      <ul class="load-more" @click="load">
        {{ moreText }}
      </ul>
    </template>
    <v-footer></v-footer>
    <fly-top :height="1400"></fly-top>
  </div>
</template>
<script>
import header from "../Header"
import footer from "../Footer"
import ArticleCard from "../ArticleCard"
import FlyTop from "../FlyToTop"
import Loading from "../Com/Loading"
export default {
  name: "Index",
  data() {
    return {
      loading: true,
      page: 1,
      articles: [],
      nomore: false,
      moreText: "Load more",
      pageSize: 6,
      cid: null,
      cate: '',
    }
  },
  methods: {
    load() {
      if(this.nomore) return
      let data = {
        page: this.page,
        pageNum: this.pageSize,
        cid: this.cid
      }
      if(this.cid) {
        data.cid = this.cid
      }
      this.$api.getPage(data).then( res => {
        console.log(res)
        this.loading = false
        this.articles.push.apply(this.articles, res.data.data)
        if(res.data.data.length == 0) this.nomore = true
        this.page++
      })
    },
  },
  mounted() {
    this.cid = this.$route.params.id
    this.cate = this.$route.query.name
    this.load()
  },
  watch: {
    nomore(now, old) {
      if(!old && now) {
        this.moreText = "No more"
      }
    }
  },
  components: {
    "v-header": header,
    ArticleCard: ArticleCard,
    "v-footer": footer,
    FlyTop: FlyTop,
    'loading':Loading,
  }
};
</script>
<style scoped>
.load-more {
  transform: translateY(18px);
  padding: 1.5rem 1rem;
  margin-bottom: 2rem;
  width: 12rem;
  background: #ccc;
  border-radius: .5rem;
  margin: 0 auto;
  cursor: pointer;
  text-align: center;
  color: #333;
  font-size: 1.7rem;
}
.load-more:hover {
  background: #d9d9d9;
}
</style>
