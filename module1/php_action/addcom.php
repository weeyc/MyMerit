<?php 
 
require_once 'db_connect.php';
 
if($_POST) {
    $studentid = $_POST['studentid'];
    $telephoneno = $_POST['telephoneno'];
    $position = $_POST['position'];

    $sql = "INSERT INTO committee (studentid, telephoneno, position,active) VALUES ('$studentid','$telephoneno','$position',1)";
    if($connect->query($sql) === TRUE) {
        echo "<p>Your Committee Has Been Applied.</p>";
        echo "<a href='../indexcommittee.php'><button type='button'>Back</button></a>";
    } else {
        echo "Error " . $sql . ' ' . $connect->connect_error;
    }
 
    $connect->close();
}
 
?>