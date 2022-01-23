
<style>
    .map {        
            width: 400px;
            border-radius: 20px;
            height: 200px;
            float: left;
            margin: 10px;
        }
</style>
<br><br>
<div id="map" class="map"></div>
<div id="map2" class="map"></div>
<div id="googleMap" class="map"></div>
<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXbb-v0RvEbY5PYpp1HsPgRxDjVH8oAsM&callback=myMap&v=weekly"
      async
    ></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<br><br>
<script>
    var key = "gKkfcGHhQVDOMPAQUyyx"
    var latlng = [-79.542186, 41.239094]
    var map = new maplibregl.Map({
        container: 'map',
        style: `https://api.maptiler.com/maps/hybrid/style.json?key=${key}`,
        center: [-79.542186, 41.239094],
        zoom: 15
    });

    var marker = new maplibregl.Marker()
        .setLngLat([-79.542186, 41.239094])
        .addTo(map);  


    mapboxgl.accessToken = 'pk.eyJ1Ijoia2FyZWVtZmVsZmVsIiwiYSI6ImNreXE5eXFjaDBoczMydXBoYzZqMmV6Y2QifQ.-EdQsiDBt8SmkzlqJaWovQ';
    const map2 = new mapboxgl.Map({
    container: 'map2', // container ID
    style: 'mapbox://styles/mapbox/satellite-v9?optimize=true', // style URL
    center: [-79.542186, 41.239094], // starting position [lng, lat]
    zoom: 15 // starting zoom
    });
    var marker2 = new mapboxgl.Marker()
        .setLngLat([-79.542186, 41.239094])
        .addTo(map2); 


    function myMap() {
        const myLatLng = { lat: 41.239094, lng: -79.542186 };
        var mapProp= {
          center:new google.maps.LatLng(41.239094, -79.542186),
          zoom:18,
          mapTypeId: 'satellite'
        };
        var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        
          new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Hello World!",
          });
    }
</script>
</body>
</html>


