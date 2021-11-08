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

<title>Claim Merit</title>
<h4>Your Merits Details: </h4>

<?php

$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "mymerit") or die(mysqli_error());




if(isset($_POST['semester']))
{
    $sem = $_POST['sem'];

    $query = "SELECT  merit.MeritID, program.programID,program.programName, merit.merit, merit.position,merit.positionMerit,merit.totalMerit
    FROM merit, program
    WHERE merit.programID=program.programID AND merit.StudentID='$stdID' AND merit.approval_status='approved' AND merit.semester ='$sem'
    ORDER BY merit.MeritID";


    $rs = mysqli_query($link, $query); 


    $sum = "SELECT SUM(totalMerit)
            FROM merit
            WHERE StudentID = '$stdID'  AND approval_status='approved' AND merit.semester ='$sem'";

    $sumResult = mysqli_query($link, $sum);
}
else {
    $query = "SELECT * FROM `merit` WHERE StudentID= NULL";
    $rs = mysqli_query($link, $query);
}



//Student info
$coQuery = "SELECT merit.StudentID, student.studentName
            FROM merit, student
            WHERE merit.StudentID = student.studentID AND merit.StudentID='$stdID' ORDER BY merit.MeritID
            LIMIT 1 ";

$result = mysqli_query($link, $coQuery);





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
            <td><?php echo $row['StudentID'];?></td>
            <td><?php echo $row['studentName'];?></td>    
            <?php $sID =$row['StudentID'];
                    $sName = $row['studentName'];
            ?>
        </tr>
    <?php
    }    
?>
 </table>




<br><br>
<form action="viewMerit.php" method="post">

            <p>Select Semester:</p>  
            <select id="role" name="sem">
            
                <option value="sem 1 18/19" selected>Sem 1 18/19</option>
                <option value="sem 2 18/19">Sem 2 18/19</option>
                <option value="sem 1 19/20">Sem 1 19/20</option>
                <option value="sem 2 19/20">Sem 2 19/20</option>
            </select>
            <input type="submit" name="semester" value="submit"><br>
<?php
 if (isset($_POST['semester'])){
?>
    <h3>Semester:  <?php echo  $sem;?><h3>  
<?php
 }
 ?>
  
  <br>       

 <h4>List of program joined:</h4>

<table  width=100% class = "w3-table-all w3-hoverable"> 
        <tr>
            <th>No.</th>
            <th>Merit ID</th>
            <th>Program ID </th>
            <th>Program Name</th>
            <th>Program Merit</th>
            <th>Position as</th>
            <th>Position Merit</th>
            <th>Total Merit</th>
        </tr>
    <?php
        $countNo = 1;
        if (isset($_POST['semester'])){
            if (mysqli_num_rows($rs) > 0) {      
                 while($row = mysqli_fetch_array($rs)):?>
           
        <tr> 
            <td><?php echo $countNo++;?></td>   
            <td><?php echo $row['MeritID'];?></td>
            <td><?php echo $row['programID']; ?></td>
            <td><?php echo $row['programName']; ?></td>     
            <td><?php echo $row['merit']; ?></td>   
            <td><?php echo $row['position']; ?></td>    
            <td><?php echo $row['positionMerit']; ?></td>
            <td><?php echo $row['totalMerit']; ?></td>
        </tr>
       
     
 <?php endwhile; 
     
    

            ?>	 
        <tr>
            <td colspan =9 align="right" > 
            Grand Total Merit:   <?php $sr = mysqli_fetch_assoc($sumResult) ?>
            
            <input type="text" name="sum" value="<?php echo $sr['SUM(totalMerit)'];?>"  style="float: right; background-color: while;" size="16" readonly></td>
            <?php $totalMerit = $sr['SUM(totalMerit)']; ?>

            <?php  $string ="sID={$sID}&sName={$sName}&totalMerit={$totalMerit}&sem={$sem}" ?>    
        </tr>
        <tr>
                <td colspan =8 a> <button  onclick="PrintImage('../module4/printMerit.php?<?php echo $string;?>'); return false;" class = "w3-center w3-btn w3-blue w3-small w3-round-large" ; style="float: right;"> Print Certificate </button>
                          
                </td>

         </tr>
    <?php
        }
             else{
    ?>
                <td colspan =8> <div class="alert alert-warning"> <p>No merit for you for this semester!</p></div></td>
    <?php
             }
        }
?>
</table>

</form>

<script>

    function ImagetoPrint(source)
    {
        return "<html><head><scri"+"pt>function step1(){\n" +
                "setTimeout('step2()', 10);}\n" +
                "function step2(){window.print();window.close()}\n" +
                "</scri" + "pt></head><body onload='step1()'>\n" +
                "<img src='" + source + "' /></body></html>";
    }

    function PrintImage(source)
    {
        var Pagelink = "about:blank";
        var pwa = window.open(Pagelink, "_new");
        pwa.document.open();
        pwa.document.write(ImagetoPrint(source));
        pwa.document.close();
    }

</script>





</html>
