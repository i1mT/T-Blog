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
                <span v-for="tag in tags" :key="tag.id" class="cate">
                    <a :href="'/tag/' + tag.id">
                        <i class="iconfont">&#xe603;</i>
                        {{ tag.name }}
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
        defaultCover: "http://upy.iimt.me/blog-default-cover.jpg",
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
  props: ['title', 'time', 'cover', 'tags']
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

