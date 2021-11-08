<?php 
 
require_once 'db_connect.php';
 
if($_POST) {
    $programID = $_POST['programID'];
 
    $sql = "DELETE FROM program WHERE programID = {$programID}";
    if($connect->query($sql) === TRUE) {
        echo "<p>Successfully removed!!</p>";
        echo "<a href='../indexprogram.php'><button type='button'>Back</button></a>";
    } else {
        echo "Error updating record : " . $connect->error;
    }
 
    $connect->close();
}
 
?>