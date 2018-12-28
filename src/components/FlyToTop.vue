<template>
  <div @click="toTop" class="fly-to-top" :class="{'show': fly}">
    <div></div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      fly: false,
      timer: {},
      curHeight: 0,
    }
  },
  methods: {
    addListener() {
      window.addEventListener('scroll', e => {
        let h = document.documentElement.scrollTop || document.body.scrollTop
        
        if (h > this.height) {
          this.fly = true
        } else {
          this.fly = false
        }
      })
    },
    toTop() {
      if(this.timer) clearInterval(this.timer)
      this.curHeight = document.body.scrollTop || document.documentElement.scrollTop

      this.timer = setInterval( e => {
        let h = this.curHeight
        h -= 200
        if(h <= 0) {
          h = 0
          this.curHeight = h
          clearInterval(this.timer)
        }
        this.curHeight = h
      }, 20)
    }
  },
  mounted() {
    this.addListener()
  },
  watch: {
    curHeight() {
      document.body.scrollTop = document.documentElement.scrollTop = this.curHeight
    }
  },
  props: ['height']
}
</script>
<style>
/*小火箭样式*/
.fly-to-top{
  position: fixed;
  bottom: 4rem;
  right: 4rem;
  width: 4rem;
  height: 0rem;
  opacity: 0;
  background: rgba(50,50,50,0.7);
  border-radius: .3rem;
  font-size: 5rem;
  overflow: hidden;
  cursor: pointer;
  transition: all .4s ease-in;
}
.fly-to-top div{
  width: 0;
  height: 0;
  top: 50%;
  left: 50%;
  position: relative;
  margin-left: -10px;
  margin-top: -19px;
  border-width: 10px;
  border-style: solid;
  border-bottom-left-radius: .2rem;
  border-bottom-right-radius: .2rem;
  border-bottom-width: 15px;
  border-color: transparent transparent #f7f2f2 transparent;
}
.show {
  height: 4rem;
  opacity: 1;
}
</style>