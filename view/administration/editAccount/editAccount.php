<?php
?>
<div id="editAccount">
    <br>
    <h3 class="text-center">Edit Account</h3>
    <hr>
    <div class="container-fluid">
        <div class="panel-group">
            <div class="panel panel-default" id="accordion1">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a 
                        data-toggle="collapse" 
                        data-parent="#accordion1" 
                        href="#collapse1" 
                        class="fa inactive-link"
                        :class="{'fa-caret-down': accountInfoPanelActive, 'fa-caret-right': !accountInfoPanelActive}"
                        @click="accountInfoPanelActive = !accountInfoPanelActive"
                        >
                    </a> Account Information
                  </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in show">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input v-model="info.firstName" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input v-model="info.lastName" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input v-model="info.email" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <button type="button" class="btn btn-success bottom-form-button" @click="editAccount">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <br>
            <!-- SECOND PANEL -->
            <div class="panel panel-default" id="accordion2">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a 
                      data-toggle="collapse" 
                      data-parent="#accordion2" 
                      href="#collapse2" 
                      class="fa inactive-link"
                      :class="{'fa-caret-down': updatePasswordPanelActive, 'fa-caret-right': !updatePasswordPanelActive}"
                      @click="updatePasswordPanelActive = !updatePasswordPanelActive"
                      >
                  </a> Update Password
                </h4>
              </div>
              <div id="collapse2" class="panel-collapse collapse in show">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Current Password</label>
                                <input v-model="updatePasswordCurrentPassword" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="password">New Password 
                                <span class="required">  </span>
                                <span class="fa fa-info-circle associations-popover" 
                                      style="color: #3498db" 
                                      data-container="body" 
                                      data-toggle="popover" 
                                      data-placement="top" 
                                    data-content="Passwords must be of at least 8 characters long, have 1 uppercase letter, 1 lowercase letter, and 1 number.">

                                </span>
                            </label>
                            <div class="input-group">
                                <input v-if="!showUpdatePasswordNewPassword" v-model="updatePasswordNewPassword" type="password" class="form-control">
                                <input v-else type="text" v-model="updatePasswordNewPassword" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text pswd-eye" @click="toggleShow"><span class="icon is-small is-right">
                                            <i class="fas" :class="{ 'fa-eye-slash': showUpdatePasswordNewPassword, 'fa-eye': !showUpdatePasswordNewPassword }"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <button type="button" class="btn btn-success bottom-form-button" @click="updatePassword">Submit</button>
                    </div>
                </div>
              </div>
            </div>
            
            
            <br>
            <!-- THIRD PANEL -->
            <div class="panel panel-default" id="accordion3">
                <div class="panel-heading">
                    <h4 class="panel-title">
                      <a 
                          data-toggle="collapse" 
                          data-parent="#accordion3" 
                          href="#collapse3" 
                          class="fa inactive-link"
                          :class="{'fa-caret-down': deactivateAccountPanelActive, 'fa-caret-right': !deactivateAccountPanelActive}"
                          @click="deactivateAccountPanelActive = !deactivateAccountPanelActive"
                          >
                      </a> Deactivate Account
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse in show">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="required">Password</label>
                                    <input v-model="deactivateAccountPassword1" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="required">Confirm Password</label>
                                    <input v-model="deactivateAccountPassword2" type="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left: 7px;">
                            <input id="cb" v-model="deactivateAccountCheckBox" type="checkbox" style="float: left; margin-top: 5px;">
                            <div style="margin-left: 25px;" class="required">
                                By checking this box I agree that my account will be deleted and I will not be able to log in or use any information I had access to.
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <button type="button" class="btn btn-success bottom-form-button" @click="deleteAccount">Submit</button>
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
</div>
<style scoped>
    .message-box {
        position: fixed;
        bottom: 0;
        right: 5px;
        width: 300px;
    }
    .bottom-form-button{
        margin-left: 15px;
    }
    .required:after {
        content:" *";
        color: red;
        margin-right: 5px;
    }
</style>
<script>
    new Vue({
        el: "#editAccount",
        data:{
            accountInfoPanelActive: true,
            updatePasswordPanelActive: true,
            deactivateAccountPanelActive: true,
            errors: [],
            successMessage: null,
            info: {
                firstName: null,
                lastName: null,
                email: null
            },
            updatePasswordCurrentPassword: null,
            updatePasswordNewPassword: null,
            deactivateAccountPassword1: null,
            deactivateAccountPassword2: null,
            deactivateAccountCheckBox: false,
            
            showUpdatePasswordNewPassword: false
        },
        created(){
            this.fetchCurrentAdmin()
        },
        methods:{
            fetchCurrentAdmin(){
                $.getJSON("controller.php",
                {
                    action: "fetchCurrentAdmin"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.info = data
                });
            },
            editAccount(){
                let request = {
                    firstName: this.info.firstName,
                    lastName: this.info.lastName,
                    email: this.info.email
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=editAdmin",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Account Info was Successfully Edited!"
                            document.getElementById("navbar-admin-name").innerHTML = request.firstName
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to edit account info."]
                    }
                })
            },
            updatePassword(){
                let request = {
                    currentPassword: this.updatePasswordCurrentPassword,
                    newPassword: this.updatePasswordNewPassword
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=editAdminPassword",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Password is successfuly updated!"
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to update password."]
                    }
                })
            },
            deleteAccount(){
                let request = {
                    password1: this.deactivateAccountPassword1,
                    password2: this.deactivateAccountPassword2,
                    confirm: this.deactivateAccountCheckBox
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=deleteAdmin",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            window.location.href = "controller.php?action=logout"
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to deactivate account."]
                    }
                })
            },
            toggleShow(){
                this.showUpdatePasswordNewPassword = !this.showUpdatePasswordNewPassword
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            }
        }
    })
$('.associations-popover').popover({
    trigger: 'click'
});
</script>
