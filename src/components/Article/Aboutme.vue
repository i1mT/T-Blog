<template>
  <div class="aboutme">
        <img src="http://upy.iimt.me/hx-avatar.jpg" class="avatar">
        <p class="name">iimT</p>
        <p class="motto">
          {{ motto }}
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
</template>
<script>
export default {
  data() {
    return {
      motto: "大三计科狗，喜欢音乐、运动、编程，人生最大的快感来自于创造。目前致力于前端开发方向，坐标浙江绍兴，很乐意你与我交流。",
    }
  }
}
</script>
<style scoped>
.social a {
  color: #ccc;  text-decoration: none;

}
.social a i {
  font-size: 3rem;
  color: #333;
  margin: 0 1rem;
}
</style>

