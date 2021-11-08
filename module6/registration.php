<!DOCTYPE html>
<html>
<head>
    <title>My Merit Student Registration</title>
   
        <title>topnav</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
    </head>

    <body>
        <div class="topnav">
            <a href="../module6/LoginMyMerit.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
            </div>
        </div>
    </body>

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
    <form method="post" enctype="multipart/form-data"> 
    <div class="container">
    <table>

            <tr>
                <td><h1>MyMerit Student Registration</h1></td>
            </tr>

            <tr>
            <td>User ID:</td>
                <td><input type="text" placeholder="UserID" name="user_id" required></td>
            </tr>

            <tr>
            <td>Name:</td>
                <td><input type="text" placeholder="Name" name="stdname" required></td>
            </tr>

             <tr>
            <td>Email:</td>
                <td><input type="email" placeholder="Email" name="email" required></td>
            </tr>

            <tr>
            <td>Telephone Number:</td>
                <td><input type="text" placeholder="Telephone Number" name="TelNo" required></td>
            </tr>

            <tr>
            <td>Password:</td>
                <td><input type="password" placeholder="Password" name="pass" required></td>
            </tr>

             <tr>
            <td>Photo:</td>
                <td><input type="file" name="image" required></td>
            </tr>
            

            <tr>
                <td rowspan = '2'></td>
            </tr>

            <tr>
                <td><input type="submit" name="register" value="Register" /></td>
            </tr>
    </div>
        </table>
            <p id="demo"></p>  

            </form> 
             <p><center><a href="../module6/LoginMyMerit.php">Back</a></center></p>  

</body>

<?php
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
    mysqli_select_db($link, "mymerit") or die(mysqli_error());

    if(isset($_POST['register'])){
        $user_id = $_POST['user_id'];
        $userName = $_POST['stdname'];
        $email = $_POST['email'];
        $TelNo = $_POST['TelNo'];
        $pass = $_POST['pass'];

        $name = $_FILES['image']['name'];
        $target_dir = "../module6/upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
      
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

 
             $sql = "INSERT INTO student(`studentID`, `studentName`,`studentEmail`, `studentTelNo`, `studentPassword`, `image`) VALUES ('$user_id', '$userName','$email', '$TelNo', '$pass', '$name')";
    
            $rs = mysqli_query($link, $sql);
            

            if ($rs ){
                move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name);
                header("Location: ../module6/LoginMyMerit.php");
            }
            else echo "error";

    }
    
?>

</html>