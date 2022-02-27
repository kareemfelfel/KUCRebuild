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
                                >
                              <option>Columbarium 1</option>
                              <option>Columbarium 2</option>
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
                                >
                              <option>Heart</option>
                              <option>Eye</option>
                              <option>Prayer</option>
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
                                >
                              <option>A</option>
                              <option>B</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required">Section Number</label>
                            <input type="number" class="form-control" id="section-number" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Main Image</label>
                            <div class="input-group">
                                <input class="form-control curved-input" type="file" id="mainImage" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="for-sale-switch">For Sale</label>
                            <div class="custom-control custom-switch inactive-link">
                                <input type="checkbox" class="custom-control-input" onclick="disableForOpen(this)" id="for-sale-switch">
                                <label class="custom-control-label" for="for-sale-switch"></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Purchase Date</label>
                            <input type="date" class="form-control" id="purchaseDate" placeholder="Select a Date">
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
                            multiple
                            data-width="100%"
                            data-max-options="1"
                            >
                          <option>Peter Griffin</option>
                          <option>Stewie Griffin</option>
                          <option>Lewis</option>
                          <option>John Black</option>
                          <option>Jody Strausser</option>
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
                            <input class="form-control curved-input" type="file" id="attached-documents" multiple/>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <button type="button" class="btn btn-success" style="margin-right: 10px;">Submit</button>
    <button type="button" class="btn btn-default">Cancel</button>
    <br><br>
</div>
<link rel="stylesheet" type="text/css" href="../view/columbarium/addColumbarium/addColumbarium.css">
<script type="text/javascript" src="../view/columbarium/addColumbarium/addColumbarium.js"></script>
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<script>
$('.selectpicker').selectpicker({
    size: 4
});
$('.associations-popover').popover({
  trigger: 'click'
})
</script>
</body>
</html>
