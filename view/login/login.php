<?php

/* 
 * This page has public access
 * 
 * Simple log-in form with AJAX to confirm the user identity.
 * Once Identity is confirmed, direct the user to the search page.
 */
?>
<br>
<div class="wrapper-div"> 
    <h4 class="text-center title">Login</h4>
    <hr class="hr">
    <form>
        <div class="row">
            <div class="col-md-12">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="userName"><br>
            </div>
        </div><!-- end of row -->

        <div class="row">
            <div class="col-md-12">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password"><br> <!-- using password type -->
            </div>
        </div> <!-- end of row -->

        <div class="row">
            <div class="btns-wrapper">
                <button type="button" class="btn btn-success bottom-form-button">Login</button>
            </div>
        </div> <!-- end of row -->
    </form>
</div>
<link rel="stylesheet" href="../view/login/login.css">
</body>
</html>
