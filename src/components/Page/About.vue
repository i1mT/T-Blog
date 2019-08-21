<template>
  <div class="about">
    <v-header :tab="true" title="All about me" vicetitle="关于我"></v-header>
    <div class="aboutme">
      <p class="motto">
          <div class="container">
            <v-article :content="aboutme"></v-article>
          </div>
      </p>
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
