<?php 
 
require_once 'db_connect.php';
 
if($_POST) {
    $programID = $_POST['programID'];
 
    $sql = "update program set status='Approved' where programID ={$programID}";
    if($connect->query($sql) === TRUE) {
        echo "<p>The Committee is added.Thank You!</p>";
        echo "<a href='../adcommitte.php'><button type='button'>Back To  List Student</button></a>";
    } else {
        echo "Erorr while updating record : ". $connect->error;
    }
 
    $connect->close();
 
}
 