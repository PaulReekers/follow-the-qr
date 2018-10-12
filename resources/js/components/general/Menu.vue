<template>
    <div id="menu">
      <ui-toolbar></ui-toolbar>
    </div>
</template>

<script>
  import { UiMenu, UiIconButton, UiToolbar } from 'keen-ui';

  export default {
    components: {
      UiToolbar
    }
  }
</script>

<style>
  #menu {
    background-color: #DDD;
  }

  #logo {
    float: left;
  }

  #slogan {
  }
</style>