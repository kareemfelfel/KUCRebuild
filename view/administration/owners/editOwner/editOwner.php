<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>

<br>
<h3 class="text-center">Edit Owner</h3>
<hr>

<div class="container-fluid">
     <div class="panel panel-default" id="accordion1">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Owner</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group"> 
                        <!-- Text fields for editing buried individuals info. -->
                        <label for="fName" class="required">First Name:</label>
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
                        <label for="lName" class="required">Last Name:</label>
                            <input type="text" class="form-control" id="lname" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber">
                    </div>
                </div>
            </div>
            <!-- second row -->
            <div class ="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <!-- DOD section -->
                    <label for="address">Address:</label>
                        <textarea id="address" class="form-control" rows="4" cols="30"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <!-- DOB section -->
                    <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn btn-success bottom-form-button">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="../view/administration/owners/editOwner/editOwner.css">