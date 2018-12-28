<template>
  <nav class="article-nav banner-mask" :style="'background-image: url(' + (cover || defaultCover) + ')'">
    <div class="container">
        <div class="home">
            <a href="#" @click="home">
              <i class="iconfont">&#xf0247;</i>
            </a>
        </div>
        <div class="titles">
            <p class="title">
                {{ title }}
            </p>
            <p class="detail">
                <span class="cate">
                    <a :href="'/cate/' + cate.id + '?name=' + cate.name">
                        <i class="iconfont">&#xe603;</i>
                        {{ cate.name }}
                    </a>
                </span>
                <span class="time">
                    {{ getTime(time) }}
                </span>
            </p>
        </div>
    </div>
</nav>
</template>
<script>
import formatTime from "../../../static/formatTime.js"
export default {
  data() {
    return {
        defaultCover: "http://upy.iimt.me/2018/12/27/upload_11d64a6b4d372cb836fe107d63708308.jpg",
    }
  },
  methods: {
      back() {
          this.$router.go(-1)
      },
      home() {
          this.$router.push("/")
      },
      getTime(time) {
          return formatTime.getDateDiff(time)
      }
  },
  props: ['title', 'time', 'cover', 'cate', 'cid']
}  
</script>
<style>
.home a {
    text-decoration: none;
    color: #111;
    text-align: center;
    padding: .3rem;
}
.home a i {
    font-size: 3.5rem;
    line-height: 3.5rem;
}
.container .titles i.iconfont {
    font-size: 12px;
}
</style>

