<?php
    session_start();

    $coordinatorID = $_SESSION['coordinatorID'];
    $programID = $_GET['programID'];
    $_SESSION['programID'] = $programID;


    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "mymerit");

    $sqlAttendStudent = "SELECT * FROM attendance INNER JOIN program on attendance.programID = program.programID WHERE attendance.programID = '$programID' AND program.coordinatorID = '$coordinatorID' ORDER BY attendance.identity1 ASC, attendance.studentID ASC, attendance.attend DESC";
    $rs = mysqli_query($conn, $sqlAttendStudent);

    if(isset($_POST['searchBtn'])){
        if(!(is_null($_POST['search']))){   
            $search = $_POST['search'];
            $sqlSearch = "SELECT * FROM attendance INNER JOIN program on attendance.programID = program.programID WHERE attendance.programID = '$programID' AND attendance.studentID LIKE '%$search%' ORDER BY attendance.identity1 ASC";
            $rs = mysqli_query($conn, $sqlSearch);
        }
        else{
            echo "<script language='javascript'>";
            echo "window.location = './coorViewAttendanceList.php';";
            echo "</script>";
        }
    }

    if(isset($_POST['delete'])){
        $del = $_POST['attendanceID'];
        $sqlDelete = "DELETE FROM attendance WHERE attendanceID = '$del'";
        if(mysqli_query($conn, $sqlDelete)){
            echo "<script language='javascript'>";
            echo "window.location = './coorViewAttendanceList.php?programID=".$_POST['programID']."';";
            echo "alert ('Successful Delete!!!')";
            echo "</script>";
        }
    }

    //COUNT Committee
    $sqlCountC = "SELECT COUNT(*) as totalC FROM attendance WHERE identity1 = 'Committee' AND attend = '1' AND programID = '$programID'";
    $countC = mysqli_query($conn, $sqlCountC);
    $resultC = mysqli_fetch_assoc($countC);
    $totalC = $resultC['totalC'];

    //COUNT Participant
    $sqlCountP = "SELECT COUNT(*) as totalP FROM attendance WHERE identity1 = 'Participant' AND attend = '1' AND programID = '$programID'";
    $countP = mysqli_query($conn, $sqlCountP);
    $resultP = mysqli_fetch_assoc($countP);
    $totalP = $resultP['totalP'];
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
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Identity', 'Quantity'],
                    ['Committee', parseInt('<?php echo $totalC ?>')],
                    ['Participant', parseInt('<?php echo $totalP ?>')]
                ]);

                var options = {
                    title: 'Percentage of Number of Participants & Committees',
                    //set to 3D
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                chart.draw(data, options);
            }
        </script>

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
            <h2 style="text-decoration: underline;">Attendance List</h2>
            <br>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td colspan="6" width="950" style="text-align: right;">
                            <input type="hidden" name="programID" value="<?=$programID?>">
                            Search:
                            <input type="text" name="search" placeholder="Student ID">&emsp;
                            <input type="submit" name="searchBtn" value="Search">
                            <br><br>
                        </td>
                    </tr>
                </table>
            </form>
            <table border="1px solid black">
                <tr>                    
                    <th width="150"><h4>Program ID</h4></th>
                    <th width="200"><h4>Program Name</h4></th>
                    <th width="150"><h4>Identity</h4></th>
                    <th width="150"><h4>Student ID</h4></th>
                    <th width="150"><h4>Attendance</h4></th>
                    <th width="150"><h4>Action</h4></th>
                </tr>
                <?php
                    while($row = mysqli_fetch_array($rs)){
                ?>
                <form name="myForm" action="" method="POST">
                    <tr>                      
                        <td><input type="text" name="programID" class="noborder" value="<?=$row['programID']?>" readonly></td>
                        <td><input type="text" name="programName" class="noborder" value="<?=$row['programName']?>" readonly></td>
                        <td><input type="text" name="identity1" class="noborder" value="<?=$row['identity1']?>" readonly></td>
                        <td><input type="text" name="studentID" class="noborder" value="<?=$row['studentID']?>" readonly></td>
                        <?php
                            $programID = $row['attend'];
                            if($row['attend'] == 1){
                                $attend = "Yes";
                            }
                            else{
                                $attend = "No";
                            }
                        ?>
                        <td><input type="text" name="attend" class="noborder" value="<?=$attend?>" readonly></td>
                        <td style="text-align: center">
                            <input type="hidden" name="attendanceID" value="<?=$row['attendanceID']?>">
                            <button type="button" name="update" class="btn btn-default" onclick="location.href='coorViewAttendanceStudent.php?studentID=<?=$row['studentID']?>'"><i class="fa fa-pencil-square" aria-hidden="true" style="font-size: large; color: blue;"></i></button>&emsp;
                            <button type="submit" name="delete" class="btn btn-default" onclick="return confirm('Are you sure to delete?');"><i class="fa fa-trash" aria-hidden="true" style="font-size: large; color: red;"></i></i></button>
                        </td>
                    </tr>
                </form>
                <?php } ?>
            </table>
            <div id="piechart_3d" style="width: 900px; height: 500px; margin: 0 auto;"></div>
        </div>
        <?php mysqli_close($conn); ?>
    </body>
</html>