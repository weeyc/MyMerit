<?php
    session_start();

    $id = $_SESSION['id'];

    $conn = mysqli_connect("localhost", "root", "");
    if(!$conn){
        die("Could not connect to the database server: " .mysqli_connect_error());
    }
    mysqli_select_db($conn, "mymerit");


    //COUNT Committee
    $sqlCountC = "SELECT COUNT(*) as totalC FROM attendance WHERE identity1 = 'Committee' AND programID = '$id'";
    $countC = mysqli_query($conn, $sqlCountC);
    $resultC = mysqli_fetch_assoc($countC);
    $totalC = $resultC['totalC'];

    //COUNT Participant
    $sqlCountP = "SELECT COUNT(*) as totalP FROM attendance WHERE identity1 = 'Participant' AND programID = '$id'";
    $countP = mysqli_query($conn, $sqlCountP);
    $resultP = mysqli_fetch_assoc($countP);
    $totalP = $resultP['totalP'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Attendance</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

        // Load the Visualization API and the piechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table, 
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
            ['Identity', 'Person', { role: 'style' }],
            ['Committee', <?php echo $totalC ?>, 'red'],     
            ['Participant', <?php echo $totalP ?>, 'blue']
        ]);

        // Set chart options
        var barchart_options  = {   
                                    'title':'Number of Participants and Committee Attenndances',
                                    'width':550,
                                    'height':450,
                                    legend: 'none'
                                };

        // Instantiate and draw our chart, passing in some options.
        var barchart  = new google.visualization.BarChart(document.getElementById('barchart_div'));
        barchart.draw(data, barchart_options);
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
        <div class="startHere" style="text-align: center; margin-top: 5%;">
            <h1>Your attendance has been submitted successfully!</h1><br><br>
            <a href="../module2/view.php" style="text-decoration: underline; font-size: large;">Submit another response</a>
            <br><br>
            <button class="btn btn-primary"><a href="../module1/homepage.php" style="text-decoration: none; color: white;">EXIT</a></button>
        </div>
        <br>
        <div id="barchart_div" align="center"></div>
        <?php mysqli_close($conn); ?>
    </body>
</html>