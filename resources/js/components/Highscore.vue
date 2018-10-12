<template>
    <div id="highscore">
      <div class="page-header header-filter">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
              <div class="card card-login">
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">Highscore</h4>
                  </div>
                  <p class="description text-center"></p>
                  <div class="card-body">
                    <div v-for="qr in qrs">
                      <ui-icon icon="person_pin_circle" v-bind:style="{ color: qr.color }"></ui-icon> {{ qr.name }} {{ qr.distance.toFixed(2) }}km
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
