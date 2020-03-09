<template>
  <div class="header" :style="'height:' + currentHeight">
    <nav class="banner-mask">
      <div class="container header">
        <p class="blogname" v-if="title">
          <a href="#">
            {{ title }}
          </a>
        </p>
        <p class="motto" v-if="vicetitle">
          {{ vicetitle}}
        </p>
        <!-- 个人信息 -->
        <div class="myinfo" v-if="avatar">
          <!-- 头像 -->
          <div class="avatar">
            <img src="http://upy.iimt.me/avatar.jpg">
          </div>
        </div>
        <ul class="desc-tab" v-if="tab">
          <li class="li-f">
            <router-link to="/">博客</router-link>
          </li>
          <li>
            <router-link to="/oj">刷题</router-link>
          </li>
          <li>
            <router-link to="/activity">动态</router-link>
          </li>
          <li>
            <a class="menu-item" href="https://github.com/i1mT" target="_blank">
                我的 <i class="iconfont">&#xe677;</i>
              </a>
          </li>
          <li>
            <a class="menu-item" href="https://space.bilibili.com/69824765" target="_blank">
                我的 <i class="iconfont">&#xe6b4;</i>
              </a>
          </li>
          <li>
            <a href="/about">关于我</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  data() {
    return {
      currentHeight: "60vh",
      fly: false,
    }
  },
  methods: {
    getCurrentHeight() {
      document.body.parentNode.style.overflowY = "hidden"
      let height = window.innerHeight||document.documentElement.clientHeight
        ||document.body.clientHeight
      this.currentHeight = height
    },
    addListener() {
      if (this.detechDevice()) {
        document.addEventListener('DOMMouseScroll',this.scrollFunc, false)
        window.onmousewheel=document.onmousewheel = this.scrollFunc
      } else {
        document.addEventListener("touchmove", this.scrollFunc, false)
      }
    },
    scrollFunc(e) {
      e = e || window.event;
      let dir = ""

      if (e.wheelDelta) {//webkit
          if (e.wheelDelta>0) {
              dir = "up"
          } else {
              dir = "down"
          }
      } else if (e.detail) {
          console.log(e.detail)
      }
      let h = document.documentElement.scrollTop || document.body.scrollTop
      if(h==0){
        document.body.parentNode.style.overflowY = "hidden"
      }
      if (h==0 && dir == "up") return
      document.body.parentNode.style.overflowY = "auto"
    },
    detechDevice () {
      let sUserAgent    = navigator.userAgent.toLowerCase()
      let bIsIpad       = sUserAgent.match(/ipad/i) == "ipad"
      let bIsIphoneOs   = sUserAgent.match(/iphone os/i) == "iphone os"
      let bIsMidp       = sUserAgent.match(/midp/i) == "midp"
      let bIsUc7        = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4"
      let bIsUc         = sUserAgent.match(/ucweb/i) == "ucweb"
      let bIsAndroid    = sUserAgent.match(/android/i) == "android"
      let bIsCE         = sUserAgent.match(/windows ce/i) == "windows ce"
      let bIsWM         = sUserAgent.match(/windows mobile/i) == "windows mobile"

      if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
          return false
      }else{
          return true
      }
    },
    handelProps () {
    }
  },
  mounted() {
  },
  components: {
  },
  props: ['avatar', 'tab', 'vicetitle', 'title']
}
</script>
<style scoped>
.header {
  margin-bottom: 2rem;
}
</style>