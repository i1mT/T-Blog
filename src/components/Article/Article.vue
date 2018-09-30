<template>
  <div class="v-article">
    <!--  正文区域    -->
    <article class="markdown-body" v-html="html">
      {{ html }}
    </article>
    <ul class="reletive">
      <!-- 上下篇 -->
    </ul>
  </div>
</template>
<script>
export default {
  data() {
    return {
      html: "",
    }
  },
  methods: {
    getHtml(text) {
      let MD = require("markdown-it")()
      this.html = MD.render(text)
    },
  },
  mounted() {
    this.getHtml(this.content)
    // setTimeout( e => {
    //   this.content = "nothing"
    // }, 200) TODO: delete
  },
  watch: {
    content() {
      this.getHtml(this.content)
    }
  },
  directives: {
  },
  components: {},
  props: ["content"],
};
</script>
<style>
@import url("../../assets/markdown.css");
.like .text i {
  font-size: 2rem;
}
.markdown-body {
  font-size: 1.6rem;
  line-height: 1.9;
}
.markdown-body .highlight pre, .markdown-body pre {
  font-size: 17px;
  line-height: 180%;
}
</style>
