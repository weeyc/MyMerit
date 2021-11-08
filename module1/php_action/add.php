<?php 
 
require_once 'db_connect.php';
session_start();
$CoordinatorID = $_SESSION['coordinatorID'];

 
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
    $imagephoto = $_POST['imagephoto'];
    $status = $_POST['status'];
    $imageprogram = $_FILES['imageprogram']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["imageprogram"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
          // Convert to base64
          $image_base64 = base64_encode(file_get_contents($_FILES['imageprogram']['tmp_name']) );
          $imageprogram = 'data:image/'.$imageFileType.';base64,'.$image_base64;
      }

    $sql = "INSERT INTO program (coordinatorID,programName, sem, programDateFrom, programDateTo, programTimeFrom, programTimeTo, programLocation, programNumofParticipants,programMerit,imagephoto, status, imageprogram) VALUES ('$CoordinatorID','$programName', '$sem','$programDateFrom', '$programDateTo', '$programTimeFrom', '$programTimeTo', '$programLocation','$programNumofParticipants','$programMerit','$imagephoto','$status','$imageprogram')";
    if($connect->query($sql) === TRUE) {
        echo "<p>Your Program Has Been Applied.</p>";
        echo "<a href='../indexprogram.php'><button type='button'>Back</button></a>";
    } else {
        echo "Error " . $sql . ' ' . $connect->connect_error;
    }
 
    $connect->close();
}

 
?>