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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text fa fa-dollar-sign"></span>
                                        </div>
                                        <input v-model="lotInfo.price" type="number" class="form-control" id="" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label id="owner-label" :class="{required: !lotInfo.forSale}">Owner</label> <br>
                                    <select 
                                        class="selectpicker"
                                        id="owner"
                                        :disabled="lotInfo.forSale"
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
                                    <label >For Sale 
                                        <span class="fa fa-info-circle associations-popover" style="color: #3498db" data-container="body" data-toggle="popover" data-placement="top" data-content="A Lot that is originally added as not for sale, can not be changed to be for sale.">
                                        </span>
                                    </label>
                                    <div class="custom-control custom-switch inactive-link">
                                        <input v-model="lotInfo.forSale" type="checkbox" class="custom-control-input" :disabled="!originalForSaleValue" id="for-sale-switch" @change="forSaleChanged">
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
                                    <input v-model="lotInfo.purchaseDate" type="date" class="form-control" id="purchaseDate" placeholder="Select a Date" :disabled="lotInfo.forSale">
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
                  <div class ="row add-row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="">Buried Individual(s)</label> <br>
                              <select 
                                  class="selectpicker"
                                  id="buried-individuals"
                                  data-live-search="true"
                                  data-width="100%"
                                  :disabled="lotInfo.forSale"
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
                  <h6> Un-link Buried Individual(s) 
                      <span class="fa fa-warning associations-popover" style="color: #ff0000" data-container="body" data-toggle="popover" data-placement="top" data-content="When a Buried Individual is removed from a Lot or a Columbarium, their data will remain in the database but they will no longer be associated with any Lot or Columbarium.">
                    </span>
                  </h6>
                  <hr class='bi-hr'>
                  <ul v-if="linkedBuriedIndividualsList.length > 0" class="lot-ul">
                      <li v-for='(item, index) in linkedBuriedIndividualsList'>{{item.name}} <button class="btn btn-sm btn-danger fa fa-trash" @click="removeBuriedIndividual(item.id, index)"></li>
                  </ul>
                  <div v-else class="empty-block">
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
                  <div class ="row add-row">
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
                  <ul v-if="lotInfo.attachments.length > 0" class="lot-ul">
                      <li v-for='(item, index) in lotInfo.attachments'><a :href="item.link" download>{{item.name}}</a> <button class="btn btn-sm btn-danger fa fa-trash" @click="removeAttachment(item.id, item.link, index)"></li>
                  </ul>
                  <div v-else class="empty-block">
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
        <br>
        <button type="button" class="btn btn-success" @click="editTomb">Edit</button>
        <br><br>
        <!-- Error Messages -->
        <div v-for="(error, index) in errors" 
             :key="index" class="alert alert-danger alert-dismissible fade show message-box" 
             >
            <button type="button" class="close" @click="clearError(index)">&times;</button>
            {{error}}
        </div>
        
        <!-- Success Message -->
        <div v-if="successMessage != null" 
             class="alert alert-success alert-dismissible fade show message-box" 
             >
            <button type="button" class="close" @click="clearSuccessMessage">&times;</button>
            {{successMessage}}
        </div>
    </div>
</div>
<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<link rel="stylesheet" type="text/css" href="../view/tomb/editTomb/editTomb.css">

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
            originalForSaleValue: false,
            errors: [],
            successMessage: null,
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
                    if(this.map === null)
                        this.loadMap();
                    this.setMapMarker();
                }).always( () => {
                    this.loading = false
                });
            },
            setMapMarker(){
               if(this.marker === null){
                   this.marker = new google.maps.Marker({
                    position: {lat: this.lotInfo.latitude, lng: this.lotInfo.longitude},
                    draggable: true,
                    map: this.map
                   });
               }
               else{
                   this.marker.setPosition({lat: this.lotInfo.latitude, lng: this.lotInfo.longitude});
               }
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
                this.originalForSaleValue = data.forSale;
                if(data.purchaseDate !== null){
                    const [month, day, year] = data.purchaseDate.split('-');
                    const updatedDate = [year, month, day].join('-');
                    this.lotInfo.purchaseDate = updatedDate;
                }
            },
            forSaleChanged(){
                if(this.lotInfo.forSale){
                    this.lotInfo.ownerId = null;
                    this.lotInfo.purchaseDate = null;
                    this.buriedIndividualIds = [];
                    this.changeToBlueMarkerColor(true);
                }
                else{
                    this.changeToBlueMarkerColor(false);
                }
                this.refreshSelectPicker();
            },
            changeToBlueMarkerColor(val){
                if(this.marker){
                    if(val){
                        this.marker.setIcon(this.openMarkerIcon);
                    }
                    else{
                        this.marker.setIcon(null); //default icon
                    }
                }
            },
            removeBuriedIndividual(id, index){
                $.getJSON("controller.php",
                {
                    action: "unlinkTombBuriedIndividual",
                    buriedIndividualId: id
                },response => {
                    let result = JSON.parse(JSON.stringify(response.result))
                    let errors = JSON.parse(JSON.stringify(response.error))
                    this.errors = errors
                    if(result.length == 1 && result[0]){
                        this.successMessage = "Buried Individual was Successfully un-linked!"
                        this.fetchBuriedIndividualsList();
                        this.lotInfo.buriedIndividuals.splice(index, 1);
                    }
                    this.refreshSelectPicker();
                }).fail( () => {
                    this.errors = ["Failed to un-link buried individual."];
                });
            },
            removeAttachment(id, link, index){
                $.getJSON("controller.php",
                {
                    action: "deleteTombAttachment",
                    tombId: id,
                    link: link
                },response => {
                    let result = JSON.parse(JSON.stringify(response.result))
                    let errors = JSON.parse(JSON.stringify(response.error))
                    this.errors = errors
                    if(result.length == 1 && result[0]){
                        this.successMessage = "Attachment was Successfully Deleted!"
                        this.lotInfo.attachments.splice(index, 1);
                    }
                }).fail( () => {
                    this.errors = ["Failed to remove attachment."];
                });
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            },
            editTomb(){
                let formData = new FormData();
                let request = {
                    price: this.lotInfo.price,
                    forSale: this.lotInfo.forSale,
                    hasOpenPlots: this.lotInfo.hasOpenPlots,
                    purchaseDate: this.lotInfo.purchaseDate,
                    ownerId: this.lotInfo.ownerId,
                    buriedIndividualIds: this.buriedIndividualIds,
                    longitude: this.marker.getPosition().lng(),
                    latitude: this.marker.getPosition().lat()
                }
                
                formData.append('request', JSON.stringify(request))
                if(this.$refs.mainImage.files[0])
                    formData.append('mainImage', this.$refs.mainImage.files[0]);

                let attachments = this.$refs.attachments.files;
                for(var i =0; i< attachments.length; i++){
                    formData.append('attachedDocuments[]', attachments[i]);
                }
                
                $.ajax({
                    type: "POST",
                    url: `controller.php?action=editTomb&id=${this.id}`,
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Lot was Successfully Edited!"
                            this.updatePage();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Edit Lot."]
                    }
                });
            },
            updatePage(){
                this.fetchBuriedIndividualsList();
                this.buriedIndividualIds = [];
                this.$refs.mainImage.value = null;
                this.$refs.attachments.value = null;
                this.getLotInfo();
                this.refreshSelectPicker();
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