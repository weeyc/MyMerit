<?php 
 
require_once 'php_action/db_connect.php';

    if (isset($_GET['programID'])){
    $programID = $_GET['programID'];
    $sql = "SELECT * FROM program WHERE programID = {$programID}";
    $result = $connect->query($sql);
 
    $data = $result->fetch_assoc();
}


 if(isset($_POST['search']))
        {
            $valueToSearch = $_POST['valueToSearch'];
            $sql = "SELECT student.studentID, student.studentName   
                    FROM student
                    LEFT OUTER JOIN committee ON student.studentID=committee.studentID
                    WHERE student.studentID='$valueToSearch' AND student.studentID 
                    NOT IN (SELECT student.studentID 
                    FROM committee, student, program 
                    WHERE committee.studentID = student.studentID AND committee.programID = program.programID AND program.programID ='$programID')";
            $search_result = $connect->query($sql); 
           // $data = $search_result->fetch_assoc();
 
        }
        else { //show nothing 1st
            $sql = "SELECT student.studentID, student.studentName   
                    FROM student
                    LEFT OUTER JOIN committee ON student.studentID=committee.studentID
                    WHERE student.studentID='NULL' AND student.studentID 
                    NOT IN (SELECT student.studentID 
                    FROM committee, student, program 
                    WHERE committee.studentID = student.studentID AND committee.programID = program.programID AND program.programID ='$programID')";
            $search_result = $connect->query($sql); 
           // $data = $search_result->fetch_assoc();
 
        }


 if(isset($_POST['submit'])) 
 {
       
       $position =  $_POST['position'];
       $studentID = $_POST['studentID'];
       $programID = $_POST['programID'];
       $sql= "insert into committee (commiteeID,studentID,commiteePosition,programID) VALUES('','$studentID','$position','$programID')"; 
       
     if($connect->query($sql) === TRUE) {
?>
    <script type="text/javascript">
        alert ("Your Commitee Has Been Added");
    
    </script>

    <?php
    } 
    else {
        echo "Error " . $sql . ' ' . $connect->connect_error;
    }
    

    
}

 
?>


<!DOCTYPE html>
<html>
<head>
<title>Search Commitee</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/3cc6771f24.js"></script>
</head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<div class="topnav">
            <a href="homepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/coordinatorViewProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
            <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>

            </div>
</div>
        <center>
        <form action="" method="post">
            <p>Search Student ID:</p>
            <input type="text" name="valueToSearch" placeholder="Search"><br><br>
            <input type="submit" name="search" value="Search"><br><br>
            
            <table width=100% class = "w3-table-all w3-hoverable">
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Position </th>
                    <th>Action</th>
                </tr>
            
                <?php 
                if (isset($_POST['search'])){
                if ($search_result->num_rows>0) {      
                     while($row=$search_result->fetch_assoc()):?>
                <tr>

                 <form  action="" method="POST">
                    <td><?php echo $row['studentID'];?></td>
                    <td><?php echo $row['studentName'];?></td>
                    <td><select id="position" name="position">
                     <option value="Program chair">Program chair</option>
                     <option value="Program co-chair">Program co-chair</option>
                     <option value="Main committee">Main committee</option>
                     <option value="Sub committee">Sub committee</option>
                    </select></td>
                      <input type= "hidden" name="programID" value="<?php echo $programID;?>">
                    <input type= "hidden" name="studentID" value="<?php echo $row['studentID'];?>">
                    <td><button type="submit" name='submit'>Submit</button></td>  
                    </form> </td>

                     
                </tr>
                <?php endwhile; 
                 

                    }else {
             ?>
                        <td colspan =5> <div class="alert alert-warning"> <p>No available result!</p></div></td>
             <?php     
                    }
                }
            ?>
                    
      

            </table>
            <td><a href="indexprogram.php"><button type="button">Back</button></a></td>
        </form>
            
    </center>
        
    </body>
</html>
<?php

?>