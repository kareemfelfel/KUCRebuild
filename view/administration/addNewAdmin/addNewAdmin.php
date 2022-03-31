<?php

/* 
 * 
 */

?>

<br>
<div class="wrapper-div" id="addAdminApp"> 
    <h4 class="text-center title">Add New Admin</h4>
    <hr class="hr">
    <div class="row">
        <div class="col-md-6">
            <label for="userName" class="required">Email:</label>
            <input v-model="email" type="text" class="form-control" id="email"><br>
        </div>
        <div class="col-md-6">
            <label for="firstName" class="required">First Name:</label>
            <input v-model="firstName" type="text" class="form-control" id="firstName"><br>
        </div>
    </div><!-- end of row -->

    <div class="row">
        <div class="col-md-6">
            <label for="lastName" class="required">Last Name:</label>
            <input v-model="lastName" type="text" class="form-control" id="lastName"><br>
        </div>
        <div class="col-md-6">
            <label for="password">Password: 
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
                <input v-if="!showPassword" v-model="password" type="password" class="form-control">
                <input v-else type="text" v-model="password" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text pswd-eye" @click="toggleShow"><span class="icon is-small is-right">
                            <i class="fas" :class="{ 'fa-eye-slash': showPassword, 'fa-eye': !showPassword }"></i></span>
                    </span>
                </div>
            </div>
        </div>
    </div> <!-- end of row -->

    <div class="row">
        <div class="btns-wrapper">
            <button type="button" class="btn btn-success bottom-form-button" @click="addAdmin">Submit</button>
        </div>
    </div> <!-- end of row -->
    
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
<link rel="stylesheet" href="../view/administration/addNewAdmin/addNewAdmin.css">
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
        el: "#addAdminApp",
        data:{
            showPassword: false,
            errors: [],
            successMessage: null,
            
            firstName: null,
            lastName: null,
            email: null,
            password: null
        },
        methods: {
            addAdmin(){
                let request = {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    password: this.password
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=addAdmin",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Admin was Successfully Added!"
                            this.clearForm();
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Add Admin."]
                    }
                });
            },
            clearForm(){
                this.firstName = null;
                this.lastName = null;
                this.email = null;
                this.password = null;
            },
            toggleShow(){
                this.showPassword = !this.showPassword;
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            }
        }
    });
$('.associations-popover').popover({
  trigger: 'click'
})
</script>
</body>
</html>


