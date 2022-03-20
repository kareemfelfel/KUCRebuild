<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Edit Buried Individual</h3>
<hr>

<div id="editBuriedIndividualApp" class="container-fluid">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Buried Individual</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group"> 
                        <!-- Text fields for editing contacts. -->
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
                        <label for="nickname">Nickname:</label>
                            <input type="text" class="form-control" id="nickname">
                        </div>
                    </div>
                </div><br>
                <div class ="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="maidenName">Maiden Name:</label>
                            <input type="text" class="form-control" id="maidenName">
                        </div>
                    </div>
                    
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
                    <button type="button" class="btn btn-success bottom-form-button">Edit</button>
                </div>
        </div>
     </div>
</div>

<link rel="stylesheet" href="../view/administration/buriedIndividuals/editBuriedIndividual/editBuriedIndividual.css">
<script>
    new Vue({
        el: "#editBuriedIndividualApp",
        data: {
            id: null,
            buriedIndividual: {
                firstName: null,
                middleName: null,
                lastName: null,
                nickname: null,
                maidenName: null,
                dob: null,
                dod: null,
                veteran: false,
                obituary: null
            },
            
            errors: [],
            successMessage: null
        },
        created(){
            this.getId();
            this.getBuriedIndividual();
        },
        methods: {
            getId(){
                let uri = window.location.href.split('?');
                if(uri.length == 2) {
                  let vars = uri[1].split('&');
                  let getVars = {};
                  let tmp = '';
                  vars.forEach(function(v) {
                    tmp = v.split('=');
                    if(tmp.length == 2)
                      getVars[tmp[0]] = tmp[1];
                  });
                  this.id = getVars['id'];
                }
            },
            getBuriedIndividual(){
                
            }
        }
    })
</script>
