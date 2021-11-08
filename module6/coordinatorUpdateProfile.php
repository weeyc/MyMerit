<?php
session_start();
$coordinatorID=$_SESSION['coordinatorID'];

    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
    mysqli_select_db($link, "mymerit") or die(mysqli_error());
    
    if(isset($_POST['update'])){
        $coordinatorEmail = $_POST["coordinatorEmail"];
        $coordinatorTelNo = $_POST["coordinatorTelNo"];
        $update =  "UPDATE coordinator SET coordinatorEmail = '$coordinatorEmail', coordinatorTelNo = '$coordinatorTelNo' WHERE coordinatorID = '$coordinatorID'";
        if(mysqli_query($link,$update)){
        $message = "Profile is updated!!!";
        echo "<script type='text/javascript'>alert('$message');
              window.location ='../module6/coordinatorViewProfile.php';
              </script>";

    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>

    
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    <div class="topnav">
        <a href="../module1/homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
        <div class="topnav-right">
            <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
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
      <form action="" method="post">
        <?php
        $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
                mysqli_select_db($link, "mymerit") or die(mysqli_error());
        $sql="SELECT * FROM coordinator WHERE coordinatorID='$coordinatorID'";
        $Profile = mysqli_query($link, $sql);
        while ($row=mysqli_fetch_array($Profile)){
?>

        <table name = "updateProfile">
            <tr>
                <td><h1>Update Profile</h1></td>
            </tr>
            <tr>
                <th>Name:  </th>
                <td><input type="text" name="coordinatorName" value="<?=$row['coordinatorName']?>" readonly></td>
            </tr>

            <tr>
                <th>Coordinator ID: </th>
                <td><input type="text" name="coordinatorID" value="<?=$row['coordinatorID']?>" readonly></td>
            </tr>

            <tr>
                <td>Email: </td>
                <td><input type="email" name="coordinatorEmail" value="<?=$row['coordinatorEmail']?>"required></td>
            </tr>

            <tr>
                <td>Telephone: </td>
                <td><input type="text" name="coordinatorTelNo" value="<?=$row['coordinatorTelNo']?>"required></td>
            </tr>

              <?php
          }
            ?>

        </table>

  </div>
            <p id="demo"></p>  

            <input type="submit" name="update" value="Update" />
            <button><a href="../module6/coordinatorViewProfile.php">Cancel</a></button></center>
            </form>
</body>
</html>



