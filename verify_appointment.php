<?php
include_once('connection.php');
 
if(isset($_GET['verify'])){
    $id = $_GET['verify'];
    $sql= "UPDATE appointment SET status='Verified' WHERE appointmentId='$id'";
    $result = mysqli_query($con, $sql);

    if(!$result){
        die('Update failed.');
    } else {
        header('Location: manage_appointments.php');
    }
}
?>