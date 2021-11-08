<?php
    session_start();

    $coordinatorID = $_SESSION['coordinatorID'];
    $studentID = $_GET['studentID'];
    $programID = $_SESSION['programID'];

    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "mymerit");

    if(isset($_POST['update'])){
        $identity1 = $_POST['identity1'];
        $attend = $_POST['attend'];
        $sqlUpdate = "UPDATE attendance SET identity1 = '$identity1', attend = '$attend' WHERE studentID = '$studentID'";
        if(mysqli_query($conn, $sqlUpdate)){
            echo "<script language='javascript'>";
            echo "window.location = './coorViewAttendanceList.php?programID=".$_POST['programID']."';";
            echo "</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Attendance List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
        <style>
            h4 {
                font-weight: bold;
            }

            td {
                padding-top: 10px;
                padding-bottom: 10px;
            }

            th {
                text-align: center;
            }

            .noborder {
                border: none;
            }
        </style>
    </head>

    <body>
        <div class="topnav">
            <a href="../module1/homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
            <h2 style="text-decoration: underline;">Student Attendance Details</h2>
            <br>
            <table>
                <?php
                    $sqlResult = "SELECT * FROM attendance INNER JOIN program on attendance.programID = program.programID WHERE attendance.studentID = '$studentID' AND attendance.programID = '$programID' ORDER BY attendance.studentID ASC";
                    $rs = mysqli_query($conn, $sqlResult);
                    while($row = mysqli_fetch_array($rs)){
                ?>
                <form name="myForm" action="" method="POST">
                    <tr>
                        <td>Program ID:&emsp;</td>
                        <td><input type="text" name="programID" value="<?=$row['programID']?>" class="noborder" readonly></td>
                    </tr>
                    <tr>
                        <td>Program Name:&emsp;&emsp;&emsp;</td>
                        <td><input type="text" name="programName" value="<?=$row['programName']?>" class="noborder" readonly></td>
                    </tr>
                    <tr>
                        <td>StudentID:&emsp;</td>
                        <td><input type="text" name="studentID" value="<?=$row['studentID']?>" class="noborder" readonly></td>
                    </tr>
                    <tr>
                        <td>Identity:&emsp;</td>
                        <td><input type="text" name="identity1" value="<?=$row['identity1']?>">&nbsp;<label style="color: red">*</label>Committee/Participant</td>
                    </tr>
                    <tr>
                        <td>Attendance:&emsp;</td>
                        <td><input type="text" name="attend" value="<?=$row['attend']?>">&nbsp;<label style="color: red">*</label>1 = Attend/ 0 = Absent</td>
                    </tr>
                    <tr>
                        <td>Image:&emsp;</td>
                        <td><image src="<?=$row['image']?>" width="95px" height="95px" border="1px solid black" style="margin-top: 2px; "></image></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right">
                            <input type="hidden" name="attendanceID" value="<?=$row['attendanceID']?>">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                </form>
                <?php } ?>               
            </table>
        </div>
        <?php mysqli_close($conn); ?>
    </body>
</html>