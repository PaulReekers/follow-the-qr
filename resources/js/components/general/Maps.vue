<template>
  <div id="map"></div>
</template>

<script>
  export default {
    data() {
      return {
        map: false
      }
    },
    computed: {
      qrs() {
        return this.$store.getters.qrs;
      }
    },
    watch: {
      qrs() {
        this.loadMarkers();
      }
    },
    mounted() {
      if (this.hasGoogleObject()) {
          this.initGoogleMaps();
      } else {
          this.createGoogleMaps().then(this.initGoogleMaps, this.googleMapsFailedToLoad);
      }
    },
    methods: {
      loadMarkers: function() {
        var self = this;
        if (this.qrs.length > 0) {
          this.qrs.forEach(function(qr){
            var loc = [];
            qr.locations.forEach(function(location){
              loc.push({lat: location.lat, lng: location.lng});
            });

            var line = new google.maps.Polyline({
              path: loc,
              geodesic: true,
              strokeColor: qr.color,
              strokeOpacity: 1.0,
              strokeWeight: 2
            });
            line.setMap(self.map);
          });
        }
      },
      hasGoogleObject: function() {
          return (typeof google === 'object' && typeof google.maps === 'object');
      },
      createGoogleMaps: function(){
        return new Promise((resolve, reject) => {
          let gmap = document.createElement('script');
          gmap.src = `https://maps.googleapis.com/maps/api/js?key=${API_KEY}&libraries=geometry,visualization`;
          gmap.type = 'text/javascript';
          gmap.onload = resolve;
          gmap.onerror = reject;
          document.body.appendChild(gmap);
        });
      },
      googleMapsFailedToLoad: function(){
      },
      initGoogleMaps: function(){
        var styles = [
        {
          "stylers": [
            { "hue": "#005eff" },
            { "saturation": -94 }
          ]
        }
        ];

        var mapOptions = {
          styles: styles
        };

        this.map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 51.368769, lng: 5.252832},
            options: mapOptions,
            zoom: 10
        });
        this.loadMarkers();
      }
    }
  }
</script>

<style>
  #map {
    margin-top: 60px;
    height: auto;
    width: 100%;
    position: absolute;
    top: 0;
    bottom: 0;
  }
</style>
