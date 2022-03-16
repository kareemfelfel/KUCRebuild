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
                    <strong class="tag">Purchase Date:</strong> {{lotInfo.purchaseDate != null ? lotInfo.purchaseDate : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Price:</strong> 
                    <span v-if="lotInfo.price != null"> ${{lotInfo.price}}</span>
                    <span v-else> N/A </span>
                </p>
            </div>
            <div class="col-md-6">
                <img class="image" :src="lotInfo.mainImage" alt="lotImage"/>
            </div>
        </div>

        <br>
        <hr>

        <div class="owner-info container">
            <h3 class="text-center"> Owner Information </h3>
            <hr class="hr">
            <br>
            <div v-if="lotInfo.owner != null">
                <p>
                    <strong class="tag">First Name:</strong> {{lotInfo.owner.firstName}}
                </p>
                <p>
                    <strong class="tag">Middle Name:</strong> {{lotInfo.owner.middleName != null? lotInfo.owner.middleName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Last Name:</strong> {{lotInfo.owner.lastName}}
                </p>
                <p>
                    <strong class="tag">Email:</strong> 
                    <a v-if="lotInfo.owner.email != null" :href="`mailto:${lotInfo.owner.email}`"> {{lotInfo.owner.email}}</a>
                    <span v-else> N/A </span>
                </p>
                <p>
                    <strong class="tag">Phone Number:</strong> 
                    <a v-if="lotInfo.owner.phoneNumber" :href="`tel:${lotInfo.owner.phoneNumber}`"> {{lotInfo.owner.phoneNumber}}</a>
                    <span v-else> N/A </span>
                </p>
                <p>
                    <strong class="tag">Address:</strong> {{lotInfo.owner.address != null? lotInfo.owner.address : "N/A"}}</a>
                </p>
                
                
            </div>
            <div v-else>
                <p class="text-center"> No Owner Associated </p>
            </div>
        </div>

        <br>
        <hr>

        <div class="buried-individuals-info container">
            <h3 class="text-center"> Buried Individuals Information </h3>
            <hr class="hr">
            <br>
            <div v-if="lotInfo.buriedIndividuals.length == 0">
                <p class="text-center"> No Buried Individuals Associated </p>
            </div>
            <div v-else 
                 v-for="(result, index) in lotInfo.buriedIndividuals"
                 :key="index">
                <h4>Buried Individual #{{index +1}} </h4>
                <hr class="bi-hr">
                <p>
                    <strong class="tag">First Name:</strong> {{result.firstName}}
                </p>
                <p>
                    <strong class="tag">Middle Name:</strong> {{result.middleName != null ? result.middleName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Last Name:</strong> {{result.lastName != null ? result.lastName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Nickname:</strong> {{result.nickname != null ? result.nickname : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Maiden Name:</strong> {{result.maidenName != null ? result.maidenName : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Date of Birth:</strong> {{result.dob != null ? result.dob : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Date of Death:</strong> {{result.dod != null ? result.dod : "N/A"}}
                </p>
                <p>
                    <strong class="tag">Veteran Status:</strong> {{result.veteran ? "Yes" : "No"}}
                </p>
                <p>
                    <strong class="tag" style="float: left;">Obituary:</strong> 
                    <p style="padding-left: 90px;">{{result.obituary != null ? result.obituary : "N/A"}}</p>
                </p>
                
                <hr v-if="index != lotInfo.buriedIndividuals.length - 1" class="bi-hr">
            </div>
        </div>

        <br>
        <hr>

        <div class="attachments-info container">
            <h3 class="text-center"> Attachments </h3>
            <hr class="hr">
            <div v-if="lotInfo.attachments.length == 0">
                <p class="text-center"> No Attachments Associated </p>
            </div>
            <ul v-else>
                <li v-for="(item, index) in lotInfo.attachments" :key="index">
                    <a :href="item.link" download>{{item.name}}</a>
                </li>
            </ul>
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

