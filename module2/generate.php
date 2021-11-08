<!DOCTYPE html>
<html>
    <head>
        <title>topnav</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <style>
        body, html {
            height: 100%;
            width: 100%;
        }
        
    </style>
</head>
<body class="bg">
    <div class="topnav">
    <a href="../module1/adminHomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
    <div class="container" id="panel">
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3" style="background-color: white; padding: 20px;">
                <div class="panel-heading">
                    <h1>Generate Qr Code</h1>
                </div>
                <hr>
                <form action="show.php" method="get">
            <?php session_start();
            $connect = mysqli_connect("localhost", "root", "", "mymerit");
            $pID=$_GET['programID'];
            $query = "SELECT * FROM program WHERE program.status='approved' AND program.programID ='$pID'";
            $result = mysqli_query($connect, $query);

            while($row = mysqli_fetch_array($result))
            {

          ?>
                    <div class="row">
              <div class="col-md-6">
                <label>Program ID:</label>
                <input type="hidden" name="programID" class="form-control" value="<?=$row["programID"]?>"  />
                <input type="text" name="programID" class="form-control" value="<?=$row["programID"]?>" disabled />
              </div>
            </div>
                    <div class="row">
              <div class="col-md-6">
                <label>Program Name:</label>
                <input type="hidden" name="programName" class="form-control" value="<?=$row["programName"]?>"  />
                <input type="text" name="programName" class="form-control" value="<?=$row["programName"]?>" disabled />
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label>Program Date From:</label>
               <input type="hidden" name="programDateFrom" class="form-control" value="<?=$row["programDateFrom"]?>"  />
                <input type="text" name="programDateFrom" class="form-control" value="<?=$row["programDateFrom"]?>" disabled />
              </div>
              <div class="col-sm-6">
              <label>Program Date To:</label>
               <input type="hidden" name="programDateTo" class="form-control" value="<?=$row["programDateTo"]?>"  />
                <input type="text" name="programDateTo" class="form-control" value="<?=$row["programDateTo"]?>" disabled />
            </div>
            <br><br/>
            <div class="row">
              <div class="col-sm-6">
                <label>Program Start Time:</label>
                <input type="hidden" name="programTimeFrom" class="form-control" value="<?=$row["programTimeFrom"]?>" />
                <input type="text" name="programDateTo" class="form-control" value="<?=$row["programDateTo"]?>" disabled />
              </div>
              <div class="col-sm-6">
                <label>Program End Time:</label>
                <input type="hidden" name="programTimeTo" class="form-control" value="<?=$row["programTimeTo"]?>" />
                <input type="text" name="programTimeTo" class="form-control" value="<?=$row["programTimeTo"]?>" disabled />
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label>Location:</label>
                <input type="hidden" name="programLocation" class="form-control" value="<?=$row["programLocation"]?>" />
                <input type="text" name="programLocation" class="form-control" value="<?=$row["programLocation"]?>" disabled/>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <label>Expected participant:</label>
                <input type="hidden" name="programNumOfParticipants" class="form-control" value="<?=$row["programNumOfParticipants"]?>" />

                <input type="text" name="programNumOfParticipants" class="form-control" value="<?=$row["programNumOfParticipants"]?>" disabled/>
              </div>
            </div>
                    <br>
                    QR CODE TYPE :<br>
                    <input type="radio" name="qrcodetype" value="Participant" required>
                    <label for="participant">Participant</label><br>
                     <input type="radio" name="qrcodetype" value="Committee" required>
                    <label for="committee">Committee</label><br>
                    <input type="submit" class="btn btn-md btn-danger btn-block" value="Generate">
                <?php }?> 
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>