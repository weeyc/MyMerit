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
        <title>Remove Member</title>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    
</head>
<body>
	<div class="topnav">
            <a href="homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
 
<h3>Do you really want to remove ?</h3>
<form action="php_action/remove.php" method="post">
 
    <input type="hidden" name="programID" value="<?php echo $data['programID'] ?>" />
    <button type="submit">Yes</button>
    <a href="indexprogram.php"><button type="button">Back</button></a>
</form>
 
</body>
</html>
 
<?php
}
?>