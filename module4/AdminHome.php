<?php
    session_start();
    $AdminstratorID = $_SESSION['administratorID'];
?>

<!DOCTYPE html>
<!--Wee Yuu Cheng Cb18068 (4b)-->
<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <head><title>Manage Merit For Admin</title>
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
            <a href="../module1/adminHomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
  </head>

 <h2> Manage Merit For Administrator</h2>
 <table border="1" cellspacing="0" cellpadding="0"> 
	<thead>
		<tr>
		<th>Release program merit</th>
		<th>Search Student Merit</th>
		<th>Search Program Merit</th>
		</tr>
		<tr>
		<th><a href="http://localhost/mymerit/module4/Completedprogram.php"><img src="add-list.png" alt="viewprogram" style="width:200px;height:200px;"></a></p></th>
		<th><a href="http://localhost/mymerit/module4/searchMerit.php"><img src="searchstd.png" alt="programgraph" style="width:200px;height:200px;"></a></p></th>
		<th><a href="http://localhost/mymerit/module4/searchProgramMerit.php"><img src="searchPro.JFIF" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		</tr>
	</thead>
	</table>

 
  

	



</html>
