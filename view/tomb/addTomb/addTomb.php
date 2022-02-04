<?php

/* 
 * This is a Private page only accessible by an admin account
 * 
 * This page should have an open map where the admin can add:
 *  1. Plot Info
    2. Dead Individual Info:
    3. Owner Info: (will be on a separate page)
    4. Plot (map):
    5. Attachments
 * 
 * - NOTE: We can combine attached images and deed into one table of attachments
 * keep main image separate
 * 
 * Refer to the components inside edit Tomb. This should be fairly similar
 */
?>
<br><br>
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
            </a> Tomb Information
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in show">
          <div class="panel-body">
              <form>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Section Letter</label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Lot Number</label>
                            <input type="number" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Plot Number</label>
                            <input type="number" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Purchase Date</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepicker" placeholder="Select a Date">
                                <div class="input-group-append">
                                    <span class=" input-group-text fa fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Owner</label> <br>
                            <select class="selectpicker" data-live-search="true">
                              <option>Adam Smith</option>
                              <option>John Black</option>
                              <option>Jody Strausser</option>
                            </select>
                        </div>
                    </div>
                    <!-- TODO add upload image -->
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="customSwitch1">Open</label>
                            <div class="custom-control custom-switch inactive-link">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </div>
                    </div>
                </div>
              </form>
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
            </a> Buried Individual Information
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse in show">
          <div class="panel-body">
              <form>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Maiden Name</label>
                            <input type="text" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                </div>
              </form>
          </div>
        </div>
      </div>         
    </div>
</div>
<style>
.inactive-link {
   cursor: default;
}
</style>
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<script>
    $('.selectpicker').selectpicker({
      style: 'btn-default',
      size: 4
    });
    // setting up date picker
    $(document).ready(function () {
        $('#datepicker').datepicker({
            format: 'mm-dd-yyyy',
            todayHighlight: true
        });
    });
    
    function changeIcon(x){
        if(x.classList.contains("fa-caret-down")){
            x.classList.add("fa-caret-right");
            x.classList.remove("fa-caret-down");
        }
        else if(x.classList.contains("fa-caret-right")){
            x.classList.add("fa-caret-down");
            x.classList.remove("fa-caret-right");
        }
    }
</script>

</body>
</html>
