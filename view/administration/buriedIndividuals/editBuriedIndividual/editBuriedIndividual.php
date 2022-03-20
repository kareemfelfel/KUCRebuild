<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Edit Buried Individual</h3>
<hr>

<div id="editBuriedIndividualApp" class="container-fluid">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Buried Individual</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group"> 
                        <!-- Text fields for editing contacts. -->
                        <label class="required" for="fName" class="required">First Name:</label>
                                <input v-model="buriedIndividual.firstName" type="text" class="form-control" id="fName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="middleName">Middle Name:</label>
                                <input v-model="buriedIndividual.middleName" type="text" class="form-control" id="middleName">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="lName" class="required">Last Name:</label>
                                <input v-model="buriedIndividual.lastName" type="text" class="form-control" id="lname" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="nickname">Nickname:</label>
                            <input v-model="buriedIndividual.nickname" type="text" class="form-control" id="nickname">
                        </div>
                    </div>
                </div><br>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="maidenName">Maiden Name:</label>
                            <input v-model="buriedIndividual.maidenName" type="text" class="form-control" id="maidenName">
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOB section -->
                        <label class="required" for="dob">Date of Birth:</label><br>
                            <input v-model="buriedIndividual.dob" type="date" class="form-control" id="dob">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOD section -->
                        <label class="required" for="dod">Date of Death:</label><br>
                            <input v-model="buriedIndividual.dod" type="date" class="form-control" id="dod">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Veteran status section. -->
                            <label>Veteran Status: </label>
                            <div class="custom-control custom-switch inactive-link">
                                <input v-model="buriedIndividual.veteran" type="checkbox" class="custom-control-input" id="open-switch">
                                <label class="custom-control-label" for="open-switch"></label>
                            </div>
                        </div>
                    </div>
                </div><br> <!-- end of row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="obituary">Obituary: </label><br>
                            <textarea v-model="buriedIndividual.obituary" id="obituary" class="form-control" rows="8" cols="30"></textarea>
                        </div>
                    </div>
                <!-- End of row -->
                </div><br>
                <div class="row">
                    <button type="button" @click="editBuriedIndividual" class="btn btn-success bottom-form-button">Edit</button>
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

<link rel="stylesheet" href="../view/administration/buriedIndividuals/editBuriedIndividual/editBuriedIndividual.css">
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
        el: "#editBuriedIndividualApp",
        data: {
            id: null,
            buriedIndividual: {
                firstName: null,
                middleName: null,
                lastName: null,
                nickname: null,
                maidenName: null,
                dob: null,
                dod: null,
                veteran: false,
                obituary: null
            },
            
            errors: [],
            successMessage: null
        },
        created(){
            this.getId();
            this.getBuriedIndividual();
        },
        methods: {
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
            getBuriedIndividual(){
                $.getJSON("controller.php",
                {
                    action: "fetchBuriedIndividualById",
                    id: this.id
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    this.errors = errors
                    let result = JSON.parse(JSON.stringify(response.result[0]))
                    this.buriedIndividual = result
                }).fail( () => {
                    this.errors = ["Failed to fetch selected Buried Individual."]
                })
            },
            editBuriedIndividual(){ 
                let request = {
                    firstName: this.buriedIndividual.firstName,
                    middleName: this.buriedIndividual.middleName,
                    lastName: this.buriedIndividual.lastName,
                    nickname: this.buriedIndividual.nickname,
                    maidenName: this.buriedIndividual.maidenName,
                    dob: this.buriedIndividual.dob,
                    dod: this.buriedIndividual.dod,
                    veteran: this.buriedIndividual.veteran,
                    obituary: this.buriedIndividual.obituary
                }
                
                $.ajax({
                    type: "POST",
                    url: `controller.php?action=editBuriedIndividual&id=${this.id}`,
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Buried Individual was Successfully Edited!"
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to edit Buried Individual."]
                    }
                });
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            }
        }
    })
</script>
