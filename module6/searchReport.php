<?php
    session_start();
    $administratorID = $_SESSION['administratorID'];
?>
<!DOCTYPE html>
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
            <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
</div>
</head>
<br>
<center>
<form action="" method="post">

            <p>Select Semester:</p>  
            <select id="role" name="sem">
            
                <option value="sem 1 18/19" selected>Sem 1 18/19</option>
                <option value="sem 2 18/19">Sem 2 18/19</option>
            </select>
            <input type="submit" name="semester" value="submit"><br>
<?php
if (isset($_POST['semester'])){
    $report = $_POST['sem'];

    if ($report == "sem 1 18/19"){
    echo "<script> window.location ='../module6/AdminReport2.php';
            </script>";
        }
    else
    {
        echo "<script> window.location ='../module6/AdminReport3.php';
            </script>";
    }

        }
?>
</form>
</center>
</html>
