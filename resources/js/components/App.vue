<template>
  <div>
    <topmenu></topmenu>
    <router-view class="router-main-view"></router-view>
  </div>
</template>

<script>

  import topmenu from './general/Menu.vue'

  export default {
    mounted() {
    },
    components: {
      topmenu
    }
  }
</script>
