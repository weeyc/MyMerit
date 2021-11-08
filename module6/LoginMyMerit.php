<!DOCTYPE html>
<html>
<head>
    <title>My Merit Login</title>
   
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
            <a style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">MY MERIT</label></a>
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
    <form method="post"> 
    <div class="container">
    <table name = "login">
        <table name = "login">

            <tr>
                <td><h1>MyMerit Login</h1></td>
            </tr>

            <tr>
            <td>User ID:</td>
                <td><input type="text" placeholder="UserID" name="name" required></td>
            </tr>

           
            <tr>
            <td>Password:</td>
                <td><input type="password" placeholder="Password" name="pass" required></td>
            </tr>

            <tr>
            <td>Login as:</td>
            <td>
                <select id="role" name="role">
                <option value="administrator">Administrator</option>
                <option value="coordinator">Coordinator</option>
                <option value="student">Student</option>
                </select>
            </td>
            </tr>

            <tr>
                <td rowspan = '2'></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="Login" /></td>
            </tr>
    </div>
        </table>
            <p id="demo"></p>  

            <p><center><a href="../module6/ForgotPassword.php">Forgot password&nbsp|&nbsp<a href="../module6/registration.php">Register</a></center></p>
      
            </form> 

</body>

<?php
    $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
    mysqli_select_db($link, "mymerit") or die(mysqli_error());

    if(isset($_POST['submit'])){

        session_start();
 

        $userID = $_POST['name'];
        $pas = $_POST['pass'];
        $table = $_POST['role'];

        if ($table == 'administrator'){
            $query = "SELECT * FROM $table";
            $result = mysqli_query($link, $query); 

               
            while($row = mysqli_fetch_array($result)){
                $id =$row['administratorID'];
                $pass = $row['administratorPassword'];
                $name = $row['administratorName'];

                if($userID!=$id  || $pas != $pass){
                    echo "User or password not correct";
                }
                else{
                        $_SESSION['administratorID'] = $id;
                        $_SESSION['user_name'] = $name;
                        header("Location:../module1/adminhomepage.php");
                }
                    
            }
            
           
        }
        else if ($table == 'student'){

            $query = "SELECT * FROM $table";
            $result = mysqli_query($link, $query); 

               
            while($row = mysqli_fetch_array($result)){
                $id =   $row['studentID'];
                $pass = $row['studentPassword'];
                $name = $row['studentName'];

                if($userID!=$id  || $pas != $pass){
                    echo "User or password not correct";
                }
                else{
                        $_SESSION['studentID'] = $id;
                        $_SESSION['user_name'] = $name;
                        header("Location:../module4/stdDash.php");
                }
                    
            }
        }
            else if ($table == 'coordinator'){

                $query = "SELECT student.studentID, student.studentPassword, coordinator.coordinatorID FROM student INNER JOIN coordinator
                ON student.studentID = coordinator.studentID
                WHERE coordinator.studentID = student.studentID";
                $result = mysqli_query($link, $query);
                   
                while($row = mysqli_fetch_array($result)){
                    $id =   $row['studentID'];
                    $pass = $row['studentPassword'];
                    $name = $row['studentName'];
    
                    if($userID!=$id  || $pas != $pass){
                        echo "User or password not correct";
                    }
                    else{
                            $coordinatorID = $row['coordinatorID'];
                            $_SESSION['coordinatorID'] = $coordinatorID;
                            $_SESSION['user_name'] = $name;
                            header("Location:../module1/homepage.php");
                    }
                }
          
        }
            exit();

    }


?>
</html>