<template>
  <div class="container article-list">
    <div class="art-card-container" :class="{'code-card-container' : isCode}" :ref="aid">
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
          <span class="art-cate">
            <a :href="'/cate/' + cid + '?name=' + cate">
              {{ cate }}
            </a>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import formatTime from "../../../static/formatTime.js"
export default {
  data() {
    return {
      height: 500,
      defaultCover: "http://upy.iimt.me/2018/12/27/upload_11d64a6b4d372cb836fe107d63708308.jpg",
      codeCover: "http://upy.iimt.me/2019/08/21/upload_90e4b0610c6d38c6ec958bbb5629ac3d.png",
      // http://upy.iimt.me/2019/08/21/upload_e9a69e1d82d81ce9a72ce2d217265f25.png
      codeHeight: 140,
    }
  },
  methods: {
    getTime(time) {
      return formatTime.getDateDiff(time)
    },
  },
  props: ["title", "cover", "time", "like", "view", "aid", 'cate', 'cid'],
  mounted() {
  },
};
</script>
<style scoped>
.art-card-container {
  height: 100px;
}
.article-list .art-info {
  background: none;
  color: #000;
}
.code-card-container .art-info {
  background: none;
}
.art-info p {
  padding: 0;
  margin-left: -5px;
}
.art-info p a {
  color: #000;
}
.code-card-container .art-info p{
  padding: 0;
}
.code-card-container .art-info span {
  font-size: 1.3rem;
}
.code-card-container .art-info .art-title a {
  font-size: 2.5rem;
}
.code-card-container .art-info .art-info-detail {
  margin-bottom: .5rem;
}
.code-card-container .mark-code {
  position: relative;
  float: right;
  right: 0;
  top: 0;
  width: 5rem;
  height: 3rem;
  line-height: 3rem;
  text-align: center;
  font-size: 1.6rem;
  color: #000;
  background: rgba(240, 240, 240, 0.95)
}
</style>

