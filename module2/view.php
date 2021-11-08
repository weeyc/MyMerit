<?php 
session_start();
     $connect = mysqli_connect("localhost", "root", "", "mymerit");
     
     $id = $_SESSION['id'];
    

        $sqlCommittee ="SELECT qrcode.qrCodeID, qrcode.programID, qrcode.qrCodeType, qrcode.qrCodeImage
                        FROM qrcode, program
                        WHERE qrcode.programID  = program.programID AND qrcode.programID='$id' AND qrcode.qrCodeType = 'Committee' AND qrcode.active_status = '1'";

            $sqlParti ="SELECT qrcode.qrCodeID, qrcode.programID, qrcode.qrCodeType, qrcode.qrCodeImage
                        FROM qrcode, program
                        WHERE qrcode.programID  = program.programID AND qrcode.programID='$id' AND qrcode.qrCodeType = 'Participant' AND qrcode.active_status = '1'";

         $comResult = mysqli_query($connect, $sqlCommittee);
         $partiResult = mysqli_query($connect, $sqlParti);
    
         
?>
<html lang="en">
<head>
 <title>Program QR CODE</title>
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <style>
        body, html {
            height: 100%;
            width: 100%;
        }
        .column {
            float: left;
            padding: 10px;
        }
        .middle, .right {
            width: 40%;
        }
    </style>
   
</head>
<body class="bg">
     <div class="topnav">
     <a href="../module1/Homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
        <h2> QR Code for Program ID: <?php echo "$id";?>
    <form method="POST" enctype="multipart/form-data">
    <div class="container" id="panel">
        <br><br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background-color: white; padding: 20px; text-align: center;">
       <center>     
          <table style="center" border = 1>
               <tr>
                <th>
                 <center> QR Code Type </center>
                </th>
                <th>
                <center> QR Code  </center>
                </th>
            </tr>
            <?php while($row = mysqli_fetch_array($comResult))
            { 
                                $qrID = $row['qrCodeID'];
                                $pID =  $row['programID'];
                                $str="qrCodeID={$qrID}&programID={$pID}"; 

             ?>      <tr>
                <td>
                    <strong><?php echo $row['qrCodeType'];?> </strong></td>
                <td>
                   <a href="../module3/committeeScanned.php?<?php echo $str;?>"> <img src="qrcode.php?programID=<?php echo $id ?>" alt=""> </a>
                    </td>
                  
                </tr>
                
            <?php }?>
            <?php while($row = mysqli_fetch_array($partiResult))
            { 
                        $qrID = $row['qrCodeID'];
                        $pID =  $row['programID'];
                        $str="qrCodeID={$qrID}&programID={$pID}";

          ?>
                <tr>
                <td><strong><?php echo $row['qrCodeType'];?> </strong></td>
                    <td>
                       <a href="../module3/participantScanned.php?<?php echo $str;?>"> <img src="qrcode.php?programID=<?php echo $id ?>" alt=""> </a>
                    </td>
                  
                </tr>
                
            <?php }?>

            </table>
            </center>     

              
            </div>
        </div>
        
    </div>
</form>
</div>
</body>
</html>