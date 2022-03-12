<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<script type="text/javascript" src="../view/administration/buriedIndividuals/buriedIndividuals.js"></script>
<br>
<h3 class="text-center">Buried Individuals</h3>
<hr>

<div id="buriedIndividualsApp" class="container-fluid">
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
            </a> Add Buried Individual
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in show">
          <div class="panel-body">
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Text fields for buried individuals names. -->
                            <label class="required" for="fName" class="required">First Name:</label>
                                <input v-model="firstName" type="text" class="form-control" id="fName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="middleName">Middle Name:</label>
                                <input v-model="middleName" type="text" class="form-control" id="middleName">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="lName" class="required">Last Name:</label>
                                <input v-model="lastName" type="text" class="form-control" id="lname" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="maidenName">Maiden Name:</label>
                            <input v-model="maidenName" type="text" class="form-control" id="maidenName">
                        </div>
                    </div>
                </div><br>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOB section -->
                        <label class="required" for="dob">Date of Birth:</label><br>
                            <input v-model="dob" type="date" class="form-control" id="dob">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOD section -->
                        <label class="required" for="dod">Date of Death:</label><br>
                            <input v-model="dod" type="date" class="form-control" id="dod">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Veteran status section. -->
                            <label>Veteran Status: </label>
                            <div class="custom-control custom-switch inactive-link">
                                <input v-model="veteran" type="checkbox" class="custom-control-input" id="open-switch">
                                <label class="custom-control-label" for="open-switch"></label>
                            </div>
                        </div>
                    </div>
                </div><br> <!-- end of row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="obituary">Obituary: </label><br>
                            <textarea v-model="obituary" id="obituary" class="form-control" rows="8" cols="30"></textarea>
                        </div>
                    </div>
                <!-- End of row -->
                </div><br>
                <div class="row">
                    <button type="button" @click="addBuriedIndividual" class="btn btn-success bottom-form-button">Submit</button>
                    <button type="button" class="btn btn-default bottom-form-button">Cancel</button>
                </div>
            </div> 
        </div> 
    <!-- end of panel -->
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
                </a> Edit Buried Individual
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show"> 
            <div class="panel-body">
                <div class ="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Select a Buried Individual</label> <br>
                              <div style="float: left; width: 80%">
                                  <select 
                                      class="selectpicker"
                                      id="buried-individuals"
                                      data-live-search="true"
                                      v-model="selectedBuriedIndividualId"
                                      data-width="100%"
                                      >
                                    <option v-for="item in buriedIndividualsList" :value="item.value">{{item.name}}</option>
                                    
                                  </select>
                              </div>
                                  <div class="input-group-append">
                                  <button @click="directToEditBuriedIndividualPage"
                                      type="button"
                                      :disabled="selectedBuriedIndividualId == null"
                                      class="btn btn-success" 
                                      style="border-radius: 0px 5px 5px 0px"><span class="fa fa-edit"></span></button>
                                  </div>
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
<link type="text/css" rel="stylesheet" href="../view/administration/buriedIndividuals/buriedIndividuals.css">
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
        el: "#buriedIndividualsApp",
        data: {
            buriedIndividualsList: [],
            errors: [],
            successMessage: null,
            selectedBuriedIndividualId: null,
            
            
            firstName: null,
            middleName: null,
            lastName: null,
            maidenName: null,
            dob: null,
            dod: null,
            veteran: false,
            obituary: null
        },
        created(){
            this.fetchBuriedIndividualsList()
        },
        methods:{
            directToEditBuriedIndividualPage(){
                if(this.selectedBuriedIndividualId != null){
                    window.location.href=`controller.php?action=directToEditBuriedIndividualPage&id=${this.selectedBuriedIndividualId}`
                }
            },
            addBuriedIndividual(){
                let request = {
                    firstName: this.firstName,
                    middleName: this.middleName,
                    lastName: this.lastName,
                    maidenName: this.maidenName,
                    dob: this.dob,
                    dod: this.dod,
                    veteran: this.veteran,
                    obituary: this.obituary
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addBuriedIndividual",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Buried Individual was Successfully Added!"
                            this.clearForm();
                            this.fetchBuriedIndividualsList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Buried Individual."]
                    }
                });
            },
            clearForm(){
                this.firstName = null
                this.middleName = null
                this.lastName = null
                this.maidenName = null
                this.dob = null
                this.dod = null
                this.veteran = false
                this.obituary = null
            },
            fetchBuriedIndividualsList(){
                $.getJSON("controller.php",
                {
                    action: "fetchAllBuriedIndividualsList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.buriedIndividualsList = data
                    this.refreshSelectPicker();
                })
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            }
            
        }
    })
$('.selectpicker').selectpicker({
  size: 4
});
</script>
</body>
</html>
