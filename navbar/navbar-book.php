<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
                <a class="navbar-brand mx-5" href="index.php">
                    <img src="images/logo3.png" style="height: 90px; margin-right: 1em;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
            
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                                Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li>
                                    <a class="dropdown-item" href="services_men.php">For Men</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="services_women.php">For Women</a>
                                </li>
                            </ul>
                        </li>
    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                                Book
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li>
                                    <a class="dropdown-item" href="check_schedule.php">Book Appointment</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="view_appointment.php">View Appointment</a>
                                </li>
                            </ul>
                        </li>
            
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="food.php">Food</a>
                        </li>
            
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="about_us.php">About Us</a>
                        </li>
    
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-link">
                            <?php
                            if(isset($_SESSION['email'])){
                                echo   '<li class="nav-item mx-3 my-3">
                                            <a href="logout.php" class="btn btn-danger me-3">Logout</a>
                                        </li>';
                            } else {
                                echo   '<a class="nav-link d-lg-none" href="login.php">
                                            Log-In
                                        </a>
                                        <a class="nav-link d-none d-lg-block me-5" href="login.php">
                                            <img src="images/user.png" style="height:40px;" alt="">
                                        </a>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>  
        </nav>

        <style>
        @media all and (min-width: 992px) {
    .navbar .nav-item:hover .nav-link{ color: #FFF;;  }       
	.navbar .dropdown-menu.fade-down{ top:80%; transform: rotateX(-75deg); transform-origin: 0% 0%;}
	.navbar .dropdown-menu.fade-up{ top:180%;  }
	.navbar .nav-item:hover .dropdown-menu{ transition: .3s; opacity:1; visibility:visible; top:100%; transform: rotateX(0deg); color: #d48b33; }
    *,*:before,*:after{
        padding:0;
        margin: 0;
    }

    .navbar .nav-item:after{
        content:"";
        position: absolute;
        background-color: white;
        height: 3px;
        width: 0;
        left:0;
        bottom: -10;
        transition: .5s;
    }
  
    .navbar .nav-item:hover:after{
        width:100%;
    }  
}	
</style>