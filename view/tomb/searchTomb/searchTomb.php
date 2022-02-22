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

    <div v-if="!loading" class="container-fluid">
        <div v-for="(result, index) in results" :key="index" id="cell" class="cell text-center col-md-4 col-sm-6 col-lg-3">
            <div class="card" style="width: 18em;">
                
                <img alt="tutor" :src="result.image" style="width: 100%; height: 60%;">
                <div class= "card-body">
                    <h4 id = "usercardname" class="usercardname"> {{result.title}} </h4>
                    <p id = "cardmidsection" style="width: 100%;"> Buried Individuals ({{result.countBuriedIndividuals}})</p>
                    <p> Owner: {{result.ownerName}}</p>
                </div>
                <a style= "" class="btn btn-block btn-success" href = "#">View</a>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="loader text-center"></div>
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
                          <option>A</option>
                          <option>B</option>
                          <option>C</option>
                          <option>D</option>
                          <option>YC</option>
                          <option>YB</option>
                          <option>XC</option>
                          <option>XB</option>
                          <option>XD</option>
                          <option>XA</option>
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
                          multiple
                          data-width="100%"
                          data-max-options="1"
                          v-model="filter.ownerId"
                          >
                        <option v-for="owner in allOwnersList" :value="owner.value">{{owner.name}}</option>
                        
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
                        <option value=1>Kareem Felfel</option>
                        <option value=2>Assembly Language</option>
                        <option value=3>Am I dead?</option>
                        <option>What is this place!</option>
                        <option>Hello World</option>
                        <option>Peter Griffin</option>
                        <option>Stewie Griffin</option>
                        <option>Lewis</option>
                        <option>John Black</option>
                        <option>Jody Strausser</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="filterData()">Filter</button>
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

<script>
    new Vue({
        el: "#searchTombApp",
        data: {
          results: [],
          loading: false,
          filter:{
              lotNumber: null,
              sectionLetterId: [],
              hasOpenPlots: false,
              forSale: null,
              ownerId: [],
              buriedIndividualIds: []
          },
          allOwnersList: null
        },
        created(){
            // Make a call to get all results,
            // and all list data
            this.fetchAllOwnersList();
            console.log(this.allOwnersList);
            //fetchAllBuriedIndividualsList();
            //fetchAllTombSectionLetters();
        },
        methods:{
            getFakeData: function(){
                let fakeResults = [{
                    id: 1,
                    title: "A 1233",
                    countBuriedIndividuals: 2,
                    ownerName: "Jody Strausser",
                    image: "../assets/images/basic-grave.jpg"
                },
                {
                    id: 1,
                    title: "B 54",
                    countBuriedIndividuals: 5,
                    ownerName: "Kareem Felfel",
                    image: "../assets/images/basic-grave.jpg"
                }]
                this.results = fakeResults
            },
            filterData(){
                // TODO make the call to filter the results and close the model
                this.loading = true;
                setTimeout(() => {
                    this.getFakeData();
                    this.loading = false;
                }, 2000);
                
                console.log(this.allOwnersList)
                
            },
            fetchAllOwnersList(){
            
                $.getJSON("controller.php",
                {
                    action: "getAllOwnersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    console.log(data)
                    this.allOwnersList = data
                    console.log(this.allOwnersList[0])
                });
               
            }
        }
      })
// JS outside of Vue
$('.selectpicker').selectpicker({
    size: 4
});
</script>

