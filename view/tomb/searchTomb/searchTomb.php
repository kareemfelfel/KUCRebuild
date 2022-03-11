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
    <div class="text-center">
        <h3 class="page-title">Search Lots </h3>
        <button type="button" class="btn btn-primary filter-btn" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-filter"></i></button>
    </div>
    <hr>

    <div v-if="!loading && results.length > 0" class="container-fluid">
        <div v-for="(result, index) in results" :key="index" id="cell" class="cell text-center col-md-4 col-sm-6 col-lg-3">
            <div class="card" style="width: 18em;">
                
                <img alt="tutor" :src="result.image" style="width: 100%; height: 60%;">
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
                    <p> Owner: {{result.ownerName}}</p>
                </div>
                <a style= "" class="btn btn-block btn-success" :href = "`controller.php?action=directToViewTombPage&id=${result.id}`">View</a>
            </div>
        </div>
    </div>
    <div v-if=" !loading && results.length == 0">
        <p class="text-center"> No results were found.</p>
    </div>
    <div v-if="loading">
        <div class="loader"></div>
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
<style scoped>
.error-message {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<script>
    new Vue({
        el: "#searchTombApp",
        data: {
          results: [],
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
            }
        }
      })
$('.selectpicker').selectpicker({
    size: 4
});
</script>

