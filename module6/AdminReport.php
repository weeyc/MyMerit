<?php
  $link = mysqli_connect("localhost", "root", "", "mymerit");
  $sql = "SELECT program.programName, COUNT(attendance.attendanceID) AS AttendeesNum
FROM program, attendance
WHERE attendance.programID = program.programID
GROUP BY (program.programID)";
  $rs = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Program Number Of Participant</title>

    
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['programName', 'AttendeesNum'],
      <?php        
            while($row=mysqli_fetch_assoc($rs)){
              echo "['".$row['programName']."',".$row['AttendeesNum']."],";
            }
      ?> 
      ]);

      var options = {
        title: 'Attendees Number in a program',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Number of students',
          minValue: 0
        },
        vAxis: {
          title: 'programName'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
  </script>
  </head>
  <body>   
  <div id="chart_div"></div>
  </body>

  <button><center><a href="../module1/adminhomepage.php">Back</a></center></center></button>
</html> 