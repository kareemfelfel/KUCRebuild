
<nav class="navbar navbar-expand-lg navbar-toggleable-md navbar-dark" style="background-color: slategray">
    
    
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
            <?php
                if($_SESSION['user']->userType == UserType::ADMIN){
                    echo "<a class='nav-item nav-link ";
                    if(isset($administrationActive) && $administrationActive){
                        echo "active";
                    }
                    echo "'";
                    echo ' href="controller.php?action=directToAdministrationPage">Administration</a>';
                }
            ?>
            
            <!-- drop down Search menu ACCESSIBLE BY ADMIN ONLY -->
            <?php
            $userType = $_SESSION['user']->userType;
            $hasAccessToSearchLot = in_array(Module::LOT_SEARCH, $_SESSION['user']->accessibleModules);
            $hasAccessToSearchColumbarium = in_array(Module::COLUMBARIUM_SEARCH, $_SESSION['user']->accessibleModules);
            if($userType == UserType::ADMIN){
                echo '<div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Search</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item">
                                <a href="controller.php?action=directToSearchColumbariumPage"><span class="fa-solid fa-warehouse"></span> Columbarium</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="controller.php?action=directToSearchTombPage"><span class="fa-solid fa-cross"></span> Lot</a>
                            </li>
                        </ul>

                    </div>';
            }
            else if($userType == UserType::GUEST && ($hasAccessToSearchColumbarium || $hasAccessToSearchLot)){
                echo '<div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Search</a>
                <ul class="dropdown-menu">';
                if($hasAccessToSearchColumbarium){
                    echo '<li class="dropdown-item">
                            <a href="controller.php?action=directToSearchColumbariumPage"><span class="fa-solid fa-warehouse"></span> Columbarium</a>
                        </li>';
                }
                if($hasAccessToSearchLot){
                    echo '<li class="dropdown-item">
                            <a href="controller.php?action=directToSearchTombPage"><span class="fa-solid fa-cross"></span> Lot</a>
                        </li>';
                }
                echo '</ul></div>';
            }
            ?>
        </div>
    </div>
    
    
    <div class="navbar-right">
        <!-- drop down menu-->
        <div class="nav-item dropdown">
            <a class="nav-link text-light display-5 dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-fw fa-user"></i>
                <?php
                if(isset($_SESSION['user']->admin)){
                    echo '<span id="navbar-admin-name">';
                    echo $_SESSION['user']->admin->firstName;
                    echo '</span>';
                }
                else{
                    echo "Options";
                }
                ?>
            </a>
            <ul class="dropdown-menu">
                <?php
                if($_SESSION['user']->userType == UserType::GUEST){
                    echo '<li class="dropdown-item">
                            <a href="controller.php?action=directToLoginPage"><span class="glyphicon glyphicon-log-in"></span> Log in</a>    
                        </li>';
                }
                else{
                    echo '<li class="dropdown-item">
                            <a href="controller.php?action=logout"><span class="glyphicon glyphicon-log-out"></span> Log out</a>    
                        </li>';
                }
                ?>
                <?php
                if($_SESSION['user']->userType == UserType::ADMIN){
                    echo '<li class="dropdown-item">
                            <a href="controller.php?action=directToEditAccountPage"><span class="fa fa-edit"></span> Edit Account</a>    
                        </li>';
                    echo '<li class="dropdown-item">
                            <a href="controller.php?action=directToViewAdminsPage"><span class="fa fa-list"></span> Admins List</a>    
                        </li>';
                    echo '<li class="dropdown-item">
                            <a href="controller.php?action=directToPublicAccessPage"><span class="fa fa-lock"></span> Public Access</a>    
                        </li>';
                    echo '<li class="dropdown-item">
                            <a href="../assets/user_manual.pdf" download><span class="fa fa-file-text"></span> User Manual</a>    
                        </li>';
                }
                ?>
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