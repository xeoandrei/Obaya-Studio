<!DOCTYPE html>
<?php
    require "config.php";
    require "controllerUserData.php";
    //require "controllerUserData.php";
    if(isset($_SESSION['email']) AND ($_SESSION['usertype'] == 'ADMINISTRATOR')){
        echo 'Good day! ' . $_SESSION['email'] . ' <a href="management.php">Admin Panel</a>';
    } elseif(isset($_SESSION['email']) AND ($_SESSION['usertype'] == 'STAFF')) {
        echo 'Good day! ' . $_SESSION['email'] . ' <a href="management.php">Staff Panel</a>';
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/e54d8b55e8.js" crossorigin="anonymous"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Ubuntu&display=swap"
    rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">

    <title>Obaya Studio | Home</title>
</head>
<body>
       
    <section id="firstPage" class="container-fluid"> 
        <?php include "navbar/navbar-index.php"; ?>

        <div class="row marginTop">
            <div class="col-lg-6">
                <h1 class="firstPageText">Here to serve you good looks and good coffee!</h1>
                
                <form>
                    <a href="check_schedule.php" class="btn btn-light btn-lg mx-2 my-3"><i class="fas fa-book"></i> Book Now</a>
                    <a href="about_us.php" class="btn btn-outline-light btn-lg mx-2 my-3"><i class="fas fa-info-circle"></i> About Us</a>
                </form>           
            </div>
            <div class="col-lg-6 mobMargin">
            <div class="card">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="images/titlepic2.jpeg" class="d-block w-100 titlePic " alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/titlepic3.jpeg" class="d-block w-100 titlePic " alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="images/titlepic4.jpeg" class="d-block w-100 titlePic " alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
            </div>
        </div>
    </section>
<!-- 
    <section id="services">
        <h1>Featured Services</h2>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <img src="images/service1.jpg" class="card-img-top">
                            <div class="card-body">
                              <h5 class="card-title">Haircut</h5>
                              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                              <a href="#" class="btn btn-dark">Book Now</a>
                            </div>
                          </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <img src="images/service2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Rebond</h5>
                              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                              <a href="#" class="btn btn-dark">Book Now</a>
                            </div>
                          </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <img src="images/service3.jpeg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Lorem</h5>
                              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                              <a href="#" class="btn btn-dark">View All Services</a>
                            </div>
                          </div>
                    </div>
                </div>
                
            </div>
    </section>

    <section id="food">
        <h1>Featured Food</h2>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <img src="images/service1.jpg" class="card-img-top">
                            <div class="card-body">
                              <h5 class="card-title">Haircut</h5>
                              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                              <a href="#" class="btn btn-dark">Book Now</a>
                            </div>
                          </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <img src="images/service2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Rebond</h5>
                              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                              <a href="#" class="btn btn-dark">Book Now</a>
                            </div>
                          </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="card">
                            <img src="images/service3.jpeg" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">Lorem</h5>
                              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                              <a href="#" class="btn btn-dark">View All Services</a>
                            </div>
                          </div>
                    </div>
                </div>
                
            </div>
    </section> -->

    <?php include "footer/footer.php" ?>  
</body>
</html>
