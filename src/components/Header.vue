<template>
  <div class="header">
    <nav class="banner-mask" :style="'height:' + currentHeight + 'px'">
      <div class="container header">
        <p class="blogname">
          <a href="#">Hope in the things unseen.</a>
        </p>
        <p class="motto">对 未 知 充 满 期 待</p>
        <!-- 个人信息 -->
        <div class="myinfo">
          <!-- 头像 -->
          <div class="avatar">
            <img src="http://upy.iimt.me/avatar.jpg">
          </div>
        </div>
        <ul class="desc-tab">
          <li class="li-f">大学生</li>
          <li>浙江 · 绍兴</li>
          <li>JSer</li>
          <li class="li-e">可能是一只吃货</li>
        </ul>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  data() {
    return {
      currentHeight: 1000,
      fly: false
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
      document.addEventListener('DOMMouseScroll',this.scrollFunc, false)
      window.onmousewheel=document.onmousewheel = this.scrollFunc
    },
    scrollFunc(e) {
      e = e || window.event;
      let dir = ""

      if (e.wheelDelta) {//webkit
          if (e.wheelDelta>0) {
              dir = "up";
          } else {
              dir = "down";
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
    }
  },
  mounted() {
    this.getCurrentHeight()
    this.addListener()
  },
  components: {
    
  }
}
</script>
<style scoped>
</style>

