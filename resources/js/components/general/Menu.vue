<template>
    <div id="menu">
      <ui-toolbar class="navbar navbar-inverse navbar-expand-lg bg-dark">
        <div slot="icon">
          <ui-icon-button
            color="white"
            has-dropdown
            type="default"
            icon="menu"
            ref="menu"
            size="large"
          >
            <ui-menu
              contain-focus
              has-icons
              slot="dropdown"
              :options="menuOptions"
              @close="$refs.menu.closeDropdown()"
              @select="selectMenuitem"
            ></ui-menu>
          </ui-icon-button>
        </div>
        <div slot="default">
          <a id="logo" href="/">Follow the QR</a>
        </div>
      </ui-toolbar>
    </div>
</template>

<script>
  import { UiMenu, UiIconButton, UiToolbar } from 'keen-ui';

  export default {
    data() {
      return {
        menuOptions: [
          {label: 'Map', id: 'home', icon: 'place'},
          {label: 'Highscore', id: 'highscore', icon: 'stars'},
          {label: 'How it works', id: 'howitworks', icon: 'help_outline'},
        ]
      }
    },
    methods: {
      selectMenuitem: function(item) {
        switch (item.id) {
        case "home":
          this.$router.push('/home');
          break;
        case "howitworks":
          this.$router.push('/howitworks');
          break;
        case "highscore":
          this.$router.push('/highscore');
          break;
        }
      }
    },
    components: {
      UiToolbar,
      UiMenu,
      UiIconButton
    }
  }
</script>
<style>
  a#logo{
    color: white;
  }
</style>
