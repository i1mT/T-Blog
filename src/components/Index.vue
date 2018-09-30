<template>
  <div class="index">
    <v-header></v-header>
    <article-card v-for="article in articles" :key="article.id"
      :title="article.title" :cover="article.cover" :time="article.lastEdit"
      :like="article.likes" :view="article.viewed" :aid="article.id"></article-card>
    <ul class="load-more" @click="load">
      {{ moreText }}
    </ul>
    <v-footer></v-footer>
    <fly-top :height="1400"></fly-top>
  </div>
</template>
<script>
import header from "./Header"
import footer from "./Footer"
import ArticleCard from "./ArticleCard"
import FlyTop from "./FlyToTop"
export default {
  name: "Index",
  data() {
    return {
      page: 1,
      articles: [],
      nomore: false,
      moreText: "Load more"
    }
  },
  methods: {
    load() {
      if(this.nomore) return
      this.$api.getPage(this.page, 8).then( res => {
        this.articles.push.apply(this.articles, res.data.data)
        if(res.data.data.length == 0) this.nomore = true
        this.page++
      })
    },
  },
  mounted() {
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
