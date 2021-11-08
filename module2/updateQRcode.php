<?php
    session_start();

    $coordinatorID = $_SESSION['coordinatorID'];
    $programID = $_GET['pID'];
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "mymerit");

    if(isset($_POST['update'])){
        $active_status = $_POST['active_status'];
        $programID =  $_POST['programID'];
    
        
        $sqlUpdate = "UPDATE qrcode SET active_status = '$active_status'
        WHERE programID = '$programID'";

        if(mysqli_query($conn, $sqlUpdate)){
            ?>
       <script type="text/javascript">
           alert('Update successful');
           window.location = "./listOfGeneratedCodeProgram.php";
         </script>
         <?php
    
            
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Qr Code</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
        <style>
            h4 {
                font-weight: bold;
            }

            td {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            th {
                text-align: center;
            }

            .noborder {
                border: none;
            }
        </style>
    </head>

    <body>
        <div class="topnav">
            <a href="../module1/homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
            <h2 style="text-decoration: underline;">QR CODE Details</h2>
            <br>
            <table>
                <?php
                     $sqlResult = "SELECT qrcode.qrCodeID, qrcode.qrCodeType, qrcode.active_status
                     FROM qrcode
                     WHERE qrcode.programID = '$programID'";

                    $rs = mysqli_query($conn, $sqlResult);
                  
                ?>
                <form name="myForm" action="" method="POST">
               
                  <tr>      
                          <td>Program ID :&emsp;</td>
                          <td><input type="text"  name="programID" value="<?php echo $programID?>" readonly></td>
                 <tr>      


            
                <?php while($row = mysqli_fetch_array($rs)){ ?>
                    <tr>

                        <td>QR ID :&emsp;</td>
                        <td><input type="text"  name="qrID" value="<?=$row['qrCodeID']?>"  readonly>
               </tr>

               <tr>
                        <td>QR Code Type:</td>
                        <td><input type="text" id="participant" name="qrcodetype" value="<?=$row['qrCodeType']?>" readonly >
  		
                    </tr>
                    <?php } ?>  

                    <tr>
                     
                        <td>Active Status:&emsp;</td>
                        <td><input type="number" name="active_status" value=""  min="0" max="1" required>*</label>1 = Active/ 0 = Deactive</td>
                        
               
                    </tr>
                
               
                    <tr>
                        <td colspan="2" style="text-align: right">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                </form>
                         
            </table>
        </div>
        <?php mysqli_close($conn); ?>
    </body>
</html>