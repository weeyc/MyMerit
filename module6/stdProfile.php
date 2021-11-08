<?php
session_start();
$studentID=$_SESSION['studentID'];

    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($link, "mymerit") or die(mysqli_error());
        $sql="SELECT * FROM student WHERE studentID='$studentID'";
        $Profile = mysqli_query($link, $sql);
        while ($row=mysqli_fetch_array($Profile)){

        
            $image = $row['image'];
            $image_src = "../module6/upload/".$image;
  
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <div class="topnav">
        <a href="../module4/stdDash.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
        <div class="topnav-right">
            <a href="../module6/stdProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
        </div>
    </div>
    <div class="startHere">

<style>
    /* Style all input fields */
    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
    }
    
    /* Style the container for inputs */
    .container {
      background-color: #bdd7ee;
      padding: 20px;
      margin-top: 50px;
      margin-right: auto;
      margin-left: auto;
    }

    </style>
<body>

                <center><h1>Student Profile</h1></center>

    <div class="container">
<table border="" width="80%" cellpadding= "5" align="center">

            <tr>
                <td rowspan="10" width="25%"><center><img src='<?php echo $image_src;?>'  style="width: 200px; height: 250px;"></center></td>
            </tr>

            <tr>
                <td colspan="3"><center><b>Profile</b></center></td></th>
            </tr>

            <tr>
                <th>Name</th>
                <td><?=$row['studentName']?></td>
            </tr>

            <tr>
                <th>Student ID</th>
                <td><?=$row['studentID']?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?=$row['studentEmail']?></td>
            </tr>

            <tr>
                <th>Telephone Number</th>
                <td><?=$row['studentTelNo']?></td>
            </tr>

            <?php
          }
            ?>

</table>
    </div>
    <br>
    <br>
            <center><button><a href="../module4/stdDash.php">Back</a></button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button><a href="../module6/updateStdProfile.php">Update</a></button></center>
  

</body>
</html>

