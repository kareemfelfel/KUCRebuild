<?php

/* 
 * This page has public access
 * 
 * Simple log-in form with AJAX to confirm the user identity.
 * Once Identity is confirmed, direct the user to the search page.
 */
?>
<br>
<div class="wrapper-div" id="loginApp"> 
    <h4 class="text-center title">Login</h4>
    <hr class="hr">
    <div class="row">
        <div class="col-md-12">
            <label for="username">Email:</label>
            <input v-model="email" type="text" class="form-control" id="userName"><br>
        </div>
    </div><!-- end of row -->

    <div class="row">
        <div class="col-md-12">
            <label for="password">Password:</label>
            <input v-model="password" type="password" class="form-control" id="password"><br> <!-- using password type -->
        </div>
    </div> <!-- end of row -->

    <div class="row">
        <div class="btns-wrapper">
            <button type="button" class="btn btn-success bottom-form-button" @click="login">Login</button>
        </div>
    </div> <!-- end of row -->
    
    <!-- Error Messages -->
    <div v-for="(error, index) in errors" 
         :key="index" class="alert alert-danger alert-dismissible fade show message-box" 
         >
        <button type="button" class="close" @click="clearError(index)">&times;</button>
        {{error}}
    </div>
</div>
<link rel="stylesheet" href="../view/login/login.css">
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
        el: "#loginApp",
        data:{
            errors: [],
            
            email: null,
            password: null
        },
        methods:{
            login(){
                let request = {
                    email: this.email,
                    password: this.password
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=login",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        this.errors = errors
                        if(this.errors.length === 0){
                            window.location.href = "controller.php?action=directToHomePage";
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to process Login request."]
                    }
                });
            }
        }
    })
</script>
</body>
</html>
