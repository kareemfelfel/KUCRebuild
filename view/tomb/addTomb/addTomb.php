<?php

/* 
 * This is a Private page only accessible by an admin account
 * 
 * This page should have an open map where the admin can add:
 *  1. Plot Info
    2. Associations
    4. Plot (map):
    5. Attachments
 * 
 * - NOTE: We can combine attached images and deed into one table of attachments
 * keep main image separate
 * 
 * 
 */
?>
<br>
<h3 class="text-center">Add Lot</h3>
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
            </a> Lot Information
          </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse in show">
            <div class="panel-body">
                <div class ="row">
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="required">Lot Number</label>
                            <input type="number" class="form-control" id="lot-number" placeholder="">
                        </div>
                    </div>
                   
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" class="form-control" id="" placeholder="">
                        </div>
                    </div>
                                        
                </div><br>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="for-sale-switch">For Sale</label>
                                <div class="custom-control custom-switch inactive-link">
                                    <input type="checkbox" class="custom-control-input" onclick="disableForOpen(this)" id="for-sale-switch">
                                    <label class="custom-control-label" for="for-sale-switch"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="open-plots-switch">Has Open Plots</label>
                                <div class="custom-control custom-switch inactive-link">
                                    <input type="checkbox" class="custom-control-input" id="open-plots-switch">
                                    <label class="custom-control-label" for="open-plots-switch"></label>
                                </div>
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
            <span class="fa fa-info-circle associations-popover" style="color: #3498db" data-container="body" data-toggle="popover" data-placement="top" data-content="Associations can be added only when a Lot is not for sale.">
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
      <br>
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
                class="required"
                >
            </a> Map 
          </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse in show">
          <div class="panel-body map-panel">
            <div id="googleMap" class="map">
                <!-- GMAP API -->
            </div>
            <br>
            <div class="text-center">
                <button type="button" class="btn btn-danger" onclick="deleteMarker()">Delete Marker</button>
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
<link rel="stylesheet" type="text/css" href="../view/tomb/addTomb/addTomb.css">
<!-- Used for select picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" defer></script>
<!-- GMAP Async script executes immediately and must be after any DOM elements used in callback. -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXbb-v0RvEbY5PYpp1HsPgRxDjVH8oAsM&callback=myMap&v=weekly" async></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script>
    var marker;
    var map;
    var infowindow;
    var openMarkerIcon = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
    // marker.getPosition().lat();
    // marker.getPosition().lng();
    function myMap() {
        const cemetery = { lat: 41.239094, lng: -79.542186 };
        var mapProp= {
          center:new google.maps.LatLng(cemetery.lat, cemetery.lng),
          zoom:18,
          mapTypeId: 'satellite'
        };
        map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        map.addListener('click', function(e) {
            placeMarker(e.latLng, map);
        });
    }
    function openInfo(){
        var plotLabel = document.getElementById("section-letter").value + " " + document.getElementById("lot-number").value;
        if(infowindow){
            infowindow.setContent(plotLabel !== " " ? plotLabel :null)
        }
        else{
            infowindow = new google.maps.InfoWindow({
                content: plotLabel !== " " ? plotLabel :null
            });
        }
        infowindow.open(map, marker);
    }
    function placeMarker(location) {
        if ( marker ) {
          marker.setPosition(location);
        } else {
          marker = new google.maps.Marker({
            position: location,
            draggable:true,
            map: map
          });
        }
        marker.addListener('click', function() {
            openInfo();
        });
        
        if(document.getElementById("for-sale-switch").checked){
            changeToBlueMarkerColor(true);
        }
    }
    function deleteMarker(){
        marker.setMap(null);
        marker = null;
    }
    
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
    
    function disableForOpen(x){
        if(x.checked){
            //Clear the owner selected data, make it not required, and disable it
            document.getElementById("owner-label").classList.remove("required");
            document.getElementById("owner").setAttribute("disabled", true)
            $('#owner').selectpicker('val', '');
            document.getElementById("buried-individuals").setAttribute("disabled", true)
            $('#buried-individuals').selectpicker('val', '');
            // disable purchase date and clear it
            document.getElementById("purchaseDate").setAttribute("disabled", true);
            document.getElementById("purchaseDate").value = '';
            
            //if marker exists, change the icon to an open icon
            changeToBlueMarkerColor(true);
            
            
        }
        else{
            document.getElementById("owner-label").classList.add("required");
            document.getElementById("owner").removeAttribute("disabled")
            document.getElementById("buried-individuals").removeAttribute("disabled")
            document.getElementById("purchaseDate").removeAttribute("disabled")
            changeToBlueMarkerColor(false);
        }
    }
    function changeToBlueMarkerColor(val){
        if(marker){
            if(val){
                marker.setIcon(openMarkerIcon);
            }
            else{
                marker.setIcon(null); //default icon
            }
        }
    }
    
    $('.selectpicker').selectpicker({
      size: 4
    });
    
    $('.associations-popover').popover({
      trigger: 'click'
    });
</script>

</body>
</html>
