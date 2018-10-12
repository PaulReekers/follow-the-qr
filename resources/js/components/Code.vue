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
                <form class="form" v-if="!loading">
                  <div class="card-header card-header-primary text-center" v-bind:style="{background:qr.color}">
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
                    <a href="#" class="btn btn-primary btn-wd btn-lg" @click="save()">Save</a>
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
        coordinates: {},
        location: false,
      };
    },
    mounted() {
      this.code = this.$route.params.id;
      this.checkId();
    },
    methods: {
      save: function() {
        var self = this;
        if (this.location && this.code && this.gpsDescription !== '') {
          axios.post('/qr/' + this.code + '/location/' + this.location, {
            text: this.gpsDescription
          }).then(response => {
            this.$store.dispatch('UPDATE_QR');
            this.$router.push('/home');
          }, (err) =>{
            self.loading = true;
            self.error = 'Not saved';
          });
        }
      },
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
          this.error = 'Location could not be determined';
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
          this.location = response.data.id;
          this.$store.dispatch('UPDATE_QR');
        }, (err) => {
          this.error = 'Adding location is not allowed, try again later';
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
