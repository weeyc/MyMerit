<?php session_start();

if (isset($_POST['submit'])) {
     $connect = mysqli_connect("localhost", "root", "", "mymerit");
     $programID = $_GET['programID'];
     $qrcodeImage = $_POST['qrcodeImage'];
     $qrcodeType = $_POST['qrcodeType'];
     $strSQL = "INSERT INTO qrcode (qrcodeImage, qrcodetype, programID)
                VALUES ('$qrcodeImage', '$qrcodeType', '$programID');";
         $result = mysqli_query($connect, $strSQL);
         header('Location: ./1.php');
} ?>
<html lang="en">
<head>
        <title>QR CODE</title>
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
        .left{
         margin-left:30%; 
        }

        .right{
          margin-right:20%;
        }

        
    </style>
</head>
<body class="bg">
     <div class="topnav">
     <a href="../module1/adminHomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="#userProfile"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
    <div class="startHere">
      <form method="POST" enctype="multipart/form-data">
        <br>
        <?php $qrcodetype = $_GET['qrcodetype'];
            $programID = $_GET['programID'];
           
        ?>
                <table class="center">
                    <tr>
                        <th class="left"><h1><center>QR Code for <?php echo $qrcodetype?></center></h1></th>
                     
                     </tr>
                    <tr>
                        <td >
                            <input type="hidden" name="qrcodeImage" value="qrcode.php?programID=<?php echo $_SESSION['programID']?>"/>
                            <input type="hidden" name="qrcodeType" value='<?php echo $qrcodetype?>'/>
                            <img src="qrcode.php?programID=<?php echo $programID ?>" alt="">
                        </td>
                       
               
                    </tr>
                
                    <tr>
                        <button type="submit" name="submit"  class="btn btn-success">INSERT QR CODE</button>
                    </tr>
                
                </table>
            </form>
         </div>
    </body>
</html>