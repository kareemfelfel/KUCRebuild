<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<h3 class="text-center">Edit Lot</h3>
<hr>

<div id="editTombSelectorApp" class="container-fluid">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Lot Selector</h4>
        </div>
        <div class="panel-body">
            <div class ="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Select a Lot</label> <br>
                        <div style="float: left; width: 80%">
                            <select 
                                class="selectpicker"
                                id="lots"
                                data-live-search="true"
                                v-model="selectedLotId"
                                data-width="100%"
                            >
                                <option v-for="item in lotsList" :value="item.value">{{item.name}}</option>

                            </select>
                        </div>

                        <div class="input-group-append">
                        <button @click="directToEditLotPage"
                            type="button"
                            :disabled="selectedLotId == null"
                            class="btn btn-success" 
                            style="border-radius: 0px;"><span class="fa fa-edit"></span>
                        </button>
                        <button
                            type="button"
                            @click="deleteLot"
                            :disabled="selectedLotId == null"
                            class="btn btn-danger" 
                            style="border-radius: 0px 5px 5px 0px"><span class="fa fa-trash"></span>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
<link type="text/css" rel="stylesheet" href="../view/tomb/editTomb/selector.css">
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
        el: "#editTombSelectorApp",
        data: {
            selectedLotId: null,
            lotsList: [],
            
            errors: [],
            successMessage: null
        },
        created(){
            this.fetchLotsList()
        },
        methods:{
            fetchLotsList(){
                $.getJSON("controller.php",
                {
                    action: "fetchAllTombsList"
                },response => {
                    let data = JSON.parse(JSON.stringify(response.result))
                    this.lotsList = data
                    this.refreshSelectPicker();
                });
            },
            refreshSelectPicker(){
                this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
            },
            directToEditLotPage(){
                if(this.selectedLotId != null){
                    window.location.href=`controller.php?action=directToEditTombPage&id=${this.selectedLotId}`
                }
            },
            deleteLot(){
                $.getJSON("controller.php",
                {
                    action: "deleteTomb",
                    id: this.selectedLotId
                },response => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    let result = JSON.parse(JSON.stringify(response.result))
                    this.errors = errors
                    // result 0 will indicate a true or false for success or failure
                    if(result.length == 1 && result[0]){
                        this.successMessage = "Lot was Successfully deleted!"
                        this.selectedLotId = null;
                        this.fetchLotsList();
                        this.refreshSelectPicker();
                    }
                }).fail( () => {
                    this.errors = ["Failed to delete lot."]
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
