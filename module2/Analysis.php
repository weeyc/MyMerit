<?php
  $connect = mysqli_connect("localhost", "root", "", "mymerit");
  $sql = "SELECT * FROM qrcode";

  $sql = "SELECT programLocation,COUNT(programLocation) AS Nooflocation
   FROM program
  WHERE  status = 'approved'
  GROUP BY programLocation";
  $rs = mysqli_query($connect, $sql);


?>
<!DOCTYPE html>
<html>
    <head>
        <title>List Approved Program</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['programName','programNumOfParticipants'],
          <?php 
          $query = "SELECT * FROM program";
            $result = mysqli_query($connect, $query);
       
            while($row=mysqli_fetch_assoc($result)){
              echo "['".$row['programName']."',".$row['programNumOfParticipants']."],";
            }
          ?> 
        ]);
        var options = {
          width: 800,
          legend: { position: 'none' },
          chart: {
            title: 'programNumOfParticipants',
            subtitle: '' },
          axes: {
            x: {
              0: { side: 'top', label: 'programNumOfParticipants'} // Top x-axis.
            }
          },
          bar: { groupWidth: "50%" }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['programLocation', 'Nooflocation'],
   
            <?php 
             while($result = mysqli_fetch_assoc($rs)){
                 echo"['".$result['programLocation']."',".$result['Nooflocation']."],";
             }
            ?>


        ]);

        var options = {
          width: 800,
          legend: { position: 'none' },
          chart: {
            title: 'Program Location ',
            subtitle: '' },
          axes: {
            x: {
              0: { side: 'top', label: 'programLocation'} // Top x-axis.
            }
          },
          bar: { groupWidth: "50%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
  </head>
  <body>
     <div class="topnav">
            <a href="../module1/adminhomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
          <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
       
          <div id="top_x_div" style="width: 800px; height: 600px;"></div>
        </div>
  </body>
  </html>