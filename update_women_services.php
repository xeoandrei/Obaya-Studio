<?php
require_once "config.php";
include ("session-checker.php");
$id = $_GET['serviceId'];
//load service details on the update form
if(isset($_GET['serviceId']))
{
    trim($_GET['serviceId']);
    $sql = "SELECT * FROM women_service_table WHERE serviceId = ?";
    if($stmt = mysqli_prepare($link, $sql))
    {
        mysqli_stmt_bind_param($stmt, "s", $_GET['serviceId']);
        if(mysqli_stmt_execute($stmt))
        {
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0)
            {
                $women_service = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }
            else
            {
                header("location: error.php");
                exit();
            }
        }
        else
        {
            $_SESSION['update-women-error'] = "Error on select statement";
        }
    }
    else
    {
        $_SESSION['update-women-error'] = "Error on fetching form details.";
    }
}
else
{
    $_SESSION['update-women-error'] = "Error on retrieving Get serviceId";
}
?>

<?php
if(isset($_POST['btnUpdate']))
{
    $serviceImageNew = $_FILES['serviceImage']['name'];
    $image = str_replace(' ', '', $serviceImageNew);
    $serviceImageOld = $_POST['serviceImageOld'];
	//commit update
    if($serviceImageNew != '')
    {
        $serviceImageUpdateFN = $image;
    }
    else
    {
        $serviceImageUpdateFN = $serviceImageOld;
    }
    
    if(file_exists("images/WomenServicesImages/" . $image))
    {
        $filename = $image;
        $_SESSION['update-women-error'] = "Image already exists";
    }
    else
    {
        //check for allowed services image formats
        $allowed_extension = array('gif', 'png', 'jpg', 'jpeg');
        $filename = $image;
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed_extension))
        {
            $_SESSION['update-women-error'] = 'You are allowed to only update images with only jpg, png, jpeg and gif formats';
        }
        else
        {
            $sql = "UPDATE women_service_table SET name = ?, description = ?, cost = ?, status = ?, image = ? WHERE serviceId = ?";
            if($stmt = mysqli_prepare($link, $sql))
            {
                mysqli_stmt_bind_param($stmt, "ssssss", $_POST['serviceName'], $_POST['serviceDescription'], $_POST['serviceCost'], $_POST['serviceStatus'], $serviceImageUpdateFN, $_GET['serviceId']);
                if(mysqli_stmt_execute($stmt))
                {
                    $sql = "INSERT INTO tbl_logs VALUES (?, ?, ?, ?, ?, ?)";
                    if($stmt = mysqli_prepare($link, $sql))
                    {
                        if($image != '')
                        {
                            move_uploaded_file($_FILES["serviceImage"]["tmp_name"], "images/WomenServicesImages/".$image);
                            //delete images from image directory
                            unlink("images/WomenServicesImages/".$serviceImageOld);
                        }
                        else
                        {
                            $_SESSION['update-women-error'] = "Error on moving uploaded files.";
                        }
                        $action = 'Update';
                        $module = 'Women-Services';
                        $usertype = $_SESSION['usertype'];
                        $name = $_SESSION['name'];
                        mysqli_stmt_bind_param($stmt, "ssssss", date("m/d/Y"), date("h:i:sa"), $action, $usertype, $name, $module);
                        if(mysqli_stmt_execute($stmt))
                        {
                            $_SESSION['update-women-success'] = 'Women\'s Service was Successfully Updated!';
                            header("location: manage_women_services.php");
                            exit();
                        }
                        else
                        {
                            $_SESSION['update-women-error'] = "Error on inserting logs";
                        }
                    }
                    else
                    {
                        $_SESSION['update-women-error'] = "Error before inserting logs";
                    }
                }
                else
                {
                    $_SESSION['update-women-error'] = "Error on update statement";
                }
            }
            else
            {
                $_SESSION['update-women-error'] = "Error before update statement";
            }
        }
    }
}
?>
<html>
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

    <title>Obaya Studio | Update Services</title>
</head>
<body>
<?php include "navbar/navbar-admin.php"; ?>
	<div class="container-fluid row">	
            <!-- CARD -->
			<div class="card mx-auto shadow p-3 mb-5 bg-body rounded col-lg-6 col-md-8">
				<div class="mt-5">
                    <h5 class="fw-bold my-3">Update Services</h5>
                    <?php 
                        if(isset($_SESSION['update-women-error']))
                        {
                            echo'<div class="alert alert-danger text-center">
                                ' . $_SESSION['update-women-error'] . 
                            '</div>';
                            unset($_SESSION['update-women-error']);
                        }
                    ?>
					<div class="card-body">
						<form action = "<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method = "post" enctype = "multipart/form-data">
							<div class="row">

                            	<div class="mb-3 col-6">
									<input type="text" class="form-control" value="<?php echo $women_service['name'];?>" name="serviceName" required>
								</div>	 

								<div class="mb-3 col-6">
        							<input type= "number" class="form-control" value = "<?php echo $women_service['cost'];?>" name = "serviceCost" min="0" max="9999" onKeyPress="if(this.value.length==4) return false;" required>
								</div>	

								<div class="mb-3 col-6">
									<select name="serviceStatus" id = "serviceStatus" class="form-select" required>  
										<option value = "" selected="true" disabled="disabled">Select Status</option> 
										<option value = "ACTIVE">ACTIVE</option>
										<option value = "INACTIVE">INACTIVE</option>
									</select>
								</div>	

								<div class="mb-3 col-6">
									<input type="file" class="form-control" name="serviceImage" value = "<?php echo $women_service['image'];?>" required>
									<input type="hidden" class="form-control" name="serviceImageOld" value = "<?php echo $women_service['image'];?>">
								</div>

								<div class="mb-3 col-6">
									<textarea class="form-control" rows = "4" name="serviceDescription" required><?php echo $women_service['description'];?></textarea>
								</div>

								<div class = "row">
									<div class = "mb-3 col-6">
										<input type = "submit" class= "form-control btn btn-primary" name = "btnUpdate" value = "Save">
									</div>	

									<div class = "mb-3 col-6">
										<a href = "manage_women_services.php" class="form-control btn btn-dark">Cancel</a>
									</div>	
								</div>
							</div>						
						</form>
					</div>		
				</div>
			</div>	
	</div>
</body>
</html>
<!--  -->