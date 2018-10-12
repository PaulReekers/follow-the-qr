<template>
    <div id="menu">
      <ui-toolbar>
        <div slot="icon">
          <ui-icon-button
            color="black"
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
          Follow the QR
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
          {label: 'Why', id: 'why', icon: 'help_outline'},
        ]
      }
    },
    methods: {
      selectMenuitem: function(item) {
        switch (item.id) {
        case "home":
          this.$router.push('/home');
          break;
        case "why":
          this.$router.push('/why');
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

<<<<<<< Updated upstream
<style lang="scss">
</style>
=======
<style>
</style>
>>>>>>> Stashed changes
