<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript" src="../view/administration/owners/owners.js"></script>

<br>
<h3 class="text-center">Owners</h3>
<hr>

<div id="ownersApp" class="container-fluid">
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
                </a> Add Owner
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in show">
              <div class="panel-body">
                    <div class ="row">
                        <div class="col-md-3">
                            <div class="form-group">

                                <!-- Text fields for buried individuals names. -->
                                <label for="fName" class="required">First Name:</label>
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
                                <label for="lName" class="required">Last Name:</label>
                                    <input v-model="lastName" type="text" class="form-control" id="lname" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                                <input v-model="phoneNumber" type="text" class="form-control" id="phoneNumber">
                            </div>
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <!-- DOD section -->
                            <label for="address">Address:</label>
                                <textarea v-model="address" id="address" class="form-control" rows="4" cols="30"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <!-- DOB section -->
                            <label for="email">Email:</label>
                                <input v-model="email" type="text" class="form-control" id="email">
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-3">
                                <button type="button" @click="addOwner" class="btn btn-success">Submit</button>
                                <button type="button" class="btn btn-default bottom-form-button">Cancel</button>
                        </div>
                    </div>
                </div> 
            </div>
          </div><br>
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
                    </a> Edit Owner
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse in show"> 
                <div class="panel-body">
                    <div class ="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="">Select an Owner</label> <br>
                                  <div style="float: left; width: 80%">
                                      <select 
                                          class="selectpicker"
                                          id="owners"
                                          data-live-search="true"
                                          v-model="selectedOwnerId"
                                          data-width="100%"
                                          >
                                          <option v-for="item in ownersList" :value="item.value">{{item.name}}</option>
                                      </select>
                                  </div>
                                      <div class="input-group-append">
                                      <button
                                          @click="directToEditOwnerPage"
                                          type="button" 
                                          :disabled="selectedOwnerId == null"
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
<link type="text/css" rel="stylesheet" href="../view/administration/owners/owners.css">

<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>

<script>
    /*vue script */
    new Vue({
        el: "#ownersApp",
        data: {
            firstName: null,
            middleName: null,
            lastName: null,
            email: null,
            phoneNumber: null,
            address: null,

            ownersList: [],
            selectedOwnerId: null,
            errors: [],
            successMessage: null
        },
        created(){
            this.fetchOwnersList()
        },
        methods:{
            /* fetch data for owners list */
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
            directToEditOwnerPage(){
                if(this.selectedOwnerId != null){
                    window.location.href=`controller.php?action=directToEditOwnerPage&id=${this.selectedOwnerId}`
                }
            },
            /* set all data to null */
            clearForm(){
                this.firstName=null
                this.middleName=null
                this.lastName=null
                this.email=null
                this.phoneNumber=null
                this.address=null
            },
            
            addOwner(){
                let request = {
                    firstName: this.firstName,
                    middleName: this.middleName,
                    lastName: this.lastName,
                    email: this.email,
                    phoneNumber: this.phoneNumber,
                    address: this.address
                }
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addOwner",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Owner was Successfully Added!"
                            this.clearForm();
                            this.fetchOwnersList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Owner."]
                    }
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
    
    /* for selectPicker class */
    $('.selectpicker').selectpicker({
      size: 4
    });
</script>
</body>
</html>

