<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Edit Contacts</h3>
<hr>

<div class="container-fluid">
    <div class="panel-group">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Contact</h4>
        </div>
        <div class="panel-body">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group"> 
                            <!-- Text fields for editing contacts. -->
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
                    <button type="button" class="btn btn-success bottom-form-button">Edit</button>
                </div>
            </form>
        </div>
     </div>
    </div>
</div>

<link rel="stylesheet" href="../view/administration/contacts/contacts.css">



