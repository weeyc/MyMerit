<?php 
 
require_once 'db_connect.php';
 
if($_POST) {
    $programName = $_POST['programName'];
    $sem = $_POST['sem'];
    $programDateFrom = $_POST['programDateFrom'];
    $programDateTo = $_POST['programDateTo'];
    $programTimeFrom = $_POST['programTimeFrom'];
    $programTimeTo = $_POST['programTimeTo'];
    $programLocation = $_POST['programLocation'];
    $programNumofParticipants = $_POST['programNumofParticipants'];
    $programMerit = $_POST['programMerit'];
 
    $programID = $_POST['programID'];
 
    $sql = "UPDATE program SET programName = '$programName', sem = '$sem', programDateFrom = '$programDateFrom', programDateTo = '$programDateTo', programTimeFrom = '$programTimeFrom',programTimeTo = '$programTimeTo', programLocation = '$programLocation', programNumofParticipants = '$programNumofParticipants', programMerit = '$programMerit' WHERE programID = {$programID}";
    if($connect->query($sql) === TRUE) {
        echo "<p>Succcessfully Updated</p>";
        echo "<a href='../indexprogram.php'><button type='button'>Back</button></a>";
    } else {
        echo "Erorr while updating record : ". $connect->error;
    }
 
    $connect->close();
 
}
 
?>