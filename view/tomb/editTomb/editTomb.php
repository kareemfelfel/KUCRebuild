<?php

/* 
 * Admins will be directed to this page either directly from the card 
 * or from the profile
 * This page will include all of the following components
 * 1. editBuriedIndividual
 * 2. editDeed
 * 3. editImages
 * 4. editPlot
 * 5. editPlotInfo
 * 6. editPlotOwner
 */
?>
<div id="editTomb">
    <br>
    <h3 class="text-center">Edit Lot</h3>
    <hr>
    <div class="container-fluid">
        <div class="panel-group">
            <div class="panel panel-default" id="accordion1">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a 
                        data-toggle="collapse" 
                        data-parent="#accordion1" 
                        href="#collapse1" 
                        class="fa inactive-link"
                        :class="{'fa-caret-down': lotInfoActive, 'fa-caret-right': !lotInfoActive}"
                        @click="lotInfoActive = !lotInfoActive"
                        >
                    </a> Lot Information
                  </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in show">
                    <div class="panel-body">
                        <div class ="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Main Image</label>
                                    <div class="input-group">
                                        <input class="form-control curved-input" type="file" accept="image/*" id="mainImage" ref="mainImage" />
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input v-model="lotInfo.price" type="number" class="form-control" id="" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label id="owner-label" class="required">Owner</label> <br>
                                    <select 
                                        class="selectpicker"
                                        id="owner"
                                        data-live-search="true"
                                        data-width="100%"
                                        v-model="lotInfo.ownerId"
                                        >
                                      <option v-for="item in ownersList" :value="item.value">{{item.name}}</option>
                                    </select>
                                    <p style="padding-top: 5px;">can't find an owner? <a href="controller.php?action=directToOwnersPage">click here</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="for-sale-switch">For Sale</label>
                                    <div class="custom-control custom-switch inactive-link">
                                        <input v-model="lotInfo.forSale" type="checkbox" class="custom-control-input" onclick="disableForOpen(this)" id="for-sale-switch">
                                        <label class="custom-control-label" for="for-sale-switch"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="open-plots-switch">Has Open Plots</label>
                                    <div class="custom-control custom-switch inactive-link">
                                        <input v-model="lotInfo.hasOpenPlots" type="checkbox" class="custom-control-input" id="open-plots-switch">
                                        <label class="custom-control-label" for="open-plots-switch"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Purchase Date</label>
                                    <input v-model="lotInfo.purchaseDate" type="date" class="form-control" id="purchaseDate" placeholder="Select a Date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- SECOND PANEL -->
            <div class="panel panel-default" id="accordion2">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a 
                      data-toggle="collapse" 
                      data-parent="#accordion2" 
                      href="#collapse2" 
                      class="fa inactive-link"
                      :class="{'fa-caret-down': biActive, 'fa-caret-right': !biActive}"
                      @click="biActive = !biActive"
                      >
                  </a> Buried Individuals 
                  <span class="fa fa-info-circle associations-popover" style="color: #3498db" data-container="body" data-toggle="popover" data-placement="top" data-content="Buried Individuals can be added only when a Lot is not for sale.">
                  </span>
                </h4>
              </div>
              <div id="collapse2" class="panel-collapse collapse in show">
                <div class="panel-body">
                  <h6>Add Buried Individual(s)</h6>
                  <hr class='bi-hr'>
                  <div class ="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="">Buried Individual(s)</label> <br>
                              <select 
                                  class="selectpicker"
                                  id="buried-individuals"
                                  data-live-search="true"
                                  data-width="100%"
                                  multiple
                                  v-model="buriedIndividualIds"
                                  >
                                <option v-for="item in buriedIndividualsList" :value="item.value">{{item.name}}</option>
                              </select>
                              <p style="padding-top: 5px;">can't find a buried individual? <a href="controller.php?action=directToBuriedIndividualsPage">click here</a>.</p>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <h6> Remove Buried Individual(s) 
                      <span class="fa fa-warning associations-popover" style="color: #ff0000" data-container="body" data-toggle="popover" data-placement="top" data-content="When a Buried Individual is removed from a Lot or a Columbarium, their data will remain in the database but they will no longer be associated with any Lot or Columbarium.">
                    </span>
                  </h6>
                  <hr class='bi-hr'>
                  <ul>
                      <li v-for='item in linkedBuriedIndividualsList'>{{item.name}} <button class="btn btn-sm btn-danger fa fa-trash" @click="removeBuriedIndividual(item.id)"></li>
                  </ul>
                  <div v-if="linkedBuriedIndividualsList.length === 0" class="empty-block">
                      <p class="text-center"> No Buried Individuals associated. </p>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <!-- THIRD PANEL -->
            <div class="panel panel-default" id="accordion3">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a 
                      data-toggle="collapse" 
                      data-parent="#accordion3" 
                      href="#collapse3" 
                      class="fa inactive-link"
                      :class="{'fa-caret-down': attachmentsActive, 'fa-caret-right': !attachmentsActive}"
                      @click="attachmentsActive = !attachmentsActive"
                      >
                  </a> Attachments 
                </h4>
              </div>
              <div id="collapse3" class="panel-collapse collapse in show">
                <div class="panel-body">
                  <h6>Add Attachments</h6>
                  <hr class='bi-hr'>
                  <div class ="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="">All Attached Documents - Including Deed</label> <br>
                              <div class="input-group">
                                <input class="form-control curved-input" type="file" id="attached-documents" ref="attachments" multiple/>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <h6> Remove Attachment(s) 
                      <span class="fa fa-warning associations-popover" style="color: #ff0000" data-container="body" data-toggle="popover" data-placement="top" data-content="Attachments will be PERMENANTLY removed.">
                    </span>
                  </h6>
                  <hr class='bi-hr'>
                  <ul>
                      <li v-for='item in lotInfo.attachments'><a :href="item.link" download>{{item.name}}</a> <button class="btn btn-sm btn-danger fa fa-trash" @click="removeAttachment(item.id)"></li>
                  </ul>
                  <div v-if="lotInfo.attachments.length === 0" class="empty-block">
                      <p class="text-center"> No Attachments associated. </p>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <!-- Fourth panel -->
            <div class="panel panel-default" id="accordion4">
              <div class="panel-heading">
                <h4 class="panel-title required">
                  <a 
                      data-toggle="collapse" 
                      data-parent="#accordion4" 
                      href="#collapse4" 
                      class="fa inactive-link"
                      :class="{'fa-caret-down': mapActive, 'fa-caret-right': !mapActive}"
                      @click="mapActive = !mapActive"
                      >
                  </a> Map 
                </h4>
              </div>
              <div id="collapse4" class="panel-collapse collapse in show">
                <div class="panel-body map-panel">
                  <div id="googleMap" class="map">
                      <!-- GMAP API -->
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>
<style>
.bi-hr{
    display: inline-block;
    width: 300px;
    padding-bottom: 10px;
}
.map {
    margin: auto;
    width: 100%;
    height: 400px;
}
.map-panel{
    padding: 0px;
}
.empty-block{
    padding: 20px;
    background-color: lightblue;
}
.inactive-link {
   cursor: default;
}
.bootstrap-select > .dropdown-toggle{
    border: 1px solid #ced4da;
}
/* Red Asterisk for text boxes. */
.required:after {
  content:" *";
  color: red;
  margin-right: 5px;
}
.curved-input{
    border-radius: 5px !important;
}
</style>

