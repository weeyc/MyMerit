<?php 
require_once 'php_action/db_connect.php'; 

    session_start();
    $AdminstratorID = $_SESSION['administratorID'];

   
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Program Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <style type="text/css">
        .program {
            width: 50%;
            margin: auto;
        }
 
        table {
            width: 110%;
            margin-top: 20px;
        }
 
    </style>
 
</head>
<body>
 <div class="topnav">
            <a href="adminhomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>

            </div>
        </div>
<div class="program">
    
    <table border="1" cellspacing="0" cellpadding="0"> 
        <h1>Program Details</h1>
        <thead>
            <tr>
                <th>Program Name</th>
                <th>Approval Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * FROM program WHERE programID = programID";
            $result = $connect->query($sql);
 
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['programName']."</td>
                        <td>".$row['status']."</td>
                        <td>
                            <a href='adminview.php?programID=".$row['programID']."'><button type='button'>View Program</button></a>
                            <a href='acceptques.php?programID=".$row['programID']."'><button type='button'>Accept</button></a>
                            <a href='rejectques.php?programID=".$row['programID']."'><button type='button'>Reject</button></a>
                        </td>
                    </tr>";
                }

            } else {
                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
            }
            ?>

        </tbody>
    </table>
    <br><br>
   <a href="adminhomepage.php"><button type="button">Back To Home Page</button>
</div>
  
</body>
</html>