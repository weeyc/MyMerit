<?php
    session_start();
	$CoordinatorID = $_SESSION['coordinatorID'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Program QR Code</title>

</head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/3cc6771f24.js"></script>
<div class="topnav">
<a href="../module1/Homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
</div>
</div>
<div class="startHere">

        <?php

        $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($link, "mymerit") or die(mysqli_error());

        $sql = "SELECT program.programID, program.programName,  qrcode.active_status
        FROM program, qrcode, coordinator
        WHERE program.coordinatorID = coordinator.coordinatorID AND coordinator.coordinatorID = '$CoordinatorID' AND qrcode.programID = program.programID AND qrcode.qrCodeType IN   ('Participant','Committee')  
        GROUP BY qrcode.programID 
        HAVING COUNT(DISTINCT qrcode.qrCodeType) =2";
         $rs = mysqli_query($link, $sql);


         if(isset($_POST['view'])){
            $id = $_POST['id'];
             $_SESSION['id'] = $id;
            header('Location: ./view.php');
         
        }

 
        if(isset($_POST['delete'])){
        $connect = mysqli_connect("localhost", "root", "", "mymerit");
        $id = $_POST['id'];
        $sql = "DELETE FROM qrcode
        WHERE qrcode.programID= '$id'";
        
        if(mysqli_query($connect,$sql)){
          echo '<script language="javascript">';
          echo 'alert("QR CODE delete successfully!")';

          echo '</script>';
          header('Location: ./listOfGeneratedCodeProgram.php');
          } 

         else {
          echo '<script language="javascript">';
          echo 'alert("Delete QR CODE fail!")';
          echo '</script>';
          }
      }

      
        if(isset($_POST['update'])){
            $progamID = $_POST['id'];

        
            $str="pID={$progamID}";
    ?>
            <script type="text/javascript">
                 window.location="http://localhost/mymerit/module2/updateQRcode.php?<?php echo $str;?>";
            </script>
        
       
<?php
        }

 ?>
       
        
<body>
<h3> Program QR Codes</h3>
        <center>
      
            
            <table width=100% class = "w3-table-all w3-hoverable">
                <tr>
                    <th>No.</th>
                    <th>Program ID</th>
                    <th>Program Name </th>
                    <th>Active Status</th>
                    <th>Action</th>
                </tr>
            
                <?php 
                $sr =1;    
                     while($row = mysqli_fetch_array($rs)):?>
                <tr>

                <form action="listOfGeneratedCodeProgram.php" method="post" role ="form ">
            
                    <td><?php echo $sr;?></td>
                    <td><?php echo $row['programID'];?></td>
                    <td><?php echo $row['programName'];?></td>
                    <td><?php echo $row['active_status'];?></td>
                    <?php 
                        $sr++;
                    ?>
                        
                    <td> <input type="hidden" name ="id" value="<?php echo $row['programID']; ?>">

                    <input type="submit" name="view" value="View"   class = "w3-center w3-btn w3-blue w3-small w3-round-large";>  
                        <input type="submit" name="update" value="Update"   class = "w3-center w3-btn w3-teal w3-small w3-round-large";>  
                     <input type="submit" name="delete" value="Delete"   class = "w3-center w3-btn w3-red w3-small w3-round-large";>  
                    </form> </td>

                     
                </tr>
                <?php endwhile; 
                
                
            ?>
                    
      

            </table>
  
            
            </center>
        
    </body>
</html>