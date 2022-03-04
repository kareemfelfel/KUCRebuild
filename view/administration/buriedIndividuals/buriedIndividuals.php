<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

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
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Text fields for buried individuals names. -->
                            <label class="required" for="fName" class="required">First Name:</label>
                                <input type="text" class="form-control" id="fName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="middleName">Middle Name:</label>
                                <input type="text" class="form-control" id="middleName">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required" for="lName" class="required">Last Name:</label>
                                <input type="text" class="form-control" id="lname" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="maidenName">Maiden Name:</label>
                            <input type="text" class="form-control" id="maidenName">
                        </div>
                    </div>
                </div><br>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOB section -->
                        <label class="required" for="dob">Date of Birth:</label><br>
                            <input type="date" class="form-control" id="dob">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <!-- DOD section -->
                        <label class="required" for="dod">Date of Death:</label><br>
                            <input type="date" class="form-control" id="dod">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- Veteran status section. -->
                            <label>Veteran Status: </label>
                            <div class="custom-control custom-switch inactive-link">
                                <input type="checkbox" class="custom-control-input" id="open-switch">
                                <label class="custom-control-label" for="open-switch"></label>
                            </div>
                        </div>
                    </div>
                </div><br> <!-- end of row -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="obituary">Obituary: </label><br>
                            <textarea id="obituary" class="form-control" rows="8" cols="30"></textarea>
                        </div>
                    </div>
                <!-- End of row -->
                </div><br>
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
            <div class="panel-body">
                <div class ="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label for="">Select a Buried Individual</label> <br>
                              <div style="float: left; width: 80%">
                                  <select 
                                      class="selectpicker"
                                      id="buried-individuals"
                                      data-live-search="true"
                                      multiple
                                      data-max-options="1"
                                      data-width="100%"
                                      >
                                    <option>Kareem Felfel</option>
                                    <option>Assembly Language</option>
                                    <option>Am I dead?</option>
                                    <option>What is this place!</option>
                                    <option>Hello World</option>
                                    <option>Peter Griffin</option>
                                    <option>Stewie Griffin</option>
                                    <option>Lewis</option>
                                    <option>John Black</option>
                                    <option>Jody Strausser</option>
                                  </select>
                              </div>
                                  <div class="input-group-append">
                                  <btn onclick="window.location.href='controller.php?action=directToEditBuriedIndividualPage'"
                                      type="button" 
                                      class="btn btn-success" 
                                      style="border-radius: 0px 5px 5px 0px"><span class="fa fa-edit"></span></btn>
                                  </div>
                          </div>
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
<link type="text/css" rel="stylesheet" href="../view/administration/buriedIndividuals/buriedIndividuals.css">
<script>
    $('.selectpicker').selectpicker({
      size: 4
    });
</script>
</body>
</html>
