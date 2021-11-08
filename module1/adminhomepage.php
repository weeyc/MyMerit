<?php
	session_start();
	$AdminstratorID = $_SESSION['administratorID'];
	?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
	 <link rel="stylesheet" type="text/css" href="sidenav.css">
 	 <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
 	<title>Admin Home Page </title>
</head>
<body>
	 <div class="topnav">
            <a href="adminhomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
               <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
  <div class="startHere">
		<h1>Admin Home Page</h1>
		<table border="1" cellspacing="0" cellpadding="0"> 
	<thead>
		<tr>
		<th>View Program</th>
		<th>Report</th>
		<th>Generate QR Code</th>
		<th>QR Module Report</th>
		<th>Manage Merit</th>
		</tr>
		<tr>
		<td><a href="adminapprove.php"><img src="view.png" alt="viewprogram" style="width:200px;height:200px;"></a></p></td>
		<th><a href="graphsem.php"><img src="piechart.png" alt="programgraph" style="width:200px;height:200px;"></a></p></th>
		<th><a href="../module2/1.php"><img src="qrcode.png" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		<th><a href="../module2/Analysis.php"><img src="qrGraph.JPG" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		<th><a href="../module4/AdminHome.php"><img src="merit.png" alt="programgraph" style="width:200px;height:200px;"></a></p></th>		
		</tr>
	</thead>
	</table>


	<table border="1" cellspacing="0" cellpadding="0"> 
	<thead>
		<tr>
		<th>Programs Attendees Report</th>
		<th>Student Merit Report</th>
		<th>Delete Student Account</th>
		<th>Delete Coordinator Account</th>
		</tr>
		<tr>
		<th><a href="../module6/AdminReport.php"><img src="attendees.JFIF" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		<th><a href="../module6/searchReport.php"><img src="100.png" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		<th><a href="../module6/deleteStdProfile.php"><img src="deleteStdAcc.png" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		<th><a href="../module6/deleteCoordinatorProfile.php"><img src="deleteCoor.JFIF" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	


	
		</tr>
	</thead>
	</table>
	</div>
</body>
</html>
