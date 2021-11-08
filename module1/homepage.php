<?php
	session_start();
	$CoordinatorID = $_SESSION['coordinatorID'];
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
 	<title>Coordinator Home Page </title>
</head>
<body>
	 <div class="topnav">
            <a href="homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                 <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>            </div>
        </div>
  <div class="startHere">
		<h1>Coordinator Home Page</h1>
		<table border="1" cellspacing="0" cellpadding="0"> 
	<thead>
		<tr>
		<th>Add Program</th>
		<th>View Program</th>
		<th>Report for Month of Program</th>
		<th>List of Approval Program QR Code</th>
		<th>List of Program Attendance</th>
		<th>Claim Merit Approval</th>
	
		</tr>
		<tr>
		<th><a href="addprogram.php"><img src="add.png" alt="addprogram" style="width:200px;height:200px;"></a></p></th>
		<th><a href="indexprogram.php"><img src="view.png" alt="viewprogram" style="width:200px;height:200px;"></a></p></th>
		<th><a href="monthgraph.php"><img src="piechart.png" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		<th><a href="../module2/listOfGeneratedCodeProgram.php"><img src="qr-code.png" alt="approvalprogram" style="width:200px;height:200px;"></a></p></th>
		<th><a href="../module3/coorProgramAttendanceList.php?coordinatorID=<?=$_SESSION['coordinatorID']?>"><img src="att.png" alt="programattendance" style="width:200px;height:200px;"></a></p></th>
		<th><a href="../module4/coordinatorProgramMeritClaimList.php"><img src="approveClaim.JFIF" alt="programgraph" style="width:200px;height:200px;"></a></p></th>	
		</tr>
	</thead>
	</table>
	</div>
</body>
</html>
