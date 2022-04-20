<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<div id="searchColumbariumApp">
    <br>
    <div class="text-center">
        <h3 class="page-title">Search Columbarium </h3><br>
        <button type="button" class="btn btn-primary filter-btn" data-toggle="modal" data-target="#filterModal">
            <i class="fa fa-filter"></i> Filter</button>
    </div>
    <hr>

    <div v-if="!loading && results.length > 0" class="container-fluid">
        <div v-for="(result, index) in results" :key="index" id="cell" class="cell text-center col-md-4 col-sm-6 col-lg-3">
            <div class="card" style="width: 18em;">
                
                <img alt="columbarium" :src="result.image" style="width: 100%; height: 60%;">
                <div class= "card-body">
                    <h4 id = "usercardname" class="usercardname" title="Location"> {{result.columbarium}} </h4>
                    <h5 title="Location">{{result.title}}</h5>
                    <div v-if="!result.forSale">
                        <div class="wrapper">
                            <a id = "cardmidsection" class="trigger"> Buried Individuals ({{result.buriedIndividualsCount}})</a>
                            <div v-if="result.buriedIndividualsCount > 0" class="content">
                                <div class="body">
                                    <ul class="popover-list">
                                        <li v-for="(name, index) in result.buriedIndividualNames" :key="index">{{name}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p v-else class="for-sale-section"><strong class="tag">For Sale</strong>
                </div>
                <a style= "" class="btn btn-block btn-success" :href = "`controller.php?action=directToViewColumbariumPage&id=${result.id}`">View</a>
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
            <h5 class="modal-title" id="exampleModalLabel">Filter Columbarium</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class ="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Columbarium</label><br>
                        <select 
                            class="selectpicker"
                            id="section-letter"
                            data-live-search="true"
                            data-width="100%"
                            v-model="filter.columbariumTypeId"
                            
                            >
                          <option v-for="item in columbariumTypesList" :value="item.value">{{item.name}}</option>
                        </select>
                    </div>
                </div>
               <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Level</label><br>
                        <select 
                            class="selectpicker"
                            id="section-letter"
                            data-live-search="true"
                            data-width="100%"
                            v-model="filter.nicheTypeId"
                            
                            >
                          <option v-for="item in nicheTypesList" :value="item.value">{{item.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
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
                        <label for="">Niche Number</label>
                        <input type="number" class="form-control" id="lot-number" v-model="filter.sectionNumber" placeholder="">
                    </div>
                </div>
            </div>
            <div class ="row">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bi-veteran-switch">Buried Individual Veteran</label>
                        <div class="custom-control custom-switch inactive-link">
                            <input type="checkbox" class="custom-control-input" id="bi-veteran-switch" v-model="filter.buriedIndividualVeteranStatus">
                            <label class="custom-control-label" for="bi-veteran-switch"></label>
                        </div>
                    </div>
                </div>
            </div>
            
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clearFilter()">Clear</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="fetchResults()">Search</button>
          </div>
        </div>
      </div>
    </div>
    </div>  
</div>


<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>

<link rel="stylesheet" type="text/css" href="../view/columbarium/searchColumbarium/searchColumbarium.css">
<link rel="stylesheet" type="text/css" href="../view/columbarium/searchColumbarium/loadingSpinner.css">
<style scoped>
.error-message {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
.for-sale-section{
    margin-top: 20px;
}
</style>
<Script>
    new Vue({
        el: "#searchColumbariumApp",
        data: {
            filter:{
              columbariumTypeId: null,
              nicheTypeId: null,
              sectionLetterId: null,
              sectionNumber: null,
              forSale: null,
              buriedIndividualIds: [],
              buriedIndividualVeteranStatus: null
            },
            buriedIndividualsList: [],
            sectionLettersList: [],
            nicheTypesList: [],
            columbariumTypesList: [],  
            
            results: [],
            loading: false,
            errors: []
        },
        created(){
            this.fetchBuriedIndividualsList();
            this.fetchSectionLettersList();
            this.fetchNicheTypesList();
            this.fetchColumbariumTypesList();
            this.fetchResults();
        },
        methods:{
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
                    action: "fetchColumbariumSectionLettersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.sectionLettersList = data
                    this.refreshSelectPicker();
                });
            },
            fetchNicheTypesList(){
                $.getJSON("controller.php",
                {
                    action: "fetchNicheTypesList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.nicheTypesList = data
                    this.refreshSelectPicker();
                });
            },
            fetchColumbariumTypesList(){
                $.getJSON("controller.php",
                {
                    action: "fetchColumbariumTypesList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.columbariumTypesList = data
                    this.refreshSelectPicker();
                });
            },
            fetchResults(){
                this.loading = true;
                let request ={
                    columbariumTypeId: this.filter.columbariumTypeId,
                    sectionNumber: this.filter.sectionNumber,
                    nicheTypeId: this.filter.nicheTypeId,
                    sectionLetterId: this.filter.sectionLetterId,
                    forSale: this.filter.forSale,
                    ownerId: null,
                    buriedIndividualIds: this.filter.buriedIndividualIds,
                    buriedIndividualVeteranStatus: this.filter.buriedIndividualVeteranStatus
                }               
                $.getJSON("controller.php",
                {
                    action: "fetchColumbariumCards",
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
            clearFilter(){
                this.filter.columbariumTypeId = null
                this.filter.nicheTypeId = null
                this.filter.sectionLetterId = null
                this.filter.sectionNumber = null
                this.filter.forSale = null
                this.filter.buriedIndividualIds = []
                this.filter.buriedIndividualVeteranStatus = null
                
                this.refreshSelectPicker();
                this.fetchResults();
            },
            clearErrors(){
                this.errors = []
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            }
        }
    });
$('.selectpicker').selectpicker({
    size: 4
});
</script>