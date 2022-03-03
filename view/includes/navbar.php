
<nav class="navbar navbar-expand-lg navbar-toggleable-md navbar-dark" style="background-color: #800080">
    
    
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="text-white d-none d-xl-inline text-white" id="logo">
        <img alt="KUC-logo" src="../Assets/Images/Knox_Front_Sign_Logo.png" id="Icon" style="float: left">
         &nbsp;Knox Union Cemetery
    </div>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
            <a class="nav-item nav-link <?php if(isset($homeActive) && $homeActive){echo 'active';} ?>" href="controller.php?action=directToHomePage">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link <?php if(isset($contactUsActive) && $contactUsActive){echo 'active';} ?>" href="controller.php?action=directToContactUsPage">Contact Us</a>
            <!-- Administration Page ACCESSIBLE BY ADMIN ONLY -->
            <a class="nav-item nav-link <?php if(isset($administrationActive) && $administrationActive){echo 'active';} ?>" href="controller.php?action=directToAdministrationPage">Administration</a>
            <!-- drop down Search menu ACCESSIBLE BY ADMIN ONLY -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Search</a>
                <ul class="dropdown-menu">
                    <li class="dropdown-item">
                        <a href="controller.php?action=directToSearchColumbariumPage"><span class="fa-solid fa-warehouse"></span> Columbarium</a>
                    </li>
                    <li class="dropdown-item">
                        <a href="controller.php?action=directToSearchTombPage"><span class="fa-solid fa-cross"></span> Lot</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    
    
    <div class="navbar-right">
        <!-- drop down menu-->
        <div class="nav-item dropdown">
            <a class="nav-link text-light display-5 dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-fw fa-user"></i>
                Admin</a>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <a href="controller.php?action=directToLoginPage"><span class="glyphicon glyphicon-log-in"></span> Log in</a>
                   
                </li>
            </ul>

        </div>
    </div>
    

</nav>
<style>
    #Icon{
        width: 55px;
        height: 30px;
    }
    #logo{
        width: 300px;
    }
</style>