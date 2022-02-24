<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Contacts</h3>
<hr>

<!-- For collapsible panels -->
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
            </a> Add Contact
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in show">
          <div class="panel-body">
              <!-- First Row -->
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <!-- Text fields for adding contacts. -->
                            <label class="required" for="fName">First Name:</label>
                                <input type="text" class="form-control" id="fName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label class="required" for="lName">Last Name:</label>
                                <input type="text" class="form-control" id="lName" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label class="required" for="aEmail">Email:</label>
                                <input type="text" class="form-control" id="aEmail" required>
                        </div>
                    </div>
                </div>
              
                              <!-- Second Row -->
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label for="pTitle">Position Title:</label>
                                <input type="text" class="form-control" id="pTitle">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <label class="required" for="pNumber">Phone Number</label>
                                <input type="text" class="form-control" id="pNumber" required>
                        </div>
                    </div>
                </div>
                <!-- next row -->
                <div class="row">
                    <button type="button" class="btn btn-success bottom-form-button">Submit</button>
                    <button type="button" class="btn btn-default bottom-form-button">Cancel</button>
                </div>
          </div>
        </div>
      </div><br>
        <!-- second panel -->
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
                </a> Edit Contact
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show"> 
            <div class="panel-body">
                  <!-- new row -->
                  <div class ="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Select Contact</label> <br>
                                <div style="float: left; width: 80%">
                                    <!-- for single select list -->
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
            </div>
        </div>
      </div>
    </div>
    <br><br>
</div>

<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<link rel="stylesheet" href="../view/administration/contacts/contacts.css">
<script type="text/javascript" src="../view/administration/contacts/contacts.js"></script>

<script>
    $('.selectpicker').selectpicker({
      size: 4
    });
</script>
</body>
</html>

