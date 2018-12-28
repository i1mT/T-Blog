<template>
  <div class="about">
    <v-header :tab="true" title="All about me" vicetitle="关于我"></v-header>
    <div class="aboutme">
      <!-- <img src="http://upy.iimt.me/hx-avatar.jpg" class="avatar">
      <p class="name">iimT</p> -->
      <p class="motto">
          <div class="container">
            <v-article :content="aboutme"></v-article>
          </div>
      </p>
      <div class="social">
        <a href="http://weibo.com/ATmxj" target="_blank">
          <i class="iconfont">&#xe737;</i>
        </a>
        <a href="https://github.com/tfh93121" target="_blank">
          <i class="iconfont">&#xe677;</i>
        </a>
        <a href="https://www.zhihu.com/people/tao-feng-hua" target="_blank">
          <i class="iconfont">&#xe6ba;</i>
        </a>
        <a href="http://space.bilibili.com/69824765" target="_blank">
          <i class="iconfont">&#xe6b4;</i>
        </a>
      </div>
    </div>
    <v-footer></v-footer>
  </div>
</template>

<script>
import Header from "../Header";
import Footer from "../Footer";
import Article from "../Article/Article"
export default {
  data() {
      return {
          aboutme: ''
      }
  },
  methods: {},
  components: {
    "v-header": Header,
    "v-footer": Footer,
    'v-article': Article,
  },
  mounted () {
      let axios = this.$api.getInstance()
      axios.get("../../static/aboutme.md").then(res => {
          this.aboutme = res.data
      })
  }
};
</script>

<style>
.aboutme .motto {
    text-align: left;
}
</style>
