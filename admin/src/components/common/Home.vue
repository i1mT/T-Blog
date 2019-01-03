<template>
    <div class="wrapper">
        <v-head></v-head>
        <v-sidebar></v-sidebar>
        <div class="content">
            <transition name="move" mode="out-in"><router-view></router-view></transition>
        </div>
    </div>
</template>

<script>
    import vHead from './Header.vue';
    import vSidebar from './Sidebar.vue';
    export default {
        components:{
            vHead, vSidebar
        }
    }
</script>

<style>
@media screen and (max-width: 600px) {
    .user-info {
        display: none;
    }
    .sidebar {
        display: none;
    }
    .content {
        left: 0;
    }
}
</style>

