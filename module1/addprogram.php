<?php 
    session_start();
    $CoordinatorID = $_SESSION['coordinatorID'];

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
        <title>Add Program</title>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
             <script>
            var loadFile = function(event){
                var image = document.getElementById('imageOut');
                image.src = URL.createObjectURL(event.target.files[0]);
            };

            function displayFile(){
                var x = document.getElementById("imageprogram").files[0];
                var y = x.name;

                document.myForm.imagephoto.value = y;
            }
        </script>
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
                <i style="color: black;"></i><b>&nbsp;Add Program</b>
            </div>
            <hr class="hrthick">

            <form name="myForm" action="php_action/add.php" method="POST" enctype="multipart/form-data">
       <table>
        <tr>
            <td>Program Name:</td>
            <td><input type="text" name="programName" required></td>
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
            <td><input type="date" name="programDateFrom" size="15"></td>
            <td>Date To:</td>
            <td><input type="date" name="programDateTo" size="15"></td>
        </tr>
        <tr>
            <td>Time From:</td>
            <td><input type="time" name="programTimeFrom" size="15"></td>
            <td>Time To:</td>
            <td><input type="time" name="programTimeTo" size="15"></td>
        </tr>

        <tr>
            <td>Program Location:</td>
            <td><input type="text" name="programLocation" required></td>
        </tr>
        <tr>
            <td>Expected Number Of Participant:</td>
            <td><input type="text" name="programNumofParticipants" required></td>
        </tr>
        <tr>
            <td> Program Merit:</td>
            <td><input type="text" name="programMerit" required></td>
        </tr>
        <tr>
            <td><image id="imageOut" width="95px" height="95px" border="1px solid black" style="margin-top: 2px;"></image></td>
            <td>
            <input type="button" value="Select File" onclick="document.getElementById('imageprogram').click()">
            <input type="file" id="imageprogram" name="imageprogram" accept="image/*" onchange="loadFile(event)" style="display: none">
            </td>
            <td><input type="text" name="imagephoto" placeholder="Photo.png" size="15"></td>
             <td><input type="button" value="Upload Photo" accept="image/*" onclick="displayFile()" onchange="loadFile(event)"></td>
            </tr>
        <tr>
            <td><input type = "hidden" name="status" value="pending">
            <td><button type="submit">Submit</button></td>
            <td><a href="homepage.php"><button type="button">Back</button></a></td>
        </tr>


    </table>
            

            </form>
        </div>
    </body>
</html>