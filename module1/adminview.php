<?php 

require_once 'php_action/db_connect.php';

   session_start();
    $CoordinatorID = $_SESSION['administratorID'];

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
        <title>View Program</title>
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
                <i style="color: black;"></i><b>&nbsp;View Program</b>
            </div>
            <hr class="hrthick">
       <table>

        <tr>
            <td>Program Name:</td>
            <td><?php echo $data['programName'] ?></td>
        </tr>
        <tr>
            <td>Academic Year:</td>
            <td><?php echo $data['sem'] ?></td>
        </tr>

        <tr>
            <td>Date From:</td>
            <td><?php echo $data['programDateFrom'] ?></td>
            <td></td>
            <td></td>
            <td>Date To:</td>
            <td><?php echo $data['programDateTo'] ?></td>
            <td></td>  
        </tr>
        <tr>
            <td>Time From:</td>
            <td><?php echo $data['programTimeFrom'] ?></td>
            <td></td>
            <td></td>
            <td>Time To:</td>
            <td><?php echo $data['programTimeTo'] ?></td>
            <td></td>
        </tr>

        <tr>
            <td>Program Location:</td>
            <td><?php echo $data['programLocation'] ?></td>
        </tr>
        <tr>
            <td>Expected Number Of Participant:</td>
            <td><?php echo $data['programNumOfParticipants'] ?></td>
        </tr>
        <tr>
            <td> Total Merit For Participant:</td>
            <td><?php echo $data['programMerit'] ?></td>
        </tr>
        <tr>
        <td><image src="<?php echo $data['imageprogram']?>" width="100px" height="100px" border="1px solid black" style="margin-top: 2px; "></image></td>
        </tr>
    </table>
                <td><a href="adminapprove.php"><button type="button">Back</button></a></td>
            </form>
        </div>
    </body>
</html>
 
<?php
}
?>