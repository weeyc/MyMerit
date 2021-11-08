<?php 
 
require_once 'php_action/db_connect.php';
 
if($_GET['programID']) {
    $programID = $_GET['programID'];
 
    $sql = "SELECT * FROM program WHERE programID = {$programID}";
    $result = $connect->query($sql);
 
    $data = $result->fetch_assoc();
 
    $connect->close();
 
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
        <title> Approval Confirmation</title>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    </head>

    <body>
        <div class="topnav">
            <a href="adminhomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>

        <div class="box">

            <div class="user">
                <i style="color: black;"></i><b>&nbsp;Confirmation</b>
            </div>
            <hr class="hrthick">

            <form name="myForm" action="php_action/accept.php" method="POST" enctype="multipart/form-data">
            <table>
            	<tr>
            		<td>Do You Want Approve This Program?</td>
            		<td> <input type="hidden" name="programID" value="<?php echo $data['programID']?>" /></td>
                	<td><button type="submit">Approve</button></td>
                	<td><a href="adminapprove.php"><button type="button">Back</button></a></td>
				</tr>
			</table>
        </form>
    </div>
</body>
</html>
<?php
}
?>