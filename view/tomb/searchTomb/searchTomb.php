<?php

/* 
 * this page is accessible by the public and admins
 * 
 * the page should have a collection of cards, search bar at the bottom that
 * filters dead individuals by name.
 * 
 * Filter button should make the FilterModal pop up.
 * There should be no search button as we should filter the results using JS
 * 
 * The cards should have 3 properties:
 *  1. Dead individual name
 *  2. Owner name (only accessible by admins)
 *  3. DoD
 * 
 * BACK-END notes: 
 *  1. the public should only see the plots that belong to a dead person.
 *  2. admins can see plots that are not associated with a dead person.
 *      These plots must have an owner
 */
?>
<div id="searchTombApp">
    <br>
    <button v-if="mapSearching" class="btn back-btn"
            @click="mapSearching = false"><i class="fa fa-angle-left"></i></button>
    <div class="text-center">
        <h3 class="page-title">Search Lots </h3>
    </div>
    <div class="text-center">
        <button type="button" class="btn btn-primary filter-btn" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-filter"></i> Filter</button>
        <button type="button" 
                class="btn btn-primary filter-btn" 
                @click="viewMap">
            <i class="fa fa-map-location-dot"></i> Map View</button>
    </div>
    <hr :class="{smallMargin: mapSearching}">

    <div v-if="!loading && results.length > 0 && !mapSearching" class="container-fluid">
        <div v-for="(result, index) in results" :key="index" id="cell" class="cell text-center col-md-4 col-sm-6 col-lg-3">
            <div class="card" style="width: 18em;">
                
                <img alt="Lot" :src="result.image" style="width: 100%; height: 60%;">
                <div class= "card-body">
                    <h4 id = "usercardname" class="usercardname"> {{result.title}} </h4>
                    <div class="wrapper">
                        <a id = "cardmidsection" class="trigger"> Buried Individuals ({{result.countBuriedIndividuals}})</a>
                        <div v-if="result.countBuriedIndividuals > 0" class="content">
                            <div class="body">
                                <ul class="popover-list">
                                    <li v-for="(name, index) in result.buriedIndividualNames" :key="index">{{name}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <p class="card-owner-section" :title="result.ownerName"> Owner: {{result.ownerName}}</p>
                    <p v-if="result.forSale"><strong class="tag">For Sale</strong>
                </div>
                <a style= "" class="btn btn-block btn-success" :href = "`controller.php?action=directToViewTombPage&id=${result.id}`">View</a>
            </div>
        </div>
    </div>
    <div v-if=" !loading && results.length == 0 && !mapSearching">
        <p class="text-center"> No results were found.</p>
    </div>
    <div v-if="loading">
        <div class="loader"></div>
    </div>
    
    <div id="googleMap" :class="{map: mapSearching}">
        <!-- GMAP API -->
    </div>

    <!-- Error Messages -->
    <div v-for="(error, index) in errors" 
         :key="index" class="alert alert-danger alert-dismissible fade show error-message" 
         >
        <button type="button" class="close" @click="clearErrors">&times;</button>
        {{error}}
    </div>
    
    
    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filter Lots</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class ="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Section Letter</label><br>
                        <select 
                            class="selectpicker"
                            id="section-letter"
                            data-live-search="true"
                            data-width="100%"
                            v-model="filter.sectionLetterId"
                            >
                          <option v-for="item in sectionLettersList" :value="item.value">{{item.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Lot Number</label>
                        <input type="number" class="form-control" id="lot-number" v-model="filter.lotNumber" placeholder="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="for-sale-switch">For Sale</label>
                        <div class="custom-control custom-switch inactive-link">
                            <input type="checkbox" class="custom-control-input" id="for-sale-switch" v-model="filter.forSale">
                            <label class="custom-control-label" for="for-sale-switch"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="open-plots-switch">Has Open Plots</label>
                        <div class="custom-control custom-switch inactive-link">
                            <input type="checkbox" class="custom-control-input" id="open-plots-switch" v-model="filter.hasOpenPlots">
                            <label class="custom-control-label" for="open-plots-switch"></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class ="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="">Owner</label> <br>
                      <select 
                          class="selectpicker"
                          id="owner"
                          data-live-search="true"
                          data-width="100%"
                          v-model="filter.ownerId"
                          >
                        <option v-for="item in ownersList" :value="item.value">{{item.name}}</option>
                        
                      </select>
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="">Buried Individual(s)</label> <br>
                      <select 
                          class="selectpicker"
                          id="buried-individuals"
                          data-live-search="true"
                          data-width="100%"
                          multiple
                          v-model="filter.buriedIndividualIds"
                          >
                        <option v-for="item in buriedIndividualsList" :value="item.value">{{item.name}}</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearFilter()">Clear</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="fetchResults()">Filter</button>
          </div>
        </div>
      </div>
    </div>
    </div>  
</div>

<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>

<link rel="stylesheet" type="text/css" href="../view/tomb/searchTomb/searchTomb.css">
<link rel="stylesheet" type="text/css" href="../view/tomb/searchTomb/loadingSpinner.css">

<!-- GMAP Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXbb-v0RvEbY5PYpp1HsPgRxDjVH8oAsM&v=weekly"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<style scoped>
.error-message {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
.smallMargin{
    margin-bottom: 1px;
}
.map{
    margin: auto;
    width: 100%;
    height: 600px;
}
</style>
<script>
    new Vue({
        el: "#searchTombApp",
        data: {
          results: [],
          mapSearching: false,
          map: null,
          markers: [],
          openMarkerIcon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
          normalMarkerIcon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
          loading: false,
          filter:{
              lotNumber: null,
              sectionLetterId: null,
              hasOpenPlots: null,
              forSale: null,
              ownerId: null,
              buriedIndividualIds: []
          },
          ownersList: [],
          buriedIndividualsList: [],
          sectionLettersList: [],
          errors: []
        },
        created(){
            // Make a call to get all results,
            // Fetch all lists
            this.fetchOwnersList();
            this.fetchBuriedIndividualsList();
            this.fetchSectionLettersList();
            
            this.fetchResults()
        },
        methods:{
            fetchResults(){
                this.loading = true;
                let request ={
                    lotNumber: this.filter.lotNumber,
                    sectionLetterId: this.filter.sectionLetterId,
                    hasOpenPlots: this.filter.hasOpenPlots,
                    forSale: this.filter.forSale,
                    ownerId: this.filter.ownerId,
                    buriedIndividualIds: this.filter.buriedIndividualIds
                }               
                $.getJSON("controller.php",
                {
                    action: "fetchTombCards",
                    request: JSON.stringify(request)
                },
                response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    let errors = JSON.parse(JSON.stringify(response.error))
                    this.results = data
                    this.errors = errors
                }).fail( () => {
                    this.errors = ["Failed to fetch data. Check your connection and try again."]
                    this.results = []
                }).always( () => {
                    this.loading = false
                    this.clearMarkers();
                    this.setMarkers();
                });
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
                    action: "fetchAllBuriedIndividualsList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.buriedIndividualsList = data
                    this.refreshSelectPicker();
                });
            },
            fetchSectionLettersList(){
                $.getJSON("controller.php",
                {
                    action: "fetchTombSectionLettersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.sectionLettersList = data
                    this.refreshSelectPicker();
                });
            },
            clearFilter(){
                this.filter.lotNumber = null
                this.filter.sectionLetterId = null
                this.filter.hasOpenPlots = null
                this.filter.forSale = null
                this.filter.ownerId = null
                this.filter.buriedIndividualIds = []
                
                this.refreshSelectPicker();
                this.fetchResults();
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            },
            clearErrors(){
                this.errors = [];
            },
            viewMap(){
                this.mapSearching = true
                this.loadMap();
                this.clearMarkers();
                this.setMarkers();
            },
            loadMap(){
                if(this.map == null) {
                    const cemetery = { lat: 41.239094, lng: -79.542186 };
                    var mapProp= {
                      center:new google.maps.LatLng(cemetery.lat, cemetery.lng),
                      zoom:19,
                      mapTypeId: 'satellite'
                    };
                    this.map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
                }
            },
            clearMarkers(){
                this.markers.forEach((marker) => {
                    marker.setMap(null);
                })
                this.markers = [];
            },
            setMarkers(){
                if(this.map != null){
                    this.results.forEach((result)=>{
                        let position = {lat: result.latitude, lng: result.longitude}
                        let contentString = 
                                `<h4><a href='controller.php?action=directToViewTombPage&id=${result.id}'>${result.title}</a></h4>`;
                        if(result.buriedIndividualNames.length == 0){
                            contentString += "<p style='margin-bottom: 5px;'><strong>Buried Individuals: </strong> N/A</p>";
                        }
                        else{
                            contentString += "<p style='margin-bottom: 5px;'><strong>Buried Individuals: </strong></p>";
                            contentString += "<ul>"
                            result.buriedIndividualNames.forEach((name)=>{
                                contentString += `<li>${name}</li>`
                            })
                            contentString += "</ul>"
                        }
                        if(result.ownerName != "N/A"){
                            contentString += "<p style='margin-bottom: 5px;'><strong>Owner: </strong></p>";
                            contentString += `<ul><li>${result.ownerName}</li></ul>`
                        }
                        else{
                            contentString += "<p style='margin-bottom: 20px;'><strong>Owner: </strong> N/A</p>";
                        }
                        let infowindow = new google.maps.InfoWindow({
                            content: contentString,
                        });
                        let marker = new google.maps.Marker({
                            position: position,
                            map: this.map
                        });
                        if(result.forSale){
                            marker.setIcon(this.openMarkerIcon);
                        }
                        else{
                            marker.setIcon(this.normalMarkerIcon);
                        }
                        marker.addListener("click", () => {
                            infowindow.open({
                                anchor: marker,
                                map: this.map,
                                shouldFocus: false,
                            });
                        });
                        
                        this.markers.push(marker);
                    });
                }
            }
        }
      })
$('.selectpicker').selectpicker({
    size: 4
});
</script>

