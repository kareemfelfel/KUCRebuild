<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Contacts</h3>
<hr>

<!-- For collapsible panels -->
<div id="contactsApp" class="container-fluid">
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
            </a> Add Contact
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in show">
          <div class="panel-body">
              <!-- First Row -->
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <!-- Text fields for adding contacts. -->
                            <label class="required" for="fName">First Name:</label>
                                <input v-model="firstName" type="text" class="form-control" id="fName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label class="required" for="lName">Last Name:</label>
                                <input v-model="lastName" type="text" class="form-control" id="lName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label class="required" for="aEmail">Email:</label>
                                <input v-model="email" type="text" class="form-control" id="aEmail" required>
                        </div>
                    </div>
                </div>
              
                              <!-- Second Row -->
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label for="pTitle">Position Title:</label>
                                <input v-model="title" type="text" class="form-control" id="pTitle">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label class="required" for="pNumber">Phone Number</label>
                                <input v-model="phoneNumber" type="text" class="form-control" id="pNumber" required>
                        </div>
                    </div>
                </div>
                <!-- next row -->
                <div class="row">
                    <button type="button" @click="addContact" class="btn btn-success bottom-form-button">Submit</button>
                    <button type="button" class="btn btn-default bottom-form-button">Cancel</button>
                </div>
          </div>
        </div>
      </div><br>
        <!-- second panel -->
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
                </a> Edit Contact
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show"> 
            <div class="panel-body">
                  <!-- new row -->
                  <div class ="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Select Contact</label> <br>
                                <div style="float: left; width: 80%">
                                    <!-- for single select list -->
                                    <select 
                                        class="selectpicker"
                                        id="contacts"
                                        v-model="selectedContactId"
                                        data-live-search="true"
                                        data-width="100%"
                                        >
                                      <option v-for="item in contactsList" :value="item.value">{{item.name}}</option>
                                    </select>
                                </div>
                                <div class="input-group-append">
                                    <button @click="directToEditContactPage"
                                        type="button" 
                                        :disabled="selectedContactId == null"
                                        class="btn btn-success" 
                                        style="border-radius: 0px 0px 0px 0px"><span class="fa fa-edit"></span>
                                    </button>
                                    <button
                                        type="button"
                                        @click="deleteContact"
                                        :disabled="selectedContactId == null"
                                        class="btn btn-danger" 
                                        style="border-radius: 0px 5px 5px 0px"><span class="fa fa-trash"></span>
                                    </button>     
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
    <br><br>
</div>

<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<link rel="stylesheet" href="../view/administration/contacts/contacts.css">
<script type="text/javascript" src="../view/administration/contacts/contacts.js"></script>
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
        el: "#contactsApp",
        data:{
            firstName: null,
            lastName: null,
            email: null,
            title: null,
            phoneNumber: null,
            
            selectedContactId: null,
            contactsList: [],
            errors: [],
            successMessage: null
        },
        created(){
            this.fetchContactsList()
        },
        methods:{
            fetchContactsList(){
                $.getJSON("controller.php",
                {
                    action: "fetchContactsList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.contactsList = data
                    this.refreshSelectPicker();
                })
            },
            addContact(){
                let request = {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    title: this.title,
                    phoneNumber: this.phoneNumber
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addContact",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Contact was Successfully Added!"
                            this.clearForm();
                            this.fetchContactsList();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Contact."]
                    }
                });
            },
            directToEditContactPage(){
                if(this.selectedContactId != null){
                    window.location.href=`controller.php?action=directToEditContactPage&id=${this.selectedContactId}`
                }
            },
            deleteContact(){
                $.getJSON("controller.php",
                {
                    action: "deleteContact",
                    id: this.selectedContactId
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    let result = JSON.parse(JSON.stringify(response.result))
                    this.errors = errors
                    // result 0 will indicate a true or false for success or failure
                    if(result.length == 1 && result[0]){
                        this.successMessage = "Contact was Successfully deleted!"
                        this.selectedContactId = null;
                        this.fetchContactsList();
                        this.refreshSelectPicker();
                    }
                }).fail( () => {
                    this.errors = ["Failed to delete contact."]
                })
            },
            clearForm(){
                this.firstName = null
                this.lastName = null
                this.email = null
                this.title = null
                this.phoneNumber = null
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

