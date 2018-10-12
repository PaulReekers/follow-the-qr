<template>
    <div id="code">
      <div class="page-header header-filter">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 ml-auto mr-auto">
              <div class="card card-login">
                <div v-if="loading && !error">
                  <div class="card-header card-header-primary text-center">
                    Loading....
                  </div>
                </div>
                <div v-if="error">
                  <div class="card-header card-header-primary text-center">
                    {{ error }}
                  </div>
                </div>
                <form class="form" method="" action="" v-if="!loading">
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">Great you are part of {{ qr.name }}</h4>
                  </div>
                  <p class="description text-center">{{ coordinates.lat }}, {{ coordinates.lat }}</p>
                  <div class="card-body">
                    <div class="input-group">
                        <ui-textbox
                    enforce-maxlength
                    help="Maximum 140 characters"
                    label="Leave a message for others to see"
                    placeholder=""
                    icon="short_text"

                    :multi-line="true"
                    :maxlength="140"

                    v-model="gpsDescription"
                ></ui-textbox>
                    </div>

                  </div>
                  <div class="footer text-center">
                    <a href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Add your location</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
  import { UiTextbox } from 'keen-ui';

  export default {
    data() {
      return {
        gpsDescription: '',
        loading: true,
        error: false,
        code: false,
        coordinates: {}
      };
    },
    mounted() {
      this.code = this.$route.params.id;
      this.checkId();
    },
    methods: {
      checkId: function() {
        var self = this;
        axios.get('/qr/' + this.code).then(response => {
          self.qr = response.data;
          this.getLocation();
        }, (err) => {
          self.error = 'Wrong QR';
        });
      },
      getLocation: function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(this.showPosition);
        } else {
          self.error = 'Location could not be determined';
        }
      },
      showPosition: function(position) {
        this.coordinates.lat = position.coords.latitude;
        this.coordinates.lng = position.coords.longitude;

        axios.post('/qr/' + this.code + '/location', {
          lat: this.coordinates.lat,
          lng: this.coordinates.lng
        }).then(response => {
          this.loading = false;
          this.$store.dispatch('UPDATE_QR');
        }, (err) => {
          self.error = 'Not allowed';
        });
      }
    },
    components: {
        UiTextbox
    }
  }
</script>

<style>
</style>
