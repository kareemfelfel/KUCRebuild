<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<br>
<h3 class="text-center">Add Columbarium</h3>
<hr>
<div id="addColumbariumApp" class="container-fluid">
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
            </a> Columbarium Information
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in show">
            <div class="panel-body">
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required">Columbarium</label><br>
                            <select 
                                class="selectpicker"
                                id="section-letter"
                                data-live-search="true"
                                data-width="100%"
                                v-model="columbariumTypeId"
                                >
                              <option v-for="item in columbariumTypesList" :value="item.value">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required">Niche</label><br>
                            <select 
                                class="selectpicker"
                                id="section-letter"
                                data-live-search="true"
                                data-width="100%"
                                v-model="nicheTypeId"
                                >
                              <option v-for="item in nicheTypesList" :value="item.value">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required">Section Letter</label><br>
                            <select 
                                class="selectpicker"
                                id="section-letter"
                                data-live-search="true"
                                data-width="100%"
                                v-model="sectionLetterId"
                                >
                              <option v-for="item in sectionLettersList" :value="item.value">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required">Section Number</label>
                            <input v-model="sectionNumber" type="number" class="form-control" id="section-number" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Main Image</label>
                            <div class="input-group">
                                <input class="form-control curved-input" type="file" id="mainImage" accept="image/*" ref="mainImage" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input v-model="price" type="number" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="for-sale-switch">For Sale</label>
                            <div class="custom-control custom-switch inactive-link">
                                <input v-model="forSale" type="checkbox" class="custom-control-input" onclick="disableForOpen(this)" id="for-sale-switch">
                                <label class="custom-control-label" for="for-sale-switch"></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Purchase Date</label>
                            <input v-model="purchaseDate" type="date" class="form-control" id="purchaseDate" placeholder="Select a Date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <br>
      <!-- Second panel -->
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
            </a> Associations 
            <span class="fa fa-info-circle associations-popover" style="color: #3498db" data-container="body" data-toggle="popover" data-placement="top" data-content="Associations can be added only when a columbarium is not for sale.">
            </span>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show">
          <div class="panel-body">
            <div class ="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label id="owner-label" class="required">Owner</label> <br>
                        <select 
                            class="selectpicker"
                            id="owner"
                            data-live-search="true"
                            data-width="100%"
                            v-model="ownerId"
                            >
                          <option v-for="item in ownersList" :value="item.value">{{item.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Buried Individual(s)</label> <br>
                        <select 
                            class="selectpicker"
                            id="buried-individuals"
                            data-live-search="true"
                            data-width="100%"
                            multiple
                            v-model="buriedIndividualIds"
                            >
                          <option v-for="item in buriedIndividualsList" :value="item.value">{{item.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- Third panel -->
      <div class="panel panel-default" id="accordion3">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a 
                data-toggle="collapse" 
                data-parent="#accordion3" 
                href="#collapse3" 
                class="fa fa-caret-down inactive-link"
                onclick="changeIcon(this)"
                >
            </a> Attachments
          </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse in show">
          <div class="panel-body">
            <div class ="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">All Attached Documents - Including Deed</label>
                        <div class="input-group">
                            <input class="form-control curved-input" type="file" id="attached-documents" multiple ref="attachments"/>
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
    
    <br>
    <button type="button" class="btn btn-success" style="margin-right: 10px;" @click="addColumbarium">Submit</button>
    <button type="button" class="btn btn-default">Cancel</button>
    <br><br>
</div>
<link rel="stylesheet" type="text/css" href="../view/columbarium/addColumbarium/addColumbarium.css">
<script type="text/javascript" src="../view/columbarium/addColumbarium/addColumbarium.js"></script>
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<style scoped>
.message-box {
    position: fixed;
    bottom: 0;
    right: 5px;
    width: 300px;
}
</style>
<script>
App = new Vue({
    el: "#addColumbariumApp",
    data: () => {
        return{
            columbariumTypeId: null,
            nicheTypeId: null,
            sectionLetterId: null,
            sectionNumber: null,
            price: null,
            forSale: false,
            purchaseDate: null,
            ownerId: null,
            buriedIndividualIds: [],
            
            sectionLettersList: [],
            nicheTypesList: [],
            columbariumTypesList: [],
            ownersList: [],
            buriedIndividualsList: [],
            errors: [],
            successMessage: null
        }
    },
    created(){
        this.fetchSectionLettersList();
        this.fetchNicheTypesList();
        this.fetchColumbariumTypesList();
        this.fetchOwnersList();
        this.fetchBuriedIndividualsList();
    },
    methods:{
        addColumbarium(){
            let formData = new FormData();
            let request = {
                columbariumTypeId: this.columbariumTypeId,
                nicheTypeId: this.nicheTypeId,
                sectionLetterId: this.sectionLetterId,
                sectionNumber: this.sectionNumber,
                price: this.price,
                forSale: this.forSale,
                purchaseDate: this.purchaseDate,
                ownerId: this.ownerId,
                buriedIndividualIds: this.buriedIndividualIds
            }
            
            formData.append('request', JSON.stringify(request))
            if(this.$refs.mainImage.files[0])
                formData.append('mainImage', this.$refs.mainImage.files[0]);

            let attachments = this.$refs.attachments.files;
            for(var i =0; i< attachments.length; i++){
                formData.append('attachedDocuments[]', attachments[i]);
            }
            
            $.ajax({
                type: "POST",
                url: "controller.php?action=addColumbarium",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: (response) => {
                    let errors = JSON.parse(JSON.stringify(response.error))
                    let result = JSON.parse(JSON.stringify(response.result))
                    this.errors = errors
                    // result 0 will indicate a true or false for success or failure
                    if(result.length > 0 && result[0]){
                        this.successMessage = "Columbarium was Successfully Added!"
                        this.clearForm();
                        this.fetchBuriedIndividualsList();
                    }
                },
                error: () =>{
                    this.errors = ["Failed to Add Columbarium."]
                }
            });
        },
        clearForm(){
            this.columbariumTypeId = null
            this.nicheTypeId = null
            this.sectionLetterId = null
            this.sectionNumber = null
            this.price = null
            this.forSale = false
            this.purchaseDate = null
            this.ownerId = null
            this.buriedIndividualIds = []
            
            this.$refs.mainImage.value = null;
            this.$refs.attachments.value = null;

            this.refreshSelectPicker();
        },
        fetchColumbariumTypesList(){
            $.getJSON("controller.php",
            {
                action: "fetchColumbariumTypesList"
            },response => {
                let data = JSON.parse(JSON.stringify(response.result))
                this.columbariumTypesList = data
                this.refreshSelectPicker();
            })
        },
        fetchNicheTypesList(){
            $.getJSON("controller.php",
            {
                action: "fetchNicheTypesList"
            },response => {
                let data = JSON.parse(JSON.stringify(response.result))
                this.nicheTypesList = data
                this.refreshSelectPicker();
            })
        },
        fetchOwnersList(){
            $.getJSON("controller.php",
            {
                action: "fetchAllOwnersList"
            },response => {
                let data = JSON.parse(JSON.stringify(response.result))
                this.ownersList = data
                this.refreshSelectPicker();
            })
        },
        fetchSectionLettersList(){
            $.getJSON("controller.php",
            {
                action: "fetchColumbariumSectionLettersList"
            },response => {
                let data = JSON.parse(JSON.stringify(response.result))
                this.sectionLettersList = data
                this.refreshSelectPicker();
            })
        },
        fetchBuriedIndividualsList(){
            $.getJSON("controller.php",
            {
                action: "fetchUnlinkedBuriedIndividualsList"
            },response => {
                let data = JSON.parse(JSON.stringify(response.result))
                this.buriedIndividualsList = data
                this.refreshSelectPicker();
            })
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

function disableForOpen(x){
    if(x.checked){
        //Clear the owner selected data, remove required, and disable it
        document.getElementById("owner-label").classList.remove("required");
        document.getElementById("owner").setAttribute("disabled", true);
        App.$data.ownerId = null;
        $('#owner').selectpicker('val', App.$data.ownerId);
        document.getElementById("buried-individuals").setAttribute("disabled", true);
        App.$data.buriedIndividualIds = [];
        $('#buried-individuals').selectpicker('val', App.$data.buriedIndividualIds);
        // disable purchase date and clear it
        document.getElementById("purchaseDate").setAttribute("disabled", true);
        App.$data.purchaseDate = null;
        
    }
    else{
        document.getElementById("owner-label").classList.add("required");
        document.getElementById("owner").removeAttribute("disabled");
        document.getElementById("buried-individuals").removeAttribute("disabled");
        document.getElementById("purchaseDate").removeAttribute("disabled");
    }
    $('.selectpicker').selectpicker('refresh');
}

$('.selectpicker').selectpicker({
    size: 4
});
$('.associations-popover').popover({
  trigger: 'click'
})
</script>
</body>
</html>
