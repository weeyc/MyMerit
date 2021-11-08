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

<title>Claim Approval</title>


<?php
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "mymerit") or die(mysqli_error());




$proID = $_GET['proID'];

//program detail
$EventD = "SELECT program.programID , program.programName
FROM program, coordinator, student
WHERE  program.coordinatorID = coordinator.coordinatorID AND coordinator.studentID = student.studentID AND coordinator.coordinatorID = '$ID' AND program.programID = '$proID'";

$result = mysqli_query($link, $EventD);


//SQL query to list of student claim prove for approval 
$strSQL = "SELECT attendance.attendanceID, merit.MeritID, merit.StudentID, student.studentName, merit.merit, merit.position, merit.prove,merit.approval_status
FROM merit, program, student, attendance
WHERE  merit.programID = program.programID AND merit.StudentID = student.studentID AND (approval_status = 'pending') AND merit.attendanceID = attendance.attendanceID AND program.programID= '$proID'";

$rs = mysqli_query($link, $strSQL);
?>


<h4> Program Details:</h4>
 <table  border="1" style="width:100%" class = "w3-table-all w3-hoverable"> 
        <tr>
            <th>Program ID</th>
            <th>Program Name </th>
        </tr>

<?php
        while ($row = mysqli_fetch_assoc($result)){
 
?>
        <tr>    
            <td><?php echo $row['programID'];?></td>
            <td><?php echo $row['programName']; ?></td>    
        </tr>
    <?php
    }    
?>
 </table>

   
 <br><br><h4> List of Student Claiming:</h4>
 <center>
<table width=100% class = "w3-table-all w3-hoverable">  
        <tr>
            <th>No.</th>
            <th>Attendance ID</th>
            <th>Merit ID</th>
            <th>Student ID </th>
            <th>Student Name </th>
            <th>Merit</th>
            <th>Position</th>
            <th>Prove File</th>
            <th>Approval Status</th>
            <th>Action</th>
        </tr>

<?php
    $count=1;
    if (mysqli_num_rows($rs) > 0){
        
        while ($row=mysqli_fetch_array($rs)){
       

    ?>  <form action="coordinatorStdMeritClaimsList.php" method="post" role ="form ">
        <tr>   
        
            <td><?php echo $count?></td> 
            <td><?php echo $row['attendanceID']; ?></td>
            <td><?php echo $row['MeritID'];
                $meritID =  $row['MeritID'];
                  $str="mID={$meritID}"; ?> </td>
            <td><?php echo $row['StudentID']; ?></td>   
            <td><?php echo $row['studentName']; ?></td>   
            <td><?php echo $row['merit']; ?></td>   
            <td><?php echo $row['position']; ?></td>   
            <td><a href="uploadClaim.php?<?php echo $str?> " target="_blank">View Prove</a></td>  
           
            <td><?php echo $row['approval_status']; ?></td> 

            <td>   
            <input type="hidden" name="mid" value="<?php echo $row['MeritID'];?>">  
             <input type="submit" name="approve" value="Approve"   class = "w3-center w3-btn w3-teal w3-small w3-round-large";>  
             / <input type="submit" name="reject" value="Reject"   class = "w3-center w3-btn w3-red w3-small w3-round-large";>  </td>
             </form>
         <?php
               $count++; 
                }
            
            }
         
            ?>
        </tr>
 

</table>
    </center>
<?php
    if(isset($_POST['approve'])){
            $meritID = $_POST['mid'];
            $Query = "UPDATE merit
            SET approval_status ='approved'
            WHERE MeritID='$meritID'" 	or die(mysqli_connect_error());

            $result = mysqli_query($link, $Query);

            $str="proID={$proID}";
        
        ?>

            <script type="text/javascript">
                    alert("Approved Success!");
                   
                    window.location = "coordinatorStdMeritClaimsList.php?<?php echo $str;?>";                  
            </script> 
<?php
        }
        //update, will redirect to update page
        if(isset($_POST['reject'])){
            $meritID = $_POST['mid'];
            $Query = "UPDATE merit
            SET approval_status ='denied'
            WHERE MeritID='$meritID'";
            $str="proID={$proID}";
            $result = mysqli_query($link, $Query);
        
           
    ?>
              <script type="text/javascript">
                    alert("Reject Success!");
                    window.location = "coordinatorStdMeritClaimsList.php?<?php echo $str;?>";                  
            </script> 
<?php
        }

        ?>






</html>
