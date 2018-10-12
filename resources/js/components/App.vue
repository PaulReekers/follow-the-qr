<template>
  <div>
    <topmenu></topmenu>
    <router-view class="router-main-view"></router-view>
  </div>
</template>

<script>
  import 'keen-ui/dist/keen-ui.css';
  import topmenu from './general/Menu.vue'

  export default {
    mounted() {
      this.$store.dispatch('UPDATE_QR');
    },
    components: {
      topmenu
    }
  }
</script>

<style>
.router-main-view {
  background: url(/img/bg.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>

