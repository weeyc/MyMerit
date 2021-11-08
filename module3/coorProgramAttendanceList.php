<?php
    session_start();

    $coordinatorID = $_SESSION['coordinatorID'];

    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "mymerit");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Program Attendance List</title>
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
                text-align: center;
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
            <h2 style="text-decoration: underline;">Program Attendance List</h1>
            <br><br>
            <table border="1px solid black">
                <tr>
                    <th width="150"><h4>Program ID</h4></th>
                    <th width="150"><h4>Program Name</h4></th>
                    <th width="200"><h4>Total Attendances</h4></th>
                    <th width="150"><h4>Action</h4></th>
                </tr>
                <?php
                    $sqlAttendProgram = "SELECT * FROM program WHERE status = 'Approved' AND coordinatorID = '$coordinatorID'";
                    $rs = mysqli_query($conn, $sqlAttendProgram);
                    while($row = mysqli_fetch_array($rs)){
                ?>
                <form name="myForm" action="" method="POST">
                    <tr>
                        <td><input type="text" name="programID" class="noborder" value="<?=$row['programID']?>" readonly></td>
                        <td><input type="text" name="programName" class="noborder" value="<?=$row['programName']?>" readonly></td>
                        <?php
                            $pID = $row['programID'];
                            //COUNT
                            $sqlCount = "SELECT COUNT(*) as total FROM attendance WHERE programID = '$pID'";
                            $rs1 = mysqli_query($conn, $sqlCount);
                            $result = mysqli_fetch_assoc($rs1);
                            $total = $result['total'];
                        ?>
                        <td style="text-align: center;"><?=$total?></td>
                        <td style="text-align: center">
                            <button type="button" name="view" class="btn btn-default" onclick="location.href='coorViewAttendanceList.php?programID=<?=$row['programID']?>'"><i class="fa fa-eye" aria-hidden="true" style="font-size: large; color: blue;"></i></button>
                        </td>
                    </tr>
                </form>
                <?php } ?>
            </table>
        </div>
        <?php mysqli_close($conn); ?>
    </body>
</html>