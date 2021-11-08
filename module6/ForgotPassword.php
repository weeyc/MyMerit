
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password For Student</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <div class="topnav">
        <a href="../module6/LoginMyMerit.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
        <div class="topnav-right">
        </div>
    </div>
    <div class="startHere">


<style>
    /* Style all input fields */
    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
    }
    
    /* Style the container for inputs */
    .container {
      background-color: #bdd7ee;
      padding: 20px;
      margin-top: 50px;
      margin-right: auto;
      margin-left: auto;
    }

    </style>
<body>

    <div class="container">
    <form name="reset" action="" method="POST">
        <table>

            <tr>
                <td><h1>Forgot Password</h1></td>
            </tr>

            <tr>
            <td>User ID:</td>
                <td><input type="text" placeholder="User ID" name="studentID" required></td>
            </tr>

            <tr>
            <td>Username:</td>
                <td><input type="text" placeholder="Username" name="studentName" required></td>
            </tr>

            <tr>
            <td>Email:</td>
                <td><input type="email" placeholder="Email" name="studentEmail" required></td>
            </tr>

            <tr>
                <td>Telephone Number:</td>
                    <td><input type="Telephone" placeholder="Telephone number" name="studentTelNo" required></td>
                </tr>

            <tr>
                <td>New Password:</td>
                    <td><input type="password" name="studentPassword" placeholder="New Password" required></td>
                </tr>

           

            <tr>
                <td rowspan = '2'></td>
            </tr>

            <tr>
                <td><input type="submit" value="Reset" name="reset"/></td>
            </tr>
            
    </div>
        </table>
            <p id="demo"></p>  

            <p><center><a href="../module6/LoginMyMerit.php">Return to login</a></center></p>


</body>
</html>

<?php
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
    mysqli_select_db($link, "mymerit") or die(mysqli_error());
    
    if(isset($_POST['reset'])){
        $studentID = $_POST["studentID"];
        $userName = $_POST["studentName"];
        $studentEmail = $_POST["studentEmail"];
        $studentTelNo = $_POST["studentTelNo"];
        $studentPassword = $_REQUEST["studentPassword"];
        $update = "UPDATE student SET studentPassword='$_POST[studentPassword]' WHERE studentID='$studentID'";
        $updated = mysqli_query($link, $update);
        $message = "Password is reset!!!";
        echo "<script type='text/javascript'>alert('$message');
              window.location ='../module6/LoginMyMerit.php';
              </script>";

    }

?>