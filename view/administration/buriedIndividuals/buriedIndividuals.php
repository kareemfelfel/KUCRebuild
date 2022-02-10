<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<link type="text/css" rel="stylesheet" href="../view/administration/buriedIndividuals/buriedIndividuals.css">
<script type="text/javascript" src="../view/administration/buriedIndividuals/buriedIndividuals.js"></script>
<br>
<h3 class="text-center">Buried Individuals</h3>
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
            </a> Add Buried Individual
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in show">
          <div class="panel-body">
              <form>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">

                            <!-- Text fields for buried individuals names. -->
                            <label class="required" for="fName">First Name:</label>
                                <input type="text" class="form-control" id="fName" required><br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="lName">Last Name:</label>
                                <input type="text" class="form-control" id="lname" required><br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="middleName">Middle Name:</label>
                                <input type="text" class="form-control" id="middleName" required><br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label class="required" for="maidenName">Maiden Name:</label>
                            <input type="text" class="form-control" id="maidenName" required><br>
                        </div>
                    </div>
                </div>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOB section -->
                        <label class="required" for="dob">Date of Birth:</label><br>
                            <input type="date" class="form-control" id="dob" required><br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOD section -->
                        <label class="required" for="dod">Date of Death:</label><br>
                            <input type="date" class="form-control" id="dod" required><br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Veteran status section. -->
                            <label for "">Veteran Status: </label>
                            <div class="custom-control custom-switch inactive-link">
                                <input type="checkbox" class="custom-control-input" id="open-switch">
                                <label class="custom-control-label" for="open-switch"></label>
                            </div>
                        </div>
                    </div>
                </div> <!-- end of row -->
                <div class="row">
                    <div class="panel col-md-3">
                        <div class="form-group">
                            <label for="obituary">Obituary: </label><br>
                            <textarea id="obituary" class="form-control" rows="8" cols="30"></textarea>
                        </div>
                    </div>
                <!-- End of row -->
                </div>
                <div class="row">
                    <button type="button" class="btn btn-success bottom-form-button">Submit</button>
                    <button type="button" class="btn btn-default bottom-form-button">Cancel</button>
                </div>
            </div> 
      </div> 
    <!-- end of panel -->
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
                </a> Edit Buried Individual
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show"> 
                        
        </div>
      </div>                
    </div>
</div>
 
 <!-- CSS Commands -->
 


</body>
</html>
