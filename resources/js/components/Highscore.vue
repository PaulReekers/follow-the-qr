<template>
    <div id="highscore">
      <h1>Highscore</h1>
      <div v-for="qr in qrs">
        <ui-icon icon="person_pin_circle" v-bind:style="{ color: qr.color }"></ui-icon> {{ qr.name }} {{ qr.distance.toFixed(2) }}km</div>
    </div>
</template>

<script>
  import { UiIcon } from 'keen-ui';

  export default {
    computed: {
      qrs() {
        return this.$store.getters.qrsSorted;
      },
    },
    components: {
      UiIcon
    }
  }
</script>