<?php
    session_start();
    $stdID = $_SESSION['studentID'];
    $name = $_SESSION['user_name'];
    
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><title>Student Homepage</title>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
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
  </head>

  <body>

  <div class="middle">
    <div class="counting-sec">
      <div class="inner-width">
        <div class="col">
          <i class="fa fa-bicycle"></i>
          <div class="num">
<?php
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "mymerit") or die(mysqli_error());

$query = "SELECT COUNT(merit.StudentID)
FROM merit 
WHERE merit.StudentID='$stdID '";
$result = mysqli_query($link, $query);


$sr = mysqli_fetch_assoc($result);
            
echo $sr['COUNT(merit.StudentID)'];
?> 
</div>
Program Joined
</div>
        <div class="col">
          <i class="fa fa-id-card"></i>
          <div class="num">
          <?php


$query = "SELECT COUNT(merit.StudentID)
FROM merit,qrcode,attendance
WHERE merit.StudentID='$stdID' AND merit.attendanceID=attendance.attendanceID AND attendance.qrCodeID = qrcode.qrCodeID AND qrcode.qrCodeType='committee'";
$result = mysqli_query($link, $query);


$pr = mysqli_fetch_assoc($result);
            
echo $pr['COUNT(merit.StudentID)'];

?> 
</div>
Joined AS Committee
</div>

        <div class="col">
          <i class="fa fa-check-square"></i>
          <div class="num"><?php


$query = "SELECT SUM(totalMerit)
FROM merit
WHERE studentID= '$stdID' AND approval_status = 'approved'";
$result = mysqli_query($link, $query);


$mr = mysqli_fetch_assoc($result);
            
echo $mr['SUM(totalMerit)'];

?> 

</div>
MERITS OBTAINED
</div>


<div>

<b>
Student Name: <?php echo $name;?>
<br>
Student ID: <?php echo $stdID;?>
</b>
  <br><p><u>Student Menu</u></p>
<table>
    <tr>
      <td><button  onclick="window.location.href='http://localhost/mymerit/module4/claimMerit.php'" class = "w3-center w3-btn w3-teal w3-small w3-round-large";> Claim Merit </button>
       <button  onclick="window.location.href='http://localhost/mymerit/module4/viewMerit.php'" class = "w3-center w3-btn w3-teal w3-small w3-round-large";> View Merit </button> 
      <button  onclick="window.location.href='http://localhost/mymerit/module4/meritBarChart.php'" class = "w3-center w3-btn w3-teal w3-small w3-round-large";> Merit Performance </button> </td>
    </tr>

    <tr>
      <td> <br></td>
    </tr>

<tr>
  <td><button  onclick="window.location.href='http://localhost/mymerit/module4/graphByProgramMerit.php'" class = "w3-center w3-btn w3-teal w3-small w3-round-large";> Analyse Program Merit </button> </td>
</tr>

<tr>
      <td> <br></td>
    </tr>

  <tr><td>
      <form action="" method="post">
          <input type ="submit"  name = "coordinator" value="Register As program Coordinator" class = "w3-center w3-btn w3-teal w3-small w3-round-large";> 
      <form>
      </td>
  </tr>

</div>

  </body>
<?php
    //register as coordinator
   if(isset($_POST['coordinator'])){
     

      $query = "SELECT * FROM `coordinator`
                WHERE coordinator.studentID = '$stdID'";
       $coRs = mysqli_query($link, $query);


       if (mysqli_num_rows($coRs) > 0) {  
        ?>

          <script type="text/javascript">
           alert("Error: You have already Registered As Program Coordinator!!");
           window.location="http://localhost/mymerit/module4/stdDash.php";
        </script>
<?php
       }else{

        $sql = "SELECT * FROM `student` WHERE studentID = '$stdID'";
        $stdRs = mysqli_query($link, $sql);
        $row = mysqli_fetch_array($stdRs);
        $stdname = $row['studentName'];
        $email = $row['studentEmail'];
        $telNo = $row['studentTelNo'];
        $pass = $row['studentPassword'];
     

        $insert = "INSERT INTO coordinator (coordinatorName, coordinatorEmail, coordinatorTelNo, coordinatorPassword, studentID)
                   VALUES ('$stdname', '$email', '$telNo', '$pass', '$stdID')";

          $insertResult = mysqli_query($link, $insert);

                   if($insertResult){
                     ?>
                      <script type="text/javascript">
                          alert("You have Successfully Registered As Program Coordinator!");
                          window.location="http://localhost/mymerit/module4/stdDash.php";
                      </script>
<?php             
                }
                else echo "failed";

       }


   }


?>



</html>
