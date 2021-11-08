<?php 
 
require_once 'db_connect.php';
    
    session_start();
    $AdminstratorID = $_SESSION['administratorID'];


if($_POST) {
    $programID = $_POST['programID'];
 
    $sql = "update program set status='Approved',administratorID='$AdminstratorID' where programID ='$programID'";
    if($connect->query($sql) === TRUE) {
        echo "<p>The Program Has Been Approved.Thank You!</p>";
        echo "<a href='../adminapprove.php'><button type='button'>Back To Program List</button></a>";
    } else {
        echo "Erorr while updating record : ". $connect->error;
    }
 
    $connect->close();
 
}
 
?>