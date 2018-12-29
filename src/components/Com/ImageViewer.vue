<template>
    <div class="image-viewer" @click="onClose" :class="{'show': show}">
        <img :src="src">
    </div>
</template>

<script>
export default {
    methods: {
        onClose () {
            this.$emit("close")
        }
    },
    props: ['src', 'show']
}
</script>

<style scoped>
.image-viewer {
    display: none;
    background-color: rgba(0, 0, 0, 0.7);
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    text-align: center;
    z-index: 3;
    transition: all 0.5s ease;
}
.image-viewer img {
    max-height: 90%;
    max-width: 90%;
    z-index: 4;
    /* box-shadow: 0px 0px 6px 0px #ccc; */
    border: 1px solid #ddd;
    /* border-radius: .2rem; */
}
.show {
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
