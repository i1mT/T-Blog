<template>
  <div class="index">
    <v-header :avatar="false" :tab="true" title="My mood" vicetitle="我的动态"></v-header>
      <loading v-if="loading"></loading>
      <div v-else class="article">
      <div class="container">
        <article class="markdown-body">
          <!-- <h1>这里是我的另一个朋友圈</h1> -->
          <activity-card v-for="(item, i) in data" 
            :key="i" 
            :content="item.content" 
            :brief="item.brief"
            :time="item.ctime"
            :image="JSON.parse(item.images)"
          ></activity-card>
        </article>
      </div>
      </div>
      <ul class="load-more" @click="load">{{ moreText }}</ul>
    <v-footer></v-footer>
  </div>
</template>

<script>
import header from "../Header";
import footer from "../Footer";
import Loading from "../Com/Loading";
import ActicityCard from "./ActivityCard";
export default {
  data() {
    return {
      data: [],
      loading: true,
      moreText: "Load More",
      page: 1,
      pageSize: 10,
      noMore: false
    };
  },
  methods: {
    load() {
      if (this.noMore) {
        this.moreText = "No more";
        return;
      }
      let data = {
        page: this.page++,
        length: this.pageSize
      };
      this.$api.getActivity(data).then(res => {
        console.log(res);
        for (var i in res.data.data) {
          this.data.push(res.data.data[i]);
        }
        this.loading = false;
        if (res.data.data.length == 0) {
          this.noMore = true;
          this.moreText = "No more";
        }
      });
    }
  },
  components: {
    "v-header": header,
    "v-footer": footer,
    ActivityCard: ActicityCard,
    Loading: Loading
  },
  mounted() {
    this.load();
  }
};
</script>

<style>
@import url("../../assets/markdown.css");
.like .text i {
  font-size: 2rem;
}
.markdown-body {
  font-size: 1.6rem;
  line-height: 1.9;
  margin-top: 0;
}
.markdown-body .highlight pre, .markdown-body pre {
  font-size: 17px;
  line-height: 180%;
}
</style>
