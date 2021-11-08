<!DOCTYPE html>
<!--Wee Yuu Cheng Cb18068 (4b)-->
<html>
<head>
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
            </div>
        </div>
        <div class="startHere">

<title>Release Merit</title>

<?php

$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "mymerit") or die(mysqli_error());

$proID = $_GET['proID'];
$proName=$_GET['proName'];


?>




<?php

	//SQL query
	$Query = "INSERT INTO merit (semester,studentID,attendanceID,programID,merit,position,positionMerit,totalMerit,prove,approval_status)
	
	SELECT  program.sem, student.studentID, attendance.attendanceID,program.programID,program.programMerit,
	(CASE WHEN qrcode.qrCodeType = 'Committee' THEN
				(CASE WHEN committee.commiteePosition = 'Program chair' THEN 'Program chair'
				WHEN committee.commiteePosition = 'Program co-chair' THEN 'Program co-chair'    	
				WHEN committee.commiteePosition = 'Main committee' THEN 'Main committee'
				WHEN committee.commiteePosition = 'Sub committee' THEN 'Sub committee' 	
				END)
		WHEN qrcode.qrCodeType = 'Participant' THEN 'Participant'
	END),
	(CASE WHEN qrcode.qrCodeType = 'Committee' THEN
				(CASE WHEN committee.commiteePosition = 'Program chair' THEN (500)
				WHEN committee.commiteePosition = 'Program co-chair'
					THEN (450)
				WHEN committee.commiteePosition = 'Main committee'
					THEN (300)
				WHEN committee.commiteePosition = 'Sub committee'
					THEN (200)
				END)
		WHEN qrcode.qrCodeType = 'Participant' THEN (30)
	END),
	(CASE WHEN qrcode.qrCodeType = 'Committee' THEN
				(CASE WHEN committee.commiteePosition = 'Program chair' THEN (500 + program.programMerit)
				WHEN committee.commiteePosition = 'Program co-chair'
					THEN (450 + program.programMerit)
				WHEN committee.commiteePosition = 'Main committee'
					THEN (300+ program.programMerit)
				WHEN committee.commiteePosition = 'Sub committee'
					THEN (200+ program.programMerit)
				END)
		WHEN qrcode.qrCodeType = 'Participant' THEN (30+ program.programMerit)
	END),NULL,'denied'
	FROM (committee RIGHT OUTER JOIN  student ON committee.studentID = student.studentID ), program, attendance, qrcode
	WHERE attendance.qrCodeID = qrcode.qrCodeID AND attendance.studentID=student.studentID AND qrcode.programID = program.programID AND  program.programID ='$proID' GROUP BY student.studentID" 	or die(mysqli_connect_error());

$result = mysqli_query($link, $Query);
 
			if($result) 
            {                					
?>					
				<script type="text/javascript">
						var progID = "<?php echo $proID ?>";
						var progName = "<?php echo $proName ?>";
								var x = progID;
								var y = progName;
									
								 alert("Program Merit for: " +x+" " + y + " is Released!");
									
									window.location = "http://localhost/mymerit/module4/Completedprogram.php";
								
			
					</script>
<?php						
			}
			else 
				{
					die("Merit release is failed"); 
				}
?>


</table>


</html>
