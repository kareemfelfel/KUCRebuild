<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<h3 class="text-center"><span class="fa fa-lock"></span> Public Access</h3>
<hr>
<div class="container-fluid" id="publicAccessApp">
    <p> This page is used to restrict Guests to certain modules. By default, Guests can access <b>Home</b>, <b>Contact Us</b>, and <b>Login</b> pages.
        The modules listed below are the <b>only</b> modules that a guest can gain access to.
    </p>
    
    <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Modules</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group"> 
                        <!-- Text fields for editing contacts. -->
                        <label>Search Lot 
                            <span class="fa fa-info-circle" 
                                  style="color: #3498db" 
                                  data-container="body" 
                                  data-toggle="popover" 
                                  data-placement="top" 
                                  data-content="Giving guests access to Search Lot will give them access to the Search Lot page including the map view and View Lot page. 
                                  Guests will ONLY be able to see information about the buried individuals and Lot information except for the price field and notes.">
                            </span>
                        </label>
                        <div class="custom-control custom-switch inactive-link">
                            <input v-model='modules.searchLot' type="checkbox" class="custom-control-input" id="open-switch-3" @change="editAccessibleModule('LotSearch', modules.searchLot)">
                            <label class="custom-control-label" for="open-switch-3"></label>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class=""> 
                        <!-- Text fields for editing contacts. -->
                        <label>Search Columbarium 
                            <span class="fa fa-info-circle" 
                                  style="color: #3498db" 
                                  data-toggle="popover" 
                                  data-placement="top" 
                                  data-content="Giving guests access to Search Columbarium will give them access to the Search Columbarium page and View Columbarium page. 
                                  Guests will ONLY be able to see information about the buried individuals and Columbarium Information except for the price field.">
                            </span>
                        </label>
                        
                        <div class="custom-control custom-switch inactive-link">
                            <input v-model='modules.searchColumbarium' type="checkbox" class="custom-control-input" id="open-switch-4" @change="editAccessibleModule('ColumbariumSearch', modules.searchColumbarium)">
                            <label class="custom-control-label" for="open-switch-4"></label>
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
<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<style>
.inactive-link {
   cursor: default;
}
.bottom-form-button {
    margin-left: 15px;
}
</style>
<script>
    new Vue({
        el: "#publicAccessApp",
        data:{
            successMessage: null,
            errors: [],
            modules:{
                searchLot: false,
                searchColumbarium: false
            } 
        },
        created(){
            this.fetchAccessibleModules();
        },
        methods:{
            fetchAccessibleModules(){
                $.getJSON("controller.php",
                {
                    action: "fetchAccessibleModules"
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    this.errors = errors
                    let result = JSON.parse(JSON.stringify(response.result))
                    this.modules = result
                }).fail(() =>{
                    this.errors = ["failed to fetch modules."]
                });
            },
            editAccessibleModule(module, access){
                let request = {
                    module: module,
                    guestAccess: access
                }
                
                $.ajax({
                    type: "POST",
                    url: "controller.php?action=editAccessibleModule",
                    data: {request: JSON.stringify(request)},
                    dataType: "json",
                    success: (response) => {
                        let errors = JSON.parse(JSON.stringify(response.error))
                        let result = JSON.parse(JSON.stringify(response.result))
                        this.errors = errors
                        // result 0 will indicate a true or false for success or failure
                        if(result.length == 1 && result[0]){
                            this.successMessage = "Module was successfully updated!"
                        }
                    },
                    error: () =>{
                        this.errors = ["Failed to Update Module."]
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
$("[data-toggle='popover']").popover({
    trigger: 'click'
})
</script>