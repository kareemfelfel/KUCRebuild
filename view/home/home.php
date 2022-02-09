<?php

/* 
 * This page has public access
 * 
 * the home page should include information about KUC with images (carousel)
 * 
 * the information here is all hard-coded. This page should not ask for access
 * to any function in the controller.
 * 
 */
?>
<style>
.carousel-container{
    margin: auto;
    width: 90%;
    height: 60%;
    border-radius: 10px;
}
.img{
    width: 90%;
    height: 60%;
    border-radius: 10px;
}
</style>
<br>
<h3 class="text-center">Knox Union Cemetery</h3>
<hr>
<div class="container"> 
    <div class="carousel-container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="img d-block w-100" src="../assets/images/Knox_Front_Sign_New.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="img d-block w-100" src="../assets/images/Knox_Head_Stones.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="img d-block w-100" src="../assets/images/Knox_Mausoleum.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
              <img class="img d-block w-100" src="../assets/images/Knox_Wide_View.jpg" alt="Fourth slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>
    <br>
    <h4>Our History</h4>
    <hr>
    <p style="font-size: 20px;">
        The Knox Union Cemetery, formerly known as Edenburg Cemetery,
            was established in 1885 by the G.A.R. (Grand Army of the Republic) citizens of Edenburg.
            Peter Spargo, the post master of Eden, was also anxious to secure a site for the
            cemetery for he was the 1st person buried in this cemetery (Section D, lot 7). The
            original board was made up of five directors of G.A.R. and four local citizens. They
            purchased 7 acres of land on the north-west corner of the then Mendenhall Farm. The ground
            was dedicated May 30th 1885.
    </p>
    <br><br>
</div>
