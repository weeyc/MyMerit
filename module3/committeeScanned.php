<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "mymerit");

    $programID = $_GET['programID'];
    $qrCodeID = $_GET['qrCodeID'];

    $identity1 = "Committee";

    if(isset($_POST['submit'])){
        $id = $_POST['studID'];
        $password = $_POST['studPassword'];
        $sqlStudent = "SELECT studentID, studentPassword FROM student WHERE studentID = '$id' AND studentPassword = '$password'";
        $result = mysqli_query($conn, $sqlStudent);
        $record = mysqli_num_rows($result);

        if($record == 1){
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            $ipAddress = $_POST['ipaddress'];
            $attend = $_POST['attend'];
            $studID = $id;

            $image = $_FILES['image']['name'];
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            // Identity file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Validate file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                // Convert to base64
                $image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']) );
                $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
            }
            
            $sqlAdd = "INSERT INTO attendance (latitude, longitude, attendanceIPAddress, attend, identity1, studentID, programID, qrCodeID, image) VALUES ('$latitude', '$longitude', '$ipAddress', '$attend', '$identity1', '$studID', '$programID', '$qrCodeID', '$image')";
            if(mysqli_query($conn, $sqlAdd)){
                $_SESSION['id'] =  $programID;
                header('Location: ./successfulScan.php');
            }
        }
        else{
            echo "<script language='javascript'>";
            echo "alert ('Incorrect ID or Password!!!')";
            echo "</script>";
        }
    }

    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    $ip = getUserIpAddr();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Committee Attendance</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
        <style>
            h3 {
                padding-top: 10px;
                text-decoration: underline;
            }

            td {
                padding-top: 10px;
            }
        </style>
        <script>
            var loadFile = function(event){
                var image = document.getElementById('imageOut');
                image.src = URL.createObjectURL(event.target.files[0]);
            };
        </script>
    </head>

    <body onload="getLocation()">
        <div class="topnav">
            <a href="../module1/homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            </div>
        </div>
        <div class="startHere">
            <h2 style="text-decoration: underline;">Committee's Attendance</h1>
            <h3>Program Description</h3>
            <?php
                $sqlProgram = "SELECT * FROM program WHERE programID = '$programID'";
                $rs = mysqli_query($conn, $sqlProgram);
                while($row = mysqli_fetch_array($rs)){
            ?>
            <table>
                <tr>
                    <td>Program ID:&emsp;</td>
                    <td><?=$row['programID']?></td>
                </tr>
                <tr>
                    <td>Program Name:&emsp;</td>
                    <td><?=$row['programName']?></td>
                </tr>
            </table>
            <?php } ?>
            
            <form name="myForm" action="" method="POST" enctype="multipart/form-data">
                <table>
                    <th><h3>Attendance Description</h3></th>
                    <tr>
                        <td>Geolocation:&emsp;</td>
                        <td><input type="text" name="latitude" size="25" readonly><label style="color: red;">&nbsp;*</label>Latitude</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="text" name="longitude" size="25" readonly><label style="color: red;">&nbsp;*</label>Longitude</td>
                    </tr>
                    <tr>
                        <td><br>IP Address:&emsp;</td>
                        <td>
                            <br>
                            <input type="text" name="ipaddress" value="<?=$ip?>" size="25" readonly>
                            <input type="hidden" name="attend" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td>Image:&emsp;</td>
                        <td><input type="file" id="image" name="image" accept="image/*" onchange="loadFile(event)" required>&nbsp;</td>
                        <td> <image id="imageOut" width="150px" height="150px" border="1px solid black" style="margin-top: 2px;"></image></td>
                    <tr>
                
                    <th><h3 style="padding-top: 30px;">Committee Attendance Submission</h3></th>
                    <tr>
                        <td>ID:</td>
                        <td><input type="text" name="studID" size="25"></td>
                    </tr>
                    <tr>
                        <td>Password:&emsp;&emsp;</td>
                        <td><input type="password" name="studPassword" id="pwd" size="25"></td>
                    </tr>
                    <tr>
                        <td></td>                            
                        <td><input type="checkbox" onclick="myFunction()">Show Password</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right;"><button type="submit" name="submit" class="btn btn-primary">Submit</button><td>
                    </tr>
                </table>
                
            </form>
        
            <script>
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    }
                }
        
                function showPosition(position) {
                    document.myForm.latitude.value = position.coords.latitude;
                    document.myForm.longitude.value = position.coords.longitude;
                }
        
                function myFunction() {
                    var x = document.getElementById("pwd");
                    if (x.type === "password") {
                        x.type = "text";
                    }
                    else {
                        x.type = "password";
                    }
                }
            </script>
        </div>
        <?php mysqli_close($conn); ?>
    </body>
</html>