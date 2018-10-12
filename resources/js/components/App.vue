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
    },
    components: {
      topmenu
    }
  }
</script>
