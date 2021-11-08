<?php
    session_start();
?>
<!DOCTYPE html>
<!--Wee Yuu Cheng Cb18068 (4b)-->
<html>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/3cc6771f24.js"></script>
<div class="topnav">
<a href="../module1/adminHomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
</div>
</div>
<div class="startHere">    

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;    
}
</style>

<title>Program Merit</title>
<h4>Selected Program Details: </h4>

<?php
$proID = $_GET['proID'];


$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "mymerit") or die(mysqli_error());


//SQL query
$coQuery = "SELECT program.programID, program.programName, program.coordinatorID , coordinator.coordinatorName
FROM program, coordinator
WHERE program.coordinatorID = coordinator.coordinatorID AND program.programID ='$proID';";

$strSQL = "SELECT attendance.attendanceID, student.studentID,student.studentName, program.programMerit, qrcode.qrCodeType
FROM student, program, attendance, qrcode
WHERE attendance.studentID = student.studentID AND attendance.qrCodeID = qrcode.qrCodeID AND qrcode.programID = program.programID AND program.programID ='$proID' ORDER BY qrcode.qrCodeType DESC;";

$result = mysqli_query($link, $coQuery);

$rs = mysqli_query($link, $strSQL);

?>

 <table  border="1" style="width:100%" class = "w3-table-all w3-hoverable"> 
        <tr>
            <th>Program ID</th>
            <th>Program Name </th>
            <th>Program Coordinator</th>
            <th>Coordinator ID</th>
        </tr>

<?php
     
        while ($row = mysqli_fetch_assoc($result)){
 
?>
        <tr>    
            <td><?php echo $row['programID'];
            $proID = $row['programID'];?></td>
            <td><?php echo $row['programName'];
            $proName=$row['programName'];
            $str="proID={$proID}&proName={$proName}";?></td>
            <td><?php echo $row['coordinatorName']; ?></td>     
            <td><?php echo $row['coordinatorID']; ?></td>   
          
        </tr>
    <?php
    }    
?>
 </table>

<h4>List of participant who attend the program:</h4>

<table  width=100% class = "w3-table-all w3-hoverable"> 
        <tr>
            <th>No.</th>
            <th>Attendance ID</th>
            <th>Student ID </th>
            <th>Student Name</th>
            <th>Merit Assign</th>
            <th>Partipate as</th>
        </tr>
    <?php
        $countNo = 1;
        if (mysqli_num_rows($rs) > 0) {      
        while ($row = mysqli_fetch_assoc($rs)){
    ?>
        <tr> 
            <td><?php echo $countNo++;?></td>   
            <td><?php echo $row['attendanceID'];?></td>
            <td><?php echo $row['studentID']; ?></td>
            <td><?php echo $row['studentName']; ?></td>     
            <td><?php echo $row['programMerit']; ?></td>   
            <td><?php echo $row['qrCodeType']; ?></td>    
        </tr>
       
     
 <?php
     }
//Close the database connection
//mysqli_close($link);
            ?>	 
             <tr>
            <td colspan = 6> <button  onclick="window.location.href='http://localhost/mymerit/module4/addMerit.php?<?php echo $str;?>'" class = "w3-center w3-btn w3-red w3-small w3-round-large" style="float: right;";> Release Merit </button></td>
        </tr>
        <?php
    }
?>
</table>


</html>
