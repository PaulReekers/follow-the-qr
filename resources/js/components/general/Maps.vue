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
      },
      lastLoc() {
        return this.$store.getters.lastLoc;
      }
    },
    watch: {
      qrs() {
        this.loadMarkers();
      },
      lastLoc() {
        this.updateLoc();
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
      updateLoc: function() {
        this.map.setCenter(new google.maps.LatLng(this.lastLoc.lat,this.lastLoc.lng));
      },
      loadMarkers: function() {
        var self = this;
        if (this.qrs.length > 0) {
          this.qrs.forEach(function(qr){
            var loc = [];
            qr.locations.forEach(function(location){
              loc.push({lat: location.lat, lng: location.lng});

              var latLng = new google.maps.LatLng(location.lat, location.lng);
              var marker = new google.maps.Marker({
                  position: latLng,
                  optimized: false, //fixes markers flashing while bouncing
                  icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8,
                    strokeColor: qr.color
                  },
              });

              if (location.text) {
                var infowindow = new google.maps.InfoWindow({
                  content: location.text
                });
                marker.addListener('click', function() {
                  infowindow.open(self.map, marker);
                });
              }

              marker.setMap(self.map);
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
            zoom: 9
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
