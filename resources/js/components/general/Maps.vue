<template>
  <div id="map"></div>
</template>

<script>
  export default {
    data() {
      return {
        map: false,
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
