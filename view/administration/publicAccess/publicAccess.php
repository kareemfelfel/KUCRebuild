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
<div class="container-fluid">
    <p> This page is used to restrict Guests to certain modules.
        The modules listed below are the <b>only</b> modules that a guest can have access to.
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
                        <label>Home Page</label>
                        <div class="custom-control custom-switch inactive-link">
                            <input type="checkbox" class="custom-control-input" id="open-switch-1">
                            <label class="custom-control-label" for="open-switch-1"></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"> 
                        <!-- Text fields for editing contacts. -->
                        <label>Contact Us Page</label>
                        <div class="custom-control custom-switch inactive-link">
                            <input type="checkbox" class="custom-control-input" id="open-switch-2">
                            <label class="custom-control-label" for="open-switch-2"></label>
                        </div>
                    </div>
                </div>
            </div>
            
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
                                  Guests will ONLY be able to see information about the buried individuals and if a lot is for sale, the price will be shown as well as the location of the lot.">
                            </span>
                        </label>
                        <div class="custom-control custom-switch inactive-link">
                            <input type="checkbox" class="custom-control-input" id="open-switch-3">
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
                                  Guests will ONLY be able to see information about the buried individuals and if a Columbarium is for sale, the price will be shown as well as the location.">
                            </span>
                        </label>
                        
                        <div class="custom-control custom-switch inactive-link">
                            <input type="checkbox" class="custom-control-input" id="open-switch-4">
                            <label class="custom-control-label" for="open-switch-4"></label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <button type="button" class="btn btn-success bottom-form-button">Apply</button>
            </div>
        </div>
    </div>

</div>
<style>
.inactive-link {
   cursor: default;
}
.bottom-form-button {
    margin-left: 15px;
}
</style>
<script>
$("[data-toggle='popover']").popover({
    trigger: 'click'
})
</script>