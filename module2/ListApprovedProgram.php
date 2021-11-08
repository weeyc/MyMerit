<?php

  $connect = mysqli_connect("localhost", "root", "", "qrcode");
  $sql = "SELECT * FROM qrcode";
  $rs = mysqli_query($connect, $sql);
  if (isset($_POST['submit'])) {
            
              $search = $_POST['search'];
              $query = "SELECT program.programID, programName, programLocation FROM program WHERE program.status='approved' AND programName='$search'";
              $result = mysqli_query($connect, $query);
            
          }
          else{
            $query = "SELECT program.programID, programName, programLocation FROM program WHERE program.status='approved'";
              $result = mysqli_query($connect, $query);
          }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>List Approved Program</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <style>
      body {
        text-align: center;
      }
    }
    </style>
  </head>
  <body>
    <div class="topnav">
            <a href="../module1/adminhomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
    <div class="container">
      <div class="page-header">
        <h2>List Approved Event</h2>
      </div> 
      <form action="" method="POST"> 
       Total:
       <?php
              
          $query="SELECT COUNT(*) AS total FROM qrcode ";
          $result=mysqli_query($connect,$query);
          while($row=mysqli_fetch_assoc($result)){
              echo "(".$row['total'].")";
            }
              ?>
        <div>
          <a href="Analysis.php" name="analysis" class="btn btn-primary">Analysis</a>
        </div>
        <div style="margin-left: : 90%">
        <input type="text" name="search" placeholder="Search">
        <button type="submit" name="submit" class="btn btn-primary">Search</button>
        <button type="submit" name="back" class="btn btn-warning" onclick windows location=".ListApprovedProgram.php" class="btn btn-default">Back</button>
        </div>
        
        <table class="table table-bordered">
          <tr>
            <th>No</th>
            <th>Program Name</th>
            <th>Program Location</th>
            <th>QR Code</th>
            <!--<th>Action</th>-->
          </tr>    

          <tr>
            <?php

            while($row = mysqli_fetch_array($result))
            {
              $i=1;
              echo "hi";
          ?>
            
            <td><?php echo $row["programID"]?></td>
            <td><?php echo $row["programName"]?></td>
            <td><?php echo $row["programLocation"]?></td>
            

            <!--<form action="" method="POST"> -->
            <td><a href="./generate.php?programID=<?=$row['programID']?>" class="btn btn-primary" name="generate">Generate</a>
              <a href="./view.php?programID=<?=$row['programID']?>" class="btn btn-primary" name="View">View</a></td>
         <!--   <td>  
              <input type="hidden" name="programID" value="<?php //$row["programID"]?>">
              <button type="button" name="update" class="btn btn-warning bt-xs update" onclick="window.location.href='update.php?programID=<?php //$_SESSION['programID']?>'">Change</button>
              <button type="submit" name="delete" class="btn btn-danger bt-xs delete">Remove</button>
            </form></td>-->
       
            
            <?php 
              }
            ?>
          </tr>
    </div>
  </table>
</form>
</div>

    <?php
   

      if(isset($_POST['delete'])){
        $connect = mysqli_connect("localhost", "root", "", "mymerit");
        $sql = "DELETE FROM `qrcode` WHERE `qrcodeID` = '$qrcodeID'";
        
        if(mysqli_query($connect,$sql)){
          echo '<script language="javascript">';
          echo 'alert("QR CODE delete successfully!")';
          echo '</script>';
          } 

         else {
          echo '<script language="javascript">';
          echo 'alert("Delete QR CODE fail!")';
          echo '</script>';
          }
      }
    ?>
  </body>
</html>
