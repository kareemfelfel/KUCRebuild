<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<h3 class="text-center">Edit Columbarium</h3>
<hr>

<div id="editColumbariumSelectorApp" class="container-fluid">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Columbarium Selector</h4>
        </div>
        <div class="panel-body">
            <div class ="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select a Columbarium</label> <br>
                        <div style="float: left; width: 80%">
                            <select 
                                class="selectpicker"
                                id="columbarium"
                                data-live-search="true"
                                v-model="selectedColumbariumId"
                                data-width="100%"
                            >
                                <option v-for="item in columbariumsList" :value="item.value">{{item.name}}</option>

                            </select>
                        </div>

                        <div class="input-group-append">
                        <button @click="directToEditColumbariumPage"
                            type="button"
                            :disabled="selectedColumbariumId == null"
                            class="btn btn-success" 
                            style="border-radius: 0px;"><span class="fa fa-edit"></span>
                        </button>
                        <button
                            type="button"
                            @click="deleteColumbarium"
                            :disabled="selectedColumbariumId == null"
                            class="btn btn-danger" 
                            style="border-radius: 0px 5px 5px 0px"><span class="fa fa-trash"></span>
                        </button>  
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
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<link type="text/css" rel="stylesheet" href="../view/columbarium/editColumbarium/selector.css">
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
        el: "#editColumbariumSelectorApp",
        data: {
            selectedColumbariumId: null,
            columbariumsList: [],
            
            errors: [],
            successMessage: null
        },
        created(){
            this.fetchColumbariumsList()
        },
        methods:{
            fetchColumbariumsList(){
                $.getJSON("controller.php",
                {
                    action: "fetchAllColumbariumsList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.columbariumsList = data
                    this.refreshSelectPicker();
                });
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            },
            directToEditColumbariumPage(){
                if(this.selectedColumbariumId != null){
                    window.location.href=`controller.php?action=directToEditColumbariumPage&id=${this.selectedColumbariumId}`
                }
            },
            deleteColumbarium(){
                $.getJSON("controller.php",
                {
                    action: "deleteColumbarium",
                    id: this.selectedColumbariumId
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    let result = JSON.parse(JSON.stringify(response.result))
                    this.errors = errors
                    // result 0 will indicate a true or false for success or failure
                    if(result.length == 1 && result[0]){
                        this.successMessage = "Columbarium was Successfully deleted!"
                        this.selectedColumbariumId = null;
                        this.fetchColumbariumsList();
                        this.refreshSelectPicker();
                    }
                }).fail( () => {
                    this.errors = ["Failed to delete columbarium."]
                })
            },
            clearError(index){
                this.errors.splice(index, 1);
            },
            clearSuccessMessage(){
                this.successMessage = null;
            }
        }
            
    });
$('.selectpicker').selectpicker({
  size: 4
});
</script>

