<template>
  <div class="container article-list">
    <div class="art-card-container" :ref="aid" :style="'height:' + height + 'px'">
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
      height: 500,
      defaultCover: "http://upy.iimt.me/2018/12/27/upload_11d64a6b4d372cb836fe107d63708308.jpg",
    }
  },
  methods: {
    getTime(time) {
      return formatTime.getDateDiff(time)
    },
    resizeCardHeight () {
      let card = this.$refs[this.aid]
      let img = card.firstChild
      img.onload = e => {
        let imgHeight = img.offsetHeight
        this.height = imgHeight
        console.log(img.offsetHeight)
      }
    }
  },
  props: ["title", "cover", "time", "like", "view", "aid"],
  mounted() {
    
    this.resizeCardHeight()
  },
};
</script>
<style>
</style>

