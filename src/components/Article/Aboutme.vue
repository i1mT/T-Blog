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
      motto: "我是iimT，大学生，技术宅，计算机科技爱好者，电音小王子。想看到我的更多更新的话，很乐意你关注我！",
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

