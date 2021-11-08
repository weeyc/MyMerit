<?php
    session_start();
    $stdID = $_SESSION['studentID'];
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
            <a href="stdDash.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
            <a href="../module6/stdProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">

</style>

<title>Claim Merit</title>
<h4>Your Details: </h4>

<?php

$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "mymerit") or die(mysqli_error());

//SQL query
$coQuery = "SELECT student.studentID, student.studentName
            FROM student
            WHERE student.studentID = '$stdID'";

$strSQL = "SELECT  merit.MeritID, program.programID,program.programName, merit.merit, merit.position,merit.prove, merit.approval_status
FROM merit, program
WHERE merit.programID=program.programID AND merit.StudentID='$stdID' AND merit.approval_status = 'denied' ORDER BY merit.approval_status";


$result = mysqli_query($link, $coQuery);

$rs = mysqli_query($link, $strSQL);

?>

 <table  border="1" style="width:100%" class = "w3-table-all w3-hoverable"> 
        <tr>
            <th>student ID</th>
            <th>Student Name </th>
        </tr>

<?php
        while ($row = mysqli_fetch_assoc($result)){
?>
        <tr>    
            <td><?php echo $row['studentID'];?></td>
            <td><?php echo $row['studentName'];?></td>    
            <?php $sID =$row['studentID'];
                    $sName = $row['studentName'];
            ?>
        </tr>
    <?php
    }    
?>
 </table>
<?php include 'uploadClaim.php'; ?>
 <br><br><h4>List of programs merit to claim:</h4>

<table  width=100% class = "w3-table-all w3-hoverable"> 
        <tr>
            <th>No.</th>
            <th>Program ID </th>
            <th>Program Name</th>
            <th>Merit Assign</th>
            <th>Position as</th>
            <th>Prove</th>
            <th>Approval Status</th>
            <th>Choose File (prove to claim merit)</th>
            <th>Upload Prove</th>
        </tr>
    <?php
        $countNo = 1;
        while ($row = mysqli_fetch_assoc($rs)){
           
    ?>
        <tr> 
            <td><?php echo $countNo++; ?></td> 
            <td><?php echo $row['programID'];?></td>
            <td><?php echo $row['programName']; ?></td>   
            <td><?php echo $row['merit']; ?></td>   
            <td><?php echo $row['position']; ?></td>    
            <td><?php echo $row['prove']; ?></td>
            <td><?php echo $row['approval_status']; ?></td>
            <td>           
                        <form method="POST" action="claimMerit.php" enctype="multipart/form-data">
                           
                            <input type="file" name="file">
                            <input type="hidden" name="mID" value = '<?php echo $row['MeritID'];?>'>
         </td>         
         <td>   
                            <button type="submit" name="upload" class = "w3-center w3-btn w3-teal w3-small w3-round-large";>Upload prove</button>
                            
           </td>      
                     </form>
            
            
        </tr>
       
 <?php
     }

            ?>	 
</table>
<?php
$pending = "SELECT  merit.MeritID, program.programID,program.programName, merit.merit, merit.position,merit.prove, merit.approval_status
FROM merit, program
WHERE merit.programID=program.programID AND merit.StudentID='$stdID' AND merit.approval_status = 'pending' ";


$presult = mysqli_query($link, $pending);
?>

<br><br><br><h4>List Pending approval:</h4>

<table  width=100% class = "w3-table-all w3-hoverable"> 
        <tr>
            <th>No.</th>
            <th>Program ID </th>
            <th>Program Name</th>
            <th>Merit Assign</th>
            <th>Position as</th>
            <th>Approval Status</th>

        </tr>
    <?php
        $countNo = 1;
        while ($row = mysqli_fetch_assoc($presult)){
           
    ?>
        <tr> 
            <td><?php echo $countNo++;?></td> 

            <td><?php echo $row['programID'];?></td>
            <td><?php echo $row['programName']; ?></td>   
            <td><?php echo $row['merit']; ?></td>   
            <td><?php echo $row['position']; ?></td>    
            <td><?php echo $row['approval_status']; ?></td>
        </tr>
       
 <?php
     }

            ?>	 

</table>









</html>
