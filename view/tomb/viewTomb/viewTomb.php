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
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Lot:</strong>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <b>{{lotInfo.location}}</b>
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Plot #:</strong>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <b>{{lotInfo.plotNumbers.join(", ")}}</b>
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Has Open Plots:</strong>
                    </div>
                    <div class="col-md-8 col-sm-8 col-6">
                        {{lotInfo.hasOpenPlots ? "Yes" : "No"}}
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">For Sale:</strong> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        {{lotInfo.forSale ? "Yes" : "No"}}
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Purchase Date:</strong> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        {{lotInfo.purchaseDate != null ? lotInfo.purchaseDate : "N/A"}}
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Price:</strong>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6">
                        <span v-if="lotInfo.price != null"> ${{lotInfo.price}}</span>
                        <span v-else> N/A </span>
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-4 col-sm-4 col-6">
                        <strong class="tag">Notes:</strong>
                    </div>
                    <div class="col-md-8 col-sm-8 col-6">
                        <pre>{{lotInfo.notes != null? lotInfo.notes : "N/A"}}</pre>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-6 text-center image-wrapper">
                <img class="image" :src="lotInfo.mainImage" alt="lotImage"/>
            </div>
        </div>

        <br>
        <hr>

        <div class="owner-info container">
            <h3 class="text-center"> Owner Information </h3>
            <hr class="hr">
            <div v-if="lotInfo.owner != null">
                <br>
                <div class="row padded-row">
                    <div class="col-md-2 col-sm-2 col-6">
                        <strong class="tag">First Name:</strong>
                    </div>
                    <div class="col-md-10 col-sm-10 col-6">
                        {{lotInfo.owner.firstName}}
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-2 col-sm-2 col-6">
                        <strong class="tag">Middle Name:</strong> 
                    </div>
                    <div class="col-md-10 col-sm-10 col-6">
                        {{lotInfo.owner.middleName != null? lotInfo.owner.middleName : "N/A"}}
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-2 col-sm-2 col-6">
                        <strong class="tag">Last Name:</strong>
                    </div>
                    <div class="col-md-10 col-sm-10 col-6">
                        {{lotInfo.owner.lastName}}
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-2 col-sm-2 col-6">
                        <strong class="tag">Email:</strong> 
                    </div>
                    <div class="col-md-10 col-sm-10 col-6">
                        <a v-if="lotInfo.owner.email != null" :href="`mailto:${lotInfo.owner.email}`"> {{lotInfo.owner.email}}</a>
                        <span v-else> N/A </span>
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-2 col-sm-2 col-6">
                        <strong class="tag">Phone Number:</strong> 
                    </div>
                    <div class="col-md-10 col-sm-10 col-6">
                        <a v-if="lotInfo.owner.phoneNumber" :href="`tel:${lotInfo.owner.phoneNumber}`"> {{lotInfo.owner.phoneNumber}}</a>
                        <span v-else> N/A </span>
                    </div>
                </div>
                <div class="row padded-row">
                    <div class="col-md-2 col-sm-2 col-6">
                        <strong class="tag">Address:</strong>
                    </div>
                    <div class="col-md-10 col-sm-10 col-6">
                        <pre>{{lotInfo.owner.address != null? lotInfo.owner.address : "N/A"}}</pre>
                    </div>
                </div>
                
                
            </div>
            <div v-else class="empty-block">
                <p class="text-center"> No Owner Associated </p>
            </div>
        </div>

        <br>
        <hr>

        <div class="buried-individuals-info container">
            <h3 class="text-center"> Buried Individuals Information </h3>
            <hr class="hr">
            <div v-if="lotInfo.buriedIndividuals.length == 0" class="empty-block">
                <p class="text-center"> No Buried Individuals Associated </p>
            </div>
            <div v-else>
                <br>
                <div
                     v-for="(result, index) in lotInfo.buriedIndividuals"
                     :key="index">
                    <h4>Buried Individual #{{index +1}} </h4>
                    <hr class="bi-hr">
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">First Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.firstName}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Middle Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.middleName != null ? result.middleName : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Last Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.lastName != null ? result.lastName : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Nickname:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.nickname != null ? result.nickname : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Maiden Name:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.maidenName != null ? result.maidenName : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Date of Birth:</strong> 
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.dob != null ? result.dob : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Date of Death:</strong>
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.dod != null ? result.dod : "N/A"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Veteran Status:</strong>
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            {{result.veteran ? "Yes" : "No"}}
                        </div>
                    </div>
                    <div class="row padded-row">
                        <div class="col-md-2 col-sm-2 col-6">
                            <strong class="tag">Obituary:</strong>
                        </div>
                        <div class="col-md-10 col-sm-10 col-6">
                            <pre>{{result.obituary != null ? result.obituary : "N/A"}}</pre>
                        </div>
                    </div>

                    <hr v-if="index != lotInfo.buriedIndividuals.length - 1" class="bi-hr">
                </div>
            </div>
        </div>

        <br>
        <hr>

        <div class="attachments-info container">
            <h3 class="text-center"> Attachments </h3>
            <hr class="hr">
            <div v-if="lotInfo.attachments.length == 0" class="empty-block">
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

