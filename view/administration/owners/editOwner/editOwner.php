<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Edit Owner</h3>
<hr>

<div id="editOwnerApp" class="container-fluid">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Owner</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group"> 
                        <!-- Text fields for editing buried individuals info. -->
                        <label for="fName" class="required">First Name:</label>
                            <input v-model="owner.firstName" type="text" class="form-control" id="fName" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                            <input v-model="owner.middleName" type="text" class="form-control" id="middleName">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="lName" class="required">Last Name:</label>
                            <input v-model="owner.lastName" type="text" class="form-control" id="lname" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                        <input v-model="owner.phoneNumber" type="text" class="form-control" id="phoneNumber">
                    </div>
                </div>
            </div>
            <!-- second row -->
            <div class ="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <!-- DOD section -->
                    <label for="address">Address:</label>
                        <textarea v-model="owner.address" id="address" class="form-control" rows="4" cols="30"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <!-- DOB section -->
                    <label for="email">Email:</label>
                        <input v-model="owner.email" type="text" class="form-control" id="email">
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-3">
                    <button @click="editOwner" type="button" class="btn btn-success bottom-form-button">Edit</button>
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

<link rel="stylesheet" href="../view/administration/owners/editOwner/editOwner.css">
<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<script>
    /* script for binding data */
    new Vue({
            el: "#editOwnerApp",
            data: {
                id: null,
                owner:{
                    firstName: null,
                    middleName: null,
                    lastName: null,
                    phoneNumber: null,
                    address: null,
                    email: null
                },
                errors: [],
                successMessage: null
            },
            Created() {
                this.getId();
                this.getOwner();
            },
            methods: {
                getId(){
                let uri = window.location.href.split('?');
                if(uri.length === 2) {
                  let vars = uri[1].split('&');
                  let getVars = {};
                  let tmp = '';
                  vars.forEach(function(v) {
                    tmp = v.split('=');
                    if(tmp.length === 2)
                      getVars[tmp[0]] = tmp[1];
                  });
                  this.id = getVars['id'];
                }
                },
                getOwner(){
                    $.getJSON("controller.php",
                    {
                        action: "getOwnerById",
                        id: this.id
                    },response => {
                        let errors = JSON.parse(JSON.stringify(response.error));
                        this.errors = errors;
                        let result = JSON.parse(JSON.stringify(response.result[0]));
                        this.owner = result;
                    }).fail( () => {
                        this.errors = ["Failed to fetch selected Owner."];
                    });
                },
                editOwner(){ 
                    let request = {
                        firstName: this.owner.firstName,
                        middleName: this.owner.middleName,
                        lastName: this.owner.lastName,
                        phoneNumber: this.owner.phoneNumber,
                        address: this.owner.address,
                        email: this.owner.email
                    };

                    $.ajax({
                        type: "POST",
                        url: `controller.php?action=editOwner&id=${this.id}`,
                        data: {request: JSON.stringify(request)},
                        dataType: "json",
                        success: (response) => {
                            let errors = JSON.parse(JSON.stringify(response.error));
                            let result = JSON.parse(JSON.stringify(response.result));
                            this.errors = errors;
                            // result 0 will indicate a true or false for success or failure
                            if(result.length === 1 && result[0]){
                                this.successMessage = "Owner was Successfully Edited!";
                            }
                        },
                        error: () =>{
                            this.errors = ["Failed to edit Owner."];
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
        });
    
        

</script>
    