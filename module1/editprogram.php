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
        <title>Edit Program</title>
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

        <div class="box">

            <div class="user">
                <i style="color: black;"></i><b>&nbsp;Edit Program</b>
            </div>
            <hr class="hrthick">

            <form name="myForm" action="php_action/edit.php" method="POST" enctype="multipart/form-data">
       <table>
        <tr>
            <td>Program Name:</td>
            <td><input type="text" name="programName" value="<?php echo $data['programName'] ?>"></td>
        </tr>
        <tr>
            <td>Academic Year:</td>
            <td><select id="sem" name="sem">
                     <option value="sem 1 18/19">Sem 1 18/19</option>
                      <option value="sem 2 18/19">Sem 2 18/19</option>
                     <option value="sem 1 19/20">Sem 1 19/20</option>
                     <option value="sem 2 19/20">Sem 2 19/20</option>
                     <option value="sem 1 20/21">Sem 1 20/21</option>
                     <option value="sem 2 20/21">Sem 2 20/21</option>
                </select>
            </td>   
        </tr>
        <tr>
            <td>Date From:</td>
            <td><input type="date" name="programDateFrom" size="15" value="<?php echo $data['programDateFrom'] ?>"></td>
            <td>Date To:</td>
            <td><input type="date" name="programDateTo" size="15" value="<?php echo $data['programDateTo'] ?>"></td>
        </tr>
        <tr>
            <td>Time From:</td>
            <td><input type="time" name="programTimeFrom" size="15" value="<?php echo $data['programTimeFrom'] ?>"></td>
            <td>Time To:</td>
            <td><input type="time" name="programTimeTo" size="15" value="<?php echo $data['programTimeTo'] ?>"></td>
        </tr>

        <tr>
            <td>Program Location:</td>
            <td><input type="text" name="programLocation" value="<?php echo $data['programLocation'] ?>"></td>
        </tr>
        <tr>
            <td>Expected Number Of Participant:</td>
            <td><input type="text" name="programNumofParticipants" value="<?php echo $data['programNumOfParticipants'] ?>"></td>
        </tr>
        <tr>
            <td> Total Merit For Participant:</td>
            <td><input type="text" name="programMerit" value="<?php echo $data['programMerit'] ?>"></td>
        </tr>
    </table>
             <input type="hidden" name="programID" value="<?php echo $data['programID']?>" />
                <td><button type="submit">Edit</button></td>
                <td><a href="indexprogram.php"><button type="button">Back</button></a></td>
            </form>
        </div>
    </body>
</html>
 
<?php
}
?>