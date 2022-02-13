<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript" src="../view/administration/owners/owners.js"></script>

<br>
<h3 class="text-center">Owners</h3>
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
                </a> Add Owner
              </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse in show">
              <div class="panel-body">
                  <form>
                    <div class ="row">
                        <div class="col-md-3">
                            <div class="form-group">

                                <!-- Text fields for buried individuals names. -->
                                <label for="fName">First Name:</label>
                                    <input type="text" class="form-control" id="fName"><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middleName">Middle Name:</label>
                                    <input type="text" class="form-control" id="middleName"><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="lName">Last Name:</label>
                                    <input type="text" class="form-control" id="lname"><br>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                                <input type="text" class="form-control" id="phoneNumber"><br>
                            </div>
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-md-3">
                            <div class="form-group">
                            <!-- DOD section -->
                            <label for="address">Address:</label>
                                <textarea id="address" class="form-control" rows="4" cols="30"></textarea><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                            <!-- DOB section -->
                            <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email"><br>
                            </div>
                        </div>
                    </div> 
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                            <button type="button" class="btn btn-success bottom-form-button">Submit</button>
                            <button type="button" class="btn btn-default bottom-form-button">Cancel</button>
                                </div>
                            </div>
                        </div>
                  </form>
              </div> 
            <!-- end of panel -->
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
                    </a> Edit Owner
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse in show"> 
                <div class="panel-body">
                    <form>
                        <div class ="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">Select an Owner</label> <br>
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
                                          <btn 
                                              type="button" 
                                              class="btn btn-success" 
                                              style="border-radius: 0px 5px 5px 0px"><span class="fa fa-edit"></span></btn>
                                          </div>
                                  </div>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>                
    </div>
</div>
<br><br>
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<link type="text/css" rel="stylesheet" href="../view/administration/owners/owners.css">
<script>
    $('.selectpicker').selectpicker({
      size: 4
    });
</script>
</body>
</html>

