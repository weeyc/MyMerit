<?php
    session_start();
    $ID = $_SESSION['coordinatorID'];
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
<a href="../module1/homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
<div class="topnav-right">
<a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
<a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a> 
</div>
</div>
<div class="startHere">

<title>Program Merit</title>
<h4> List of your coordinated program that not all attendees claim merit yet :</h4>

<?php
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "mymerit") or die(mysqli_error());

//SQL query to find which program is not yet approved
$strSQL = "SELECT program.programID, program.programName,merit.semester,merit.approval_status
FROM merit, program, coordinator, student
WHERE  merit.programID = program.programID AND (approval_status = 'denied' OR approval_status = 'pending') AND program.coordinatorID = coordinator.coordinatorID AND coordinator.studentID = student.studentID AND coordinator.coordinatorID = '$ID'";

//show only one row
$OneResult = "SELECT program.programID, program.programName,merit.semester,merit.approval_status
FROM merit, program, coordinator, student
WHERE  merit.programID = program.programID AND (approval_status = 'denied' OR approval_status = 'pending') AND program.coordinatorID = coordinator.coordinatorID AND coordinator.studentID = student.studentID AND coordinator.coordinatorID = '$ID'
GROUP BY program.programID";



$rs = mysqli_query($link, $strSQL);

$os = mysqli_query($link, $OneResult);

?>


<center>
<table width=100% class = "w3-table-all w3-hoverable">  
    

        <tr>
            <th>No.</th>
            <th>Event ID</th>
            <th>Event Name </th>
            <th>Semester</th>
            <th>All Student Merit Claimed Status</th>
            <th>Action</th>
        </tr>
    <?php
    $count=1;
    if (mysqli_num_rows($rs) > 0){
        while ($row=mysqli_fetch_array($os)){
        //Write the value of the column FirstName and Address
    ?>
       
        <tr>   
            <td><?php echo $count?></td> 
            <td><?php echo $row['programID'];
                       $proID = $row['programID'];
                       $str="proID={$proID}"; ?></td>
            <td><?php echo $row['programName']; ?></td>
            <td><?php echo $row['semester']; ?></td>   
            <td> <input type="text" id="mstatus" value="Not all Attendees Claim Yet" disabled></td>  
            

        
            <td><a href="coordinatorStdMeritClaimsList.php?<?php echo $str;?>">View Details </a></td>

         <?php
               $count++; 
                }
            }
         
            ?>
        </tr>
 

</table>
    </center>


</html>
