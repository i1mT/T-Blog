<template>
  <div class="container article-list">
    <div class="art-card-container" style="background: ;background-size: cover;">
      <img class="art-cover" :src="cover || defaultCover">
      <div class="art-info">
        <p class="art-title">
          <a :href="'/article/' + aid">
            {{ title }}
          </a>
        </p>
        <div class="art-info-detail">
          <span class="art-viewed">
            <i class="iconfont">&#xe608;</i>
            {{ view }}
          </span>
          <span class="art-likes">
            <i class="iconfont">&#xe69c;</i>
            {{ like }}
          </span>
          <span class="art-time">
            <i class="iconfont">&#xe636;</i>
            {{ getTime(time) }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import formatTime from "../../static/formatTime.js"
export default {
  data() {
    return {
      defaultCover: "http://upy.iimt.me/blog-default-cover.jpg",
    }
  },
  methods: {
    getTime(time) {
      return formatTime.getDateDiff(time)
    }
  },
  props: ["title", "cover", "time", "like", "view", "aid"]
};
</script>
<style>
</style>

