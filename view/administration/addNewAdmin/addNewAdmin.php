<?php

/* 
 * 
 */

?>

<br>
<div class="wrapper-div"> 
    <h4 class="text-center title">Add New Admin</h4>
    <hr class="hr">
    <form>
        <div class="row">
            <div class="col-md-6">
                <label for="userName">Username:</label>
                <input type="text" class="form-control" id="userName"><br>
            </div>
            <div class="col-md-6">
                <label for="firstName">First Name:</label>
                <input type="text" class="form-control" id="firstName"><br>
            </div>
        </div><!-- end of row -->

        <div class="row">
            <div class="col-md-6">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastName"><br>
            </div>
            <div class="col-md-6">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password"><br> <!-- using password type -->
            </div>
        </div> <!-- end of row -->

        <div class="row">
            <div class="btns-wrapper">
                <button type="button" class="btn btn-success bottom-form-button">Submit</button>
                <button type="button" class="btn btn-default bottom-form-button">Cancel</button>
            </div>
        </div> <!-- end of row -->
    </form>
</div>
<link rel="stylesheet" href="../view/administration/addNewAdmin/addNewAdmin.css">
</body>
</html>


