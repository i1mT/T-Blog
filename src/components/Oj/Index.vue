<template>
  <div class="index">
    <v-header :avatar="false" :tab="true" title="Hope in the things unseen." vicetitle="对 未 知 充 满 期 待"></v-header>
    <template v-if="loading">
      <loading></loading>
    </template>
    <template v-else>
      <oj-card v-for="article in articles"
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
      </oj-card>
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
import FlyTop from "../FlyToTop"
import Loading from "../Com/Loading"
import OjCard from '../Com/OjCard.vue'
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
    }
  },
  methods: {
    load() {
      if(this.nomore) return
      let data = {
        page: this.page,
        pageNum: this.pageSize,
        cid: 37, // 这里写死，所有刷题分类的都放在此页面下
      }
      this.$api.getPage(data).then( res => {
        this.loading = false
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
    "v-footer": footer,
    FlyTop: FlyTop,
    'loading':Loading,
    'oj-card': OjCard
  }
};
</script>
<style scoped>

</style>
