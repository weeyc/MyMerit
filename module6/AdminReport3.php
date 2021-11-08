<?php
  $link = mysqli_connect("localhost", "root", "", "mymerit");
  $sql = "SELECT  merit.studentID, student.studentName, student.studentTelNo, SUM(totalMerit) AS totalMerit
      FROM merit, student
      WHERE merit.semester ='sem 2 18/19' AND merit.studentID = student.studentID 
      GROUP BY merit.studentID
       ORDER BY totalMerit desc";
  $rs = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Student Total Merit</title>

    
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

<br>
<center><h1>Student Total Merit Report In Semester 2 18/19</h1></center>
<br>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['studentID', 'totalMerit'],
      <?php        
            while($row=mysqli_fetch_assoc($rs)){
              echo "['".$row['studentID']."',".$row['totalMerit']."],";
            }
      ?> 
      ]);

      var options = {
        title: 'Student total merit',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Total Merit',
          minValue: 0
        },
        vAxis: {
          title: 'studentID'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
  </script>
  </head>
  <body>   
  <div id="chart_div"></div>

<p>Total number of student:
  <?php
  //count total student
              $query2="SELECT COUNT(*) AS total FROM student";
              $result2=mysqli_query($link,$query2);


          while($row=mysqli_fetch_assoc($result2)){
              echo "(".$row['total'].")";
            }
  ?>

</p>
<p>Total number of student involve in program:
<?php
            $query3="SELECT COUNT(*) FROM (SELECT SUM(totalMerit) AS totalMerit
        FROM merit, student
        WHERE merit.semester ='sem 2 18/19' AND merit.studentID = student.studentID
        GROUP BY merit.studentID) AS num";
            $result3=mysqli_query($link,$query3);
            while($row=mysqli_fetch_assoc($result3)){
              echo "(".$row['COUNT(*)'].")";
            }
            ?>
</p>

  <hr>

  <p><b>The student with more than 100 merit and eligible for hostel:</b>
  <?php
  //innner join table of student and merit and count for student who is eligible for hostel
              $link = mysqli_connect("localhost", "root", "", "mymerit");
              $query1="SELECT COUNT(*) FROM (SELECT SUM(totalMerit) AS totalMerit
        FROM merit, student
        WHERE merit.semester ='sem 2 18/19' AND merit.studentID = student.studentID AND totalMerit >100
        GROUP BY merit.studentID) AS num";
              $result1=mysqli_query($link,$query1);
              while($row=mysqli_fetch_assoc($result1)){
              echo "(".$row['COUNT(*)'].")";
            }
  ?>
  </p>
   <table width=100% class = "w3-table-all w3-hoverable">
    <tr>
      <th>No.</th>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Student Phone</th>
      <th>Total Merit</th>
    </tr>
    <?php 
      $link = mysqli_connect("localhost", "root", "", "mymerit");
      $query = "SELECT  merit.studentID, student.studentName, student.studentTelNo, SUM(totalMerit) AS totalMerit
      FROM merit, student
      WHERE merit.semester ='sem 2 18/19' AND merit.studentID = student.studentID 
      GROUP BY merit.studentID
      HAVING SUM(totalMerit) >100
       ORDER BY totalMerit desc";
      $result = mysqli_query($link, $query);
      $i=1;

      while($row = mysqli_fetch_array($result)){
    ?>
    <tr>
      <td><?=$i ?></td>
      <td><?=$row['studentID']?></td>
      <td><?=$row['studentName']?></td>
      <td><?=$row['studentTelNo']?></td>
      <td><?=$row['totalMerit']?></td>
    </tr>
    <?php 
    $i++;
      }
    ?>
    </table>

    <center><button><a href="../module6/searchReport.php">Back</a></button></center>
  </body>
</html>