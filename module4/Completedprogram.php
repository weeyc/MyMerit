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

<title>Program Merit</title>
<h4> List of program merit that not release yet:</h4>

<?php
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "mymerit") or die(mysqli_error());

//SQL query
$strSQL = "SELECT program.programID,program.programName, coordinator.coordinatorName, coordinator.coordinatorID, program.sem
            FROM  program, coordinator
            WHERE program.coordinatorID = coordinator.coordinatorID AND NOT EXISTS (SELECT 1 
            FROM   merit 
            WHERE  merit.programID = program.programID)";


$rs = mysqli_query($link, $strSQL);

?>


<center>
<table width=100% class = "w3-table-all w3-hoverable">  
    

        <tr>
            <th>No.</th>
            <th>Event ID</th>
            <th>Event Name </th>
            <th>Program Coordinator</th>
            <th>Coordinator ID</th>
            <th>Merit Release Status</th>
            <th>Semester</th>
            <th>Action</th>
        </tr>
    <?php
    $count=1;
        while ($row=mysqli_fetch_array($rs)){

    ?>
       
        <tr>   
            <td><?php echo $count?></td> 
            <td><?php echo $row['programID'];
                       $proID = $row['programID'];
                       $str="proID={$proID}"; ?></td>
            <td><?php echo $row['programName']; ?></td>
            <td><?php echo $row['coordinatorName']; ?></td>     
            <td><?php echo $row['coordinatorID']; ?></td>   

            <td> <input type="text" id="mstatus" value="Pending" disabled></td>
            <td><?php echo $row['sem']; 
            $semester =  $row['sem'];  ?></td>  
            <td><button  onclick="window.location.href='http://localhost/mymerit/module4/releaseMerit.php?<?php echo $str;?>'" class = "w3-center w3-btn w3-teal w3-small w3-round-large" ;> View Details </button></td>
            

         <?php
               $count++; 
                }
         
            ?>
        </tr>
 

</table>
</center>
<br><br>
<button type="button" onclick="window.location.href='Adminhome.php'" class = "w3-center w3-btn w3-blue w3-small w3-round-large">Back</button>


</html>
