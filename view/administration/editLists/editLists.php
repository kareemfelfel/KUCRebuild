<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<script type="text/javascript" src="../view/administration/editLists/editLists.js"></script>

<br>
<h3 class="text-center">Edit Lists</h3>
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
                class="fa fa-caret-down inactive-link"
                onclick="changeIcon(this)"
                >
            </a> Add Columbarium Name
          </h4>
        </div>
      <div id="collapse1" class="panel-collapse collapse in show">
        <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Columbarium Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="columbariumName" placeholder="">
                                <div class="input-group-append">
                                   <div class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence"
                                data-live-search="true"
                                multiple
                                data-max-options="1"
                                data-width="100%"
                                >
                              <option>Columbarium 1</option>
                              <option>Columbarium 2</option>
                            </select>
                        </div>
                    </div>
            </div>
        </div>
      </div>
     </div>
    </div>
    
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
                </a> Add Columbarium Section Letter
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show"> 
          <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">   
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Section Letter</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sectionLetter" placeholder="">
                                <div class="input-group-append">
                                   <div class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence2"
                                data-live-search="true"
                                multiple
                                data-max-options="1"
                                data-width="100%"
                                >
                              <option>A</option>
                              <option>B</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>  
        </div>
      </div>
           
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
                </a> Add Columbarium Niche Name
            </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse in show"> 
          <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">   
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Niche Name</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nicheName" placeholder="">
                                <div class="input-group-append">
                                   <div class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence3"
                                data-live-search="true"
                                multiple
                                data-max-options="1"
                                data-width="100%"
                                >
                              <option>Eye</option>
                              <option>Heart</option>
                              <option>Prayer</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>  
        </div>
      </div>
                
                <!-- Fourth panel -->
      <div class="panel panel-default" id="accordion4">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a 
                    data-toggle="collapse" 
                    data-parent="#accordion4" 
                    href="#collapse4" 
                    class="fa fa-caret-down inactive-link"
                    onclick="changeIcon(this)"
                    >
                </a> Add Tomb Section Letter
            </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse in show"> 
          <div class="panel-body">
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">   
                            <!-- attaches plus icon with btn function to textbox -->
                            <label for="">Tomb Letter</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tombLetter" placeholder="">
                                <div class="input-group-append">
                                   <button class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                   </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Select list, only one can be selected at once -->
                            <label for="">Check for Existence</label> <br>
                            <select 
                                class="selectpicker"
                                id="checkForExistence4"
                                data-live-search="true"
                                multiple
                                data-max-options="1"
                                data-width="100%"
                                >
                              <option>A</option>
                              <option>B</option>
                              <option>C</option>
                              <option>D</option>
                              <option>YC</option>
                              <option>YB</option>
                              <option>XC</option>
                              <option>XB</option>
                              <option>XD</option>
                              <option>XA</option>
                            </select>
                        </div>
                    </div>
            </div>
          </div>  
        </div>
      </div>
</div>
<br><br>
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<link type="text/css" rel="stylesheet" href="../view/administration/editLists/editLists.css">
<script>
    $('.selectpicker').selectpicker({
      size: 4
    });
</script>
</body>
</html>
