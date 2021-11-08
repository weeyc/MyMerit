<?php
    session_start();
    $ID = $_SESSION['coordinatorID'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><title>Coordinator dashboard</title>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style2.css">
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
            <a href="coordinatorManageMerit.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="#userProfile"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="logout.php" style="margin-right: 5px;"><img src="ExternalImage/logout.jpeg" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;"></a>
            </div>
        </div>
        <div class="startHere">
  </head>

  <body>

  <div class="middle">
    <div class="counting-sec">
      <div class="inner-width">
        <div class="col">
 
<?php
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "tmerit") or die(mysqli_error());


?> 

        <div class="col">
          <i class="fa fa-id-card"></i>
          <div class="num">
          <?php
$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "tmerit") or die(mysqli_error());

$query = "SELECT COUNT(program.coordinatorID)
FROM program, coordinator, student
WHERE program.coordinatorID = coordinator.id AND coordinator.studentID = student.studentID AND coordinator.studentID ='$ID'";
$result = mysqli_query($link, $query);


$pr = mysqli_fetch_assoc($result);
            
echo $pr['COUNT(program.coordinatorID)'];

?> 
</div>
Program I Coordinate
</div>




  </script>


  </body>
</html>
