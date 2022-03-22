<?php
    include 'connection.php';
    session_start();

    if(isset($_SESSION['email']) AND ($_SESSION['usertype'] == 'ADMINISTRATOR')){
        echo 'Good day! ' . $_SESSION['email'] . ' <a href="management.php">Admin Panel</a>';
    } elseif(isset($_SESSION['email']) AND ($_SESSION['usertype'] == 'STAFF')) {
        echo 'Good day! ' . $_SESSION['email'] . ' <a href="management.php">Staff Panel</a>';
    }

    if(isset($_POST['verifyappt'])){

        //SETS SESSION AND POST VALUES
        $_SESSION['customerName'] = $_POST['name'];
        $_SESSION['customerEmail'] = $_POST['email'];
        $_SESSION['contact'] = $_POST['contact'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $_SESSION['datetime'] = $date . ' ' . $time;
        $datetime = $_SESSION['datetime'];
        $email = $_SESSION["customerEmail"];
        $contact = $_SESSION['contact'];

        //VERIFY IF DATE&TIME, EMAIL, CONTACT NUMBER IS ALREADY TAKEN IN DATABASE ONLY IF STATUS IS VERIFIED.
        $datetime_check = "SELECT * FROM appointment WHERE datetime = '$datetime' AND status='Verified'";
        $email_check = "SELECT * FROM customer, appointment WHERE email = '$email' AND status='Verified'";
        $contactNum_check = "SELECT * FROM customer, appointment WHERE contact = '$contact' AND status='Verified'";
        $res = mysqli_query($con, $datetime_check);
        $res2 = mysqli_query($con, $email_check);
        $res3 = mysqli_query($con, $contactNum_check);
        
        if(mysqli_num_rows($res) > 0){
            $_SESSION['schederror'] = "Scheduled that you have selected is already taken.";
            header('Location: check_schedule.php');
        } elseif(mysqli_num_rows($res2) > 0) {
            $_SESSION['emailerror'] = "Email that you have entered is already taken.";
            header('Location: check_schedule.php');
        } elseif(mysqli_num_rows($res3) > 0) {
            $_SESSION['emailerror'] = "Contact number that you have entered is already taken.";
            header('Location: check_schedule.php');
        }

    } else {
        header('Location: check_schedule.php');
    }

    //SELECT SERVICE NAME IN DATABASE
    $selectServices = "SELECT * FROM men_service_table WHERE status = 'ACTIVE'";
    $res4 = mysqli_query($con, $selectServices);
    if(!$res4){
        die('Query FAILED!' . mysqli_error());
    }

?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="css/servicesfood.css">

    <title>Obaya Studio | Book Appointment</title>
</head>
<body>
    <?php include "navbar/navbar.php"; ?>
    <div class="container-fluid">
        <!-- CARD -->
        <div class="card mx-auto shadow p-3 mb-5 bg-body rounded col-lg-6 ">
        <div class="mt-5">
                <h5 class="fw-bold my-3">Book Appointment</h5>
                <div class="card-body p-4">
                <!-- FORM -->
                    <form action="submit_booking.php" method="POST" id="addServiceForm">
                        <div id="showItem">
                            <div class="row">
                                <div class="col-lg-10 mb-3">
                                    <select class="form-select" name="service" id="service">
                                        <option value='' selected="true" disabled="disabled">Select Service</option>
                                        <option value='' disabled="disabled">----------Men's Services----------</option>
                                        <?php
                                            while($row = mysqli_fetch_assoc($res4)){
                                                $service = $row['name'];
                                                echo "<option value='$service'>$service</option>";
                                            }
                                        ?>
                                        <option value='' disabled="disabled">----------Women's Services----------</option>
                                    </select>
                                    <!-- <input type="text" class="form-control" name="service" id="service" placeholder="Service"  required> -->
                                </div>
                                <div class="col-lg-2 d-grid mb-3">
                                    <a class="btn btn-primary addClient">Add Client</a>                                        
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="submit" name="bookappt" id="submitButtonService" class="form-control mb-3 btn btn-primary">
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
