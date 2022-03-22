<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Edit Contacts</h3>
<hr>

<div id="editContactApp" class="container-fluid">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Contact</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group"> 
                        <!-- Text fields for editing contacts. -->
                        <label class="required" for="fName">First Name:</label>
                            <input v-model="contact.firstName" type="text" class="form-control" id="fName" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"> 
                        <label class="required" for="lName">Last Name:</label>
                            <input v-model="contact.lastName" type="text" class="form-control" id="lName" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"> 
                        <label class="required" for="aEmail">Email:</label>
                            <input v-model="contact.email" type="text" class="form-control" id="aEmail" required>
                    </div>
                </div>
            </div>

            <!-- Second Row -->
            <div class ="row">
                <div class="col-md-3">
                    <div class="form-group"> 
                        <label for="pTitle">Position Title:</label>
                            <input v-model="contact.title" type="text" class="form-control" id="pTitle">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"> 
                        <label class="required" for="pNumber">Phone Number</label>
                            <input v-model="contact.phoneNumber" type="text" class="form-control" id="pNumber" required>
                    </div>
                </div>
            </div>
            <!-- next row -->
            <div class="row">
                <div class="col-md-3">
                    <button @click="editContact" type="button" class="btn btn-success">Edit</button>
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

<link rel="stylesheet" href="../view/administration/contacts/contacts.css">
<style scoped>
    .message-box {
        position: fixed;
        bottom: 0;
        right: 5px;
        width: 300px;
    }
</style>
<script>
    new Vue ({
        el: "#editContactApp",
        data: {
            id: null,
            contact: {
                firstName: null,
                lastName: null,
                email: null,
                title: null,
                phoneNumber: null               
            },
            errors: [],
            successMessage: null           
        },
        created() {
                this.getId();
                this.getContact();
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
            getContact(){
                $.getJSON("controller.php",
                {
                    action: "fetchContactById",
                    id: this.id
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error));
                    this.errors = errors;
                    let result = JSON.parse(JSON.stringify(response.result[0]));
                    this.contact = result;
                }).fail( () => {
                    this.errors = ["Failed to fetch selected Contact."];
                });
            },
            editContact(){ 
                let request = {
                    firstName: this.contact.firstName,
                    lastName: this.contact.lastName,
                    phoneNumber: this.contact.phoneNumber,
                    email: this.contact.email,
                    title: this.contact.title
                };

                $.ajax({
                    type: "POST",
                    url: `controller.php?action=editContact&id=${this.id}`,
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error));
                        let result = JSON.parse(JSON.stringify(response.result));
                        this.errors = errors;
                        // result 0 will indicate a true or false for success or failure
                        if(result.length === 1 && result[0]){
                            this.successMessage = "Contact was Successfully Edited!";
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to edit Contact."];
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


