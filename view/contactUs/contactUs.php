<?php

/* 
 * This page has public access
 * 
 * the Contact Us page should not need to contact the controler at all.
 * Only Front-End hard-coded information will be provided here.
 */
?>
<br>
<div class="container">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="col-md-3">
                <div class="contact-box center-version">
                    <a href="#profile.html">
                        <img alt="image" class="img-circle" src="../assets/images/contactImage.png">
                        <h3 class="m-b-xs"><strong>Name</strong></h3>

                        <div class="font-bold">Position</div>
                        
                        <div class="contact-box-footer">
                            <div class="contact_btns">
                                <a class="btn-link" href="tel:555-555-5555"><i class="fa fa-phone"></i> 555-555-5555 </a> <br>
                                <br><!-- THIS IS PURELY TO MAKE IT EASIER TO CLICK FOR MOBILE. BY SEPARATING THEM IT IS HARDER TO CLICK THE WRONG ONE. -->                                
                                <a class="btn-link" href="mailto:someone@yoursite.com"><i class="fa fa-envelope"></i> someone@yoursite.com</a>                        
                            </div> <!-- m-t-xs btn group -->
                        </div> <!-- contact-box-footer -->
                </div>
            </div>     
    
            <div class="col-md-3">
                <div class="contact-box center-version">
                    <a href="#profile.html">
                        <img alt="image" class="img-circle" src="../assets/images/contactImage.png">
                        <h3 class="m-b-xs"><strong>Name</strong></h3>

                        <div class="font-bold">Position</div>
                        
                        <div class="contact-box-footer">
                            <div class="contact_btns">
                                <a class="btn-link" href="tel:555-555-5555"><i class="fa fa-phone"></i> 555-555-5555 </a> <br>
                                <br><!-- THIS IS PURELY TO MAKE IT EASIER TO CLICK FOR MOBILE. BY SEPARATING THEM IT IS HARDER TO CLICK THE WRONG ONE. -->                                
                                <a class="btn-link" href="mailto:someone@yoursite.com"><i class="fa fa-envelope"></i> someone@yoursite.com</a>                        
                            </div> <!-- m-t-xs btn group -->
                        </div> <!-- contact-box-footer -->
                </div>
            </div>                   
            
    </div><!-- class container -->
<style>
    body{margin-top:20px;
        background:#eee;
    }
    .btn-link{
        word-wrap: break-word;
        color: black;
        padding-bottom: 20px;
    }
    .container{
        display: flex;
        justify-content: center;
    }

    /* CONTACTS */
    .contact-box {
        background-color: #ffffff;
        border: 1px solid #e7eaec;
        padding: 20px;
        margin-bottom: 20px;
    }
    .contact-box > a {
        color: inherit;
    }
    .contact-box.center-version {
        border: 1px solid #e7eaec;
        padding: 0;
    }
    .contact-box.center-version > a {
        display: block;
        background-color: #ffffff;
        padding: 20px;
        text-align: center;
    }
    .contact-box.center-version > a img {
        width: 80px;
        height: 80px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .contact-box.center-version address {
        margin-bottom: 0;
    }
    .contact-box .contact-box-footer {
        text-align: center;
        background-color: #ffffff;
        border-top: 1px solid #e7eaec;
        padding: 15px 20px;
    } 
    .contact-btns{
        display: flex;
        justify-content: center;                
    }
    
    a{
        text-decoration:none !important;    
    }
    .link-center{
        text-align: center;
    }
</style>