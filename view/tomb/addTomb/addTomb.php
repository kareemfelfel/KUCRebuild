<?php

/* 
 * This is a Private page only accessible by an admin account
 * 
 * This page should have an open map where the admin can add:
 *  1. Plot Info
    2. Associations
    4. Plot (map):
    5. Attachments
 * 
 * - NOTE: We can combine attached images and deed into one table of attachments
 * keep main image separate
 * 
 * 
 */
?>
<div id="addTombApp">
    <br>
    <h3 class="text-center">Add Lot</h3>
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
                    class="fa fa-caret-down inactive-link"
                    onclick="changeIcon(this)"
                    >
                </a> Lot Information
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in show">
                <div class="panel-body">
                    <div class ="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="required">Section Letter</label><br>
                                <select 
                                    class="selectpicker"
                                    id="section-letter"
                                    data-live-search="true"
                                    data-width="100%"
                                    v-model="sectionLetter"
                                    >
                                  <option v-for="item in sectionLettersList" :value="item.value">{{item.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="required">Lot Number</label>
                                <input v-model="lotNumber" type="number" class="form-control" id="lot-number" placeholder="">
                            </div>
                        </div>
   
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="required">Plot Number(s)</label> <br>
                                <select 
                                    class="selectpicker"
                                    id="plot-numbers"
                                    data-live-search="true"
                                    data-width="100%"
                                    multiple
                                    v-model="plotNumbers"
                                    >
                                  <option v-for="item in plotNumbersList" :value="item.value">{{item.name}}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text fa fa-dollar-sign"></span>
                                    </div>
                                    <input v-model="price" type="number" class="form-control" id="" placeholder="">
                                </div>
                            </div>
                        </div>

                    </div><br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="notes">Notes: </label>
                                <textarea v-model="notes" id="notes" class="form-control" rows="8" cols="6"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Main Image</label>
                                <div class="input-group">
                                    <input class="form-control curved-input" type="file" accept="image/*" id="mainImage" ref="mainImage" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="for-sale-switch">For Sale</label>
                                    <div class="custom-control custom-switch inactive-link">
                                        <input v-model="forSale" type="checkbox" class="custom-control-input" onclick="disableForOpen(this)" id="for-sale-switch">
                                        <label class="custom-control-label" for="for-sale-switch"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="open-plots-switch">Has Open Plots</label>
                                    <div class="custom-control custom-switch inactive-link">
                                        <input v-model="hasOpenPlots" type="checkbox" class="custom-control-input" id="open-plots-switch">
                                        <label class="custom-control-label" for="open-plots-switch"></label>
                                    </div>
                                </div>
                            </div>
                        </div>                
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Purchase Date</label>
                                <input v-model="purchaseDate" type="date" class="form-control" id="purchaseDate" placeholder="Select a Date">
                            </div>
                        </div>
                    </div>
              </div>
            </div>
          </div>
          <br>
          <!-- Second panel -->
          <div class="panel panel-default" id="accordion2">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a 
                    data-toggle="collapse" 
                    data-parent="#accordion2" 
                    href="#collapse2" 
                    class="fa fa-caret-down inactive-link"
                    onclick="changeIcon(this)"
                    >
                </a> Associations 
                <span class="fa fa-info-circle associations-popover" style="color: #3498db" data-container="body" data-toggle="popover" data-placement="top" data-content="Associations can be added only when a Lot is not for sale.">
                </span>
              </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse in show">
              <div class="panel-body">
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label id="owner-label" class="required">Owner</label> <br>
                            <select 
                                class="selectpicker"
                                id="owner"
                                data-live-search="true"
                                data-width="100%"
                                v-model="ownerId"
                                >
                              <option v-for="item in ownersList" :value="item.value">{{item.name}}</option>
                            </select>
                            <p style="padding-top: 5px;">can't find an owner? <a href="controller.php?action=directToOwnersPage">click here</a>.</p>
                        </div>
                    </div>
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
              </div>
            </div>
          </div>
          <br>
          <!-- Third panel -->
          <div class="panel panel-default" id="accordion3">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a 
                    data-toggle="collapse" 
                    data-parent="#accordion3" 
                    href="#collapse3" 
                    class="fa fa-caret-down inactive-link"
                    onclick="changeIcon(this)"
                    >
                </a> Attachments
              </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse in show">
              <div class="panel-body">
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">All Attached Documents - Including Deed</label>
                            <div class="input-group">
                                <input class="form-control curved-input" type="file" id="attached-documents" ref="attachments" multiple/>
                            </div>
                        </div>
                    </div>
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
                    class="fa fa-caret-down inactive-link"
                    onclick="changeIcon(this)"
                    >
                </a> Map 
              </h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse in show">
              <div class="panel-body map-panel">
                <div id="googleMap" class="map">
                    <!-- GMAP API -->
                </div>
                <br>
                <div class="text-center">
                    <button type="button" class="btn btn-danger" onclick="deleteMarker()">Delete Marker</button>
                </div>
              </div>
            </div>
        </div>
      </div>
        
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
        
      <br>
      <button type="button" class="btn btn-success" style="margin-right: 10px;" @click="addTomb">Submit</button>
      <button type="button" class="btn btn-default">Cancel</button>
      <br><br>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="../view/tomb/addTomb/addTomb.css">
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<!-- GMAP Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXbb-v0RvEbY5PYpp1HsPgRxDjVH8oAsM&callback=myMap&v=weekly" async></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<script>
App = new Vue({
        el: "#addTombApp",
        data: () => {
            return{
                sectionLetter: null,
                lotNumber: null,
                price: null,
                forSale: false,
                hasOpenPlots: false,
                purchaseDate: null,
                ownerId: null,
                buriedIndividualIds: [],
                plotNumbers: [],
                notes: null,
                
                sectionLettersList: [],
                ownersList: [],
                buriedIndividualsList: [],
                plotNumbersList: [],
                
                errors: [],
                successMessage: null
            }
        },
        created(){
            this.fetchSectionLettersList();
            this.fetchOwnersList();
            this.fetchBuriedIndividualsList();
            this.fetchPlotNumbersList();
        },
        methods:{
            longitude(){
                if(marker)
                    return marker.getPosition().lng();
                return null;
            },
            latitude(){
                if(marker)
                    return marker.getPosition().lat();
                return null;
            },
            fetchSectionLettersList(){
                $.getJSON("controller.php",
                {
                    action: "fetchTombSectionLettersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.sectionLettersList = data
                    this.refreshSelectPicker();
                })
                
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
            fetchPlotNumbersList(){
                $.getJSON("controller.php",
                {
                    action: "fetchPlotNumbersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.plotNumbersList = data
                    this.refreshSelectPicker();
                })
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            },
            addTomb(){
                let formData = new FormData();
                let request = {
                    lotNumber: this.lotNumber,
                    sectionLetterId: this.sectionLetter,
                    price: this.price,
                    forSale: this.forSale,
                    hasOpenPlots: this.hasOpenPlots,
                    purchaseDate: this.purchaseDate,
                    ownerId: this.ownerId,
                    buriedIndividualIds: this.buriedIndividualIds,
                    plotNumbers: this.plotNumbers,
                    longitude: this.longitude(),
                    latitude: this.latitude(),
                    notes: this.notes
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
                    url: "controller.php?action=addTomb",
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
                            this.successMessage = "Lot was Successfully Added!"
                            this.clearForm();
                            this.fetchBuriedIndividualsList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Lot."]
                    }
                });
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            },
            clearForm(){
                this.sectionLetter = null
                this.lotNumber = null
                this.price = null
                this.forSale = false
                this.hasOpenPlots = false
                this.purchaseDate = null
                this.ownerId = null
                this.buriedIndividualIds = []
                this.plotNumbers = []
                this.$refs.mainImage.value = null;
                this.$refs.attachments.value = null;
                
                this.refreshSelectPicker();
                deleteMarker();
            }
        }
    })
    var marker;
    var map;
    var infowindow;
    var openMarkerIcon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';

    function myMap() {
        const cemetery = { lat: 41.239094, lng: -79.542186 };
        var mapProp= {
          center:new google.maps.LatLng(cemetery.lat, cemetery.lng),
          zoom:18,
          mapTypeId: 'satellite'
        };
        map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        map.addListener('click', function(e) {
            placeMarker(e.latLng, map);
        });
    }
    function openInfo(){
        if(App.$data.sectionLetter){
            var plotLabel = App.$data.sectionLettersList.find(item => item.value == App.$data.sectionLetter).name + " " + document.getElementById("lot-number").value;
            if(infowindow){
                infowindow.setContent(plotLabel? plotLabel :null)
            }
            else{
                infowindow = new google.maps.InfoWindow({
                    content: plotLabel? plotLabel :null
                });
            }
            infowindow.open(map, marker);
        }
    }
    function placeMarker(location) {
        if ( marker ) {
          marker.setPosition(location);
        } else {
          marker = new google.maps.Marker({
            position: location,
            draggable:true,
            map: map
          });
        }
        marker.addListener('click', function() {
            openInfo();
        });
        
        if(document.getElementById("for-sale-switch").checked){
            changeToBlueMarkerColor(true);
        }
        
    }
    function deleteMarker(){
        marker.setMap(null);
        marker = null;
    }
    
    function changeIcon(x){
        if(x.classList.contains("fa-caret-down")){
            x.classList.add("fa-caret-right");
            x.classList.remove("fa-caret-down");
        }
        else if(x.classList.contains("fa-caret-right")){
            x.classList.add("fa-caret-down");
            x.classList.remove("fa-caret-right");
        }
    }
    
    function disableForOpen(x){
        if(x.checked){
            //Clear the owner selected data, make it not required, and disable it
            document.getElementById("owner-label").classList.remove("required");
            document.getElementById("owner").setAttribute("disabled", true)
            App.$data.ownerId = null;
            $('#owner').selectpicker('val', App.$data.ownerId);
            document.getElementById("buried-individuals").setAttribute("disabled", true)
            App.$data.buriedIndividualIds = [];
             $('#buried-individuals').selectpicker('val', App.$data.buriedIndividualIds);
            // disable purchase date and clear it
            document.getElementById("purchaseDate").setAttribute("disabled", true);
            App.$data.purchaseDate = null;
            $('.selectpicker').selectpicker('refresh');
            
            //if marker exists, change the icon to an open icon
            changeToBlueMarkerColor(true);
            
            
        }
        else{
            document.getElementById("owner-label").classList.add("required");
            document.getElementById("owner").removeAttribute("disabled")
            document.getElementById("buried-individuals").removeAttribute("disabled")
            document.getElementById("purchaseDate").removeAttribute("disabled")
            changeToBlueMarkerColor(false);
            $('.selectpicker').selectpicker('refresh');
        }
    }
    function changeToBlueMarkerColor(val){
        if(marker){
            if(val){
                marker.setIcon(openMarkerIcon);
            }
            else{
                marker.setIcon(null); //default icon
            }
        }
    }
    
    $('.selectpicker').selectpicker({
      size: 4
    });
    
    $('.associations-popover').popover({
      trigger: 'click'
    });
</script>

</body>
</html>
