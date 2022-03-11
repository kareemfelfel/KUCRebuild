<?php

/* 
 * this file is accessed by the public and by admins as well.
 * 
 * Admins should be able to navigate to:
 *  1. Edit Tomb (for all fields)
 *  2. Download Deed
 * 
 *
 * 
 * BACK-END notes : TODO update these notes based on client needs
 * Users can also delete plots from this page. Deleting a plot should:
 *  1. DELETE all information associated with a plot (buried individual and owner)
 *      - This should not change the SQL logic as the table should automatically
 *          have "on cascade delete". You should only delete the plot from the table.
 *  2. deleting a buried individual should not delete the plot.
 *      The plot can remain with no data about buried individual.
 * 
 * 3. deleting an owner is only possible if the plot is changed to open
 */
?>
<div id="viewTombApp" class="container-fluid">
    <div v-if="!loading">
        <br>
        <hr>

        <div class="lot-info container">
            <h3 class="text-center"> Lot Information </h3>
            <hr class="hr">
            <br>
            <div class="col-md-6">
                <br><br>
                <p>
                    <strong class="tag">Location:</strong>  {{lotInfo.location}}
                </p>
                <p>
                    <strong class="tag">Has Open Plots:</strong> {{lotInfo.hasOpenPlots ? "Yes" : "No"}}
                </p>
                <p>
                    <strong class="tag">For Sale:</strong> {{lotInfo.forSale ? "Yes" : "No"}}
                </p>
                <p>
                    <strong class="tag">Purchase Date:</strong> {{lotInfo.purchaseDate}}
                </p>
                <p>
                    <strong class="tag">Price:</strong> ${{lotInfo.price}}
                </p>
            </div>
            <div class="col-md-6">
                <img class="image" :src="lotInfo.mainImage" alt="lotImage"/>
            </div>
        </div>

        <br>
        <hr>

        <div class="owner-info">
            <h3 class="text-center"> Owner Information </h3>
            <hr class="hr">
        </div>

        <br>
        <hr>

        <div class="buried-individuals-info">
            <h3 class="text-center"> Buried Individuals Information </h3>
            <hr class="hr">
        </div>

        <br>
        <hr>

        <div class="attachments-info">
            <h3 class="text-center"> Attachments </h3>
            <hr class="hr">
        </div>

        <br>
        <hr>
    </div>

    <div class="map">
        <h3 class="text-center"><span class="fa fa-map-marker"></span> Location on Map </h3>
        <hr class="hr">
        <div id="googleMap" class="map">
            <!-- GMAP API -->
        </div>
        <br><br>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="../view/tomb/viewTomb/viewTomb.css">
<!-- GMAP Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXbb-v0RvEbY5PYpp1HsPgRxDjVH8oAsM&v=weekly"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script>
    new Vue({
        el: "#viewTombApp",
        data:{
            id: null,
            lotInfo: null,
            map: null,
            marker: null,
            loading: false,
            openMarkerIcon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
        },
        created(){
            this.loading = true
            this.getId();
            this.getLotInfo();
        },
        methods:{
           getId(){
               let uri = window.location.href.split('?');
                if(uri.length == 2) {
                  let vars = uri[1].split('&');
                  let getVars = {};
                  let tmp = '';
                  vars.forEach(function(v) {
                    tmp = v.split('=');
                    if(tmp.length == 2)
                      getVars[tmp[0]] = tmp[1];
                  });
                  this.id = getVars['id'];
                }
           },
           getLotInfo(){
               this.loading = true
               $.getJSON("controller.php",
                {
                    action: "fetchTombById",
                    id: this.id
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result[0]))
                    this.lotInfo = data
                    this.loadMap();
                    this.setMapMarker();
                }).always( () => {
                    this.loading = false
                });
           },
           setMapMarker(){
               this.marker = new google.maps.Marker({
                position: {lat: this.lotInfo.latitude, lng: this.lotInfo.longitude},
                map: this.map
              });
              if(this.lotInfo.forSale){
                  this.marker.setIcon(this.openMarkerIcon);
              }
           },
           loadMap(){
               const cemetery = { lat: this.lotInfo.latitude, lng: this.lotInfo.longitude };
                var mapProp= {
                  center:new google.maps.LatLng(cemetery.lat, cemetery.lng),
                  zoom:19,
                  mapTypeId: 'satellite'
                };
                this.map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
           }
        }
    });
   
</script>

