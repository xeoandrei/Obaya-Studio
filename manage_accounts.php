<?php
require "config.php";
require "controllerUserData.php";
//check if the session contains data
if (($_SESSION['usertype'] == 'ADMINISTRATOR'))
{
    //display session data
    /*
				?>
				<h3><?php echo "Welcome, " . $_SESSION['username']."!"; ?></h3>
				<h3> <?php echo "User type right now is: " . $_SESSION['usertype']; ?> </h3> 
				<?php
				*/} 
else
{
    header("location: management.php");}
?>
<html>
<head>
	<title>Accounts Management</title>
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
    <link rel="stylesheet" href="css/management.css">
</head>
<body>
<?php
include 'navbar/navbar-staffpage.php';
if(isset($_SESSION['email'])){
	?>
	<div class="container">
		<div class="col-lg-12 col-md-12">
			<div class="card shadow p-3 mb-5 bg-body rounded">
				<div class="card-header bg-dark text-white">
					<div class="float-start mt-2">
						Accounts Table | User: <?php echo $_SESSION['email'];?>  
					</div>
					<div class="float-end mt-2">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="row">
							<input class="form-control col me-2" type="text" placeholder="Search" name="txtsearch">
							<input class="btn btn-outline-success col-4 me-2" type="submit" value="Go">
						</form>
					</div>
				</div>
				<div class="card-body"></div>
					<?php 
                        if(isset($_SESSION['delete-account']))
                        {
                            echo'<div class="alert alert-success text-center">
                                ' . $_SESSION['delete-account'] . 
                            '</div>';
                            unset($_SESSION['delete-account']);
                        }
						elseif(isset($_SESSION['delete-account-failed']))
                        {
                            echo'<div class="alert alert-success text-center">
                                ' . $_SESSION['delete-account-failed'] . 
                            '</div>';
                            unset($_SESSION['delete-account-failed']);
                        }
                    ?>
					<?php 
					require_once "config.php";
					//search button
					// if(isset($_POST['btnsubmit'])){
					// 	$sql = "SELECT * FROM tbl_accounts WHERE username <> ? AND username LIKE ? ORDER BY username";
					// 	if($stmt = mysqli_prepare($link, $sql)){
					// 		$search = '%' . $_POST['txtsearch'] . '%';
					// 		mysqli_stmt_bind_param($stmt, "sss", $_SESSION['username'], $search, $search);
					// 		if(mysqli_stmt_execute($stmt)){
					// 			$result = mysqli_stmt_get_result($stmt);
					// 			build_table($result);
					// 		}
					// 		else{
					// 			echo "Error on search button";
					// 		}
					// 	}
					// }
					//form load
					// else{
						$sql = "SELECT * FROM usertable WHERE email <> ? ORDER BY id";
						if($stmt = mysqli_prepare($link, $sql)){
							mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
							if(mysqli_stmt_execute($stmt)){
								$result = mysqli_stmt_get_result($stmt);
								build_table($result);
							}
							else{
								echo "Error on form load";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<?php
}
else{
	//header("location: login.php");
}
?>

<?php
// script: error_reporting(0);
// echo $_SESSION['msg'];
// unset($_SESSION['msg']);
function build_table($result){
	if(mysqli_num_rows($result) > 0){
		//table header
		echo "<div class='table-responsive'>";
		echo "<table class='table table-sm'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th scope='col'>ID</th>";
		echo "<th scope='col'>Username</th>";
		echo "<th scope='col'>Email</th>";
		echo "<th scope='col'>Usertype</th>";
		echo "<th scope='col'>Status</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		//table data (loop each row of the result)
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<th scop='row'>" . $row['id'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['usertype'] . "</td>";
			echo "<td>" . $row['status'] . "</td>";
			echo "<td>";
			echo "<a class='btn btn-danger' href='delete_account.php?id=" . $row['id'] . "' onclick='return confirm(\"Do you want to Delete this Account?\")'>Delete</a> ";
			echo "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	else{
		echo "No user account/s found";
	}
}

// }
?>
</body>
</html>