<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<!-- GMAP Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXbb-v0RvEbY5PYpp1HsPgRxDjVH8oAsM&v=weekly"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script>
    new Vue({
        el: "#editTomb",
        data: {
            map: null,
            marker: null,
            openMarkerIcon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
            lotInfoActive: true,
            biActive: true,
            attachmentsActive: true,
            mapActive: true,
            lotInfo: {
                purchaseDate: null,
                forSale: null,
                hasOpenPlots: null,
                price: null,
                ownerId: null,
                buriedIndividuals: [],
                attachments: []
            },
            buriedIndividualIds: [],
            ownersList: [],
            buriedIndividualsList: []
        },
        created(){
            this.getId();
            this.fetchOwnersList();
            this.fetchBuriedIndividualsList();
            this.getLotInfo();
        },
        computed:{
            linkedBuriedIndividualsList(){
                return this.lotInfo.buriedIndividuals.map(function(obj){
                    let name = obj.firstName + " " + obj.lastName + (obj.nickname? (" (" + obj.nickname + ")"): "");
                    return {id: obj.id, name: name}
                })
            }
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
                    this.adaptInfo(data);
                    this.refreshSelectPicker();
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
            },
            fetchOwnersList(){
                $.getJSON("controller.php",
                {
                    action: "fetchAllOwnersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.ownersList = data
                    this.refreshSelectPicker();
                })
            },
            fetchBuriedIndividualsList(){
                $.getJSON("controller.php",
                {
                    action: "fetchUnlinkedBuriedIndividualsList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.buriedIndividualsList = data
                    this.refreshSelectPicker();
                })
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            },
            adaptInfo(data){
                this.lotInfo.ownerId = data.owner?.id;
                if(data.purchaseDate !== null){
                    const [month, day, year] = data.purchaseDate.split('-');
                    const updatedDate = [year, month, day].join('-');
                    this.lotInfo.purchaseDate = updatedDate;
                }
            },
            removeBuriedIndividual(id){
                console.log(id);
            }
        }
    })
$('.selectpicker').selectpicker({
    size: 4
});
$('.associations-popover').popover({
    trigger: 'click'
});
</script>