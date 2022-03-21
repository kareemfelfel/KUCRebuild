<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript" src="../view/administration/editLists/editLists.js"></script>

<br>
<h3 class="text-center">Edit Lists</h3>
<hr>

<div class="container-fluid" id="editListsApp">
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
            </a> Add Columbarium Name
          </h4>
        </div>
      <div id="collapse1" class="panel-collapse collapse in show">
        <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Columbarium Name</label>
                            <div class="input-group">
                                <input v-model="selectedColumbariumType" type="text" class="form-control" id="columbariumName" placeholder="">
                                <div class="input-group-append">
                                   <button @click="addColumbariumType" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence"
                                data-live-search="true"
                                multiple
                                :data-max-options="1"
                                data-width="100%"
                                >
                                <option v-for="item in columbariumTypesList" :value="item.value">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
      </div>
     </div>
    
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
                </a> Add Columbarium Section Letter
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show"> 
          <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">   
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Section Letter</label>
                            <div class="input-group">
                                <input v-model="selectedColumbariumSectionLetter" type="text" class="form-control" id="sectionLetter" placeholder="">
                                <div class="input-group-append">
                                   <button @click="addColumbariumSectionLetter" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence2"
                                data-live-search="true"
                                multiple
                                :data-max-options="1"
                                data-width="100%"
                                >
                              <option v-for="item in columbariumSectionLettersList" :value="item.value">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>  
        </div>
      </div>
           
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
                </a> Add Columbarium Niche Name
            </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse in show"> 
          <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">   
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Niche Name</label>
                            <div class="input-group">
                                <input v-model="selectedNicheType" type="text" class="form-control" id="nicheName" placeholder="">
                                <div class="input-group-append">
                                   <button @click="addNicheType" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence3"
                                data-live-search="true"
                                multiple
                                :data-max-options="1"
                                data-width="100%"
                                >
                              <option v-for="item in nicheTypesList" :value="item.value">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>  
        </div>
      </div>
                
                <!-- Fourth panel -->
      <div class="panel panel-default" id="accordion4">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a 
                    data-toggle="collapse" 
                    data-parent="#accordion4" 
                    href="#collapse4" 
                    class="fa fa-caret-down inactive-link"
                    onclick="changeIcon(this)"
                    >
                </a> Add Lot Section Letter
            </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse in show"> 
          <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">   
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Section Letter</label>
                            <div class="input-group">
                                <input v-model="selectedTombSectionLetter" type="text" class="form-control" id="tombLetter" placeholder="">
                                <div class="input-group-append">
                                   <button @click="addTombSectionLetter" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence4"
                                data-live-search="true"
                                multiple
                                :data-max-options="1"
                                data-width="100%"
                                >
                              <option v-for="item in tombSectionLettersList" :value="item.value">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
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
</div>
<br><br>
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<link type="text/css" rel="stylesheet" href="../view/administration/editLists/editLists.css">
<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<script>
    new Vue({
        el: "#editListsApp",
        data: {
            value: null,
            columbariumTypesList: [],
            selectedColumbariumType: null,
            nicheTypesList: [],
            selectedNicheType: null,
            columbariumSectionLettersList: [],
            selectedColumbariumSectionLetter: null,
            tombSectionLettersList: [],
            selectedTombSectionLetter: null,
            
            successMessage: null,
            errors: []
        },
        created(){
            this.fetchColumbariumTypesList();
            this.fetchNicheTypesList();
            this.fetchColumbariumSectionLettersList();
            this.fetchTombSectionLettersList();
        },
        methods:{
            fetchColumbariumTypesList(){
                $.getJSON("controller.php",
                {
                    action: "fetchColumbariumTypesList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result));
                    this.columbariumTypesList = data;
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
            fetchColumbariumSectionLettersList(){
                $.getJSON("controller.php",
                {
                    action: "fetchColumbariumSectionLettersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.columbariumSectionLettersList = data
                    this.refreshSelectPicker();
                });
            },
            fetchTombSectionLettersList(){
                $.getJSON("controller.php",
                {
                    action: "fetchTombSectionLettersList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.tombSectionLettersList = data
                    this.refreshSelectPicker();
                })
            },
            addColumbariumType(){
                let request = {
                    columbariumType: this.selectedColumbariumType
                }
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addColumbariumType",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Columbarium Name was Successfully Added!"
                            this.selectedColumbariumType = null;
                            this.fetchColumbariumTypesList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Columbarium Name."]
                    }
                });
            },
            addNicheType(){
                let request = {
                    nicheType: this.selectedNicheType
                }
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addNicheType",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Niche Type was Successfully Added!"
                            this.selectedNicheType = null;
                            this.fetchNicheTypesList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Niche Type."]
                    }
                });
            },
            addColumbariumSectionLetter(){
                let request = {
                    sectionLetter: this.selectedColumbariumSectionLetter
                }
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addColumbariumSectionLetter",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Section Letter was Successfully Added!"
                            this.selectedColumbariumSectionLetter = null;
                            this.fetchColumbariumSectionLettersList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Columbarium Section Letter."]
                    }
                });
            },
            addTombSectionLetter(){
                let request = {
                    sectionLetter: this.selectedTombSectionLetter
                }
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addTombSectionLetter",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Section Letter was Successfully Added!"
                            this.selectedTombSectionLetter = null;
                            this.fetchTombSectionLettersList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Tomb Section Letter."]
                    }
                });
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            }
        }
    })
    $('.selectpicker').selectpicker({
      size: 4
    });
</script>
</body>
</html>
