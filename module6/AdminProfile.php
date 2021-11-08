<?php
session_start();
$administratorID=$_SESSION['administratorID'];

    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($link, "mymerit") or die(mysqli_error());
        $sql="SELECT * FROM administrator WHERE administratorID='$administratorID'";
        $Profile = mysqli_query($link, $sql);
        while ($row=mysqli_fetch_array($Profile)){
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrator Profile</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <div class="topnav">
        <a href="../module1/adminhomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
        <div class="topnav-right">
            <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
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
                <center><h1>Administrator Profile</h1></center>

    <div class="container">
<table border="" width="80%" cellpadding= "5" align="center">

            <tr>
                <td colspan="2"><center><b>Profile</b></center></td></th>
            </tr>

            <tr>
                <th>Administrator ID</th>
                <td><?=$row['administratorID']?></td>
            </tr>

            <tr>
                <th>Name</th>
                <td><?=$row['administratorName']?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?=$row['administratorEmail']?></td>
            </tr>

             <tr>
                <th>Telephone Number</th>
                <td><?=$row['administratorTelNo']?></td>
            </tr>
            <?php
          }
            ?>

</table>
    </div>
    <br>
    <br>
            <center><button><a href="../module1/adminhomepage.php">Back</a></button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button><a href="../module6/AdminUpdateProfile.php">Update</a></button></center>
  

</body>
</html>

