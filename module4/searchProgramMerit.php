<?php
    session_start();
?>
<!DOCTYPE html>
<!--Wee Yuu Cheng Cb18068 (4b)-->
<html>
<head>
<title>Search Program Merit</title>

</head>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/3cc6771f24.js"></script>
<div class="topnav">
<a href="../module1/adminHomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
            <div class="topnav-right">
                <a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
                <a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
</div>
</div>
<div class="startHere">

        <?php

        $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
        mysqli_select_db($link, "mymerit") or die(mysqli_error());

        //search by program ID to view merit
        if(isset($_POST['search']))
        {
            $valueToSearch = $_POST['valueToSearch'];
            $query = "SELECT merit.MeritID, merit.StudentID, student.studentName, program.programID, program.programName, merit.merit, merit.position, merit.positionMerit,merit.totalMerit
            FROM merit,student,program
            WHERE  merit.StudentID = student.studentID AND merit.programID = program.programID AND program.programID='$valueToSearch' ORDER BY merit.MeritID";
            $search_result = mysqli_query($link, $query); 
        }
        else { //show nothing 1st
            $query = "SELECT * FROM `merit` WHERE program.programID= NULL";
            $search_result = mysqli_query($link, $query);
        }

        //delete student merit
        if(isset($_POST['delete'])){
            $meritID = $_POST['id'];
            $pID = $_POST['pID'];
            $pName = $_POST['pName'];
            $Query = "DELETE FROM merit WHERE programID ='$pID';" 	or die(mysqli_connect_error());
            $result = mysqli_query($link, $Query);
        ?>
        
            <script type="text/javascript">
                    var x = "<?php echo $meritID?>";
                    var y = "<?php echo $pID?>";
                    var z = "<?php echo $pName?>";

                    alert("All merit for Program ID (" +y+") "+z+ " has been deleted");
                    window.location = "http://localhost/mymerit/module4/searchProgramMerit.php";                  
            </script> 
<?php
        }
        //update, will redirect to update page
        if(isset($_POST['update'])){

            $pID = $_POST['pID'];
            $pName = $_POST['pName'];
        
            $str="pID={$pID}&pName={$pName}";
    ?>
            <script type="text/javascript">
                 window.location="http://localhost/mymerit/module4/updateProMerit.php?<?php echo $str;?>";
            </script>
<?php
        }

        ?>

       
        
<body>


        <center>
        <form action="searchProgramMerit.php" method="post">
            <p>Search Program Merit:</p>
            <input type="text" name="valueToSearch" placeholder="Program ID"><br><br>
            <input type="submit" name="search" value="Search"><br><br>
            
            <table width=100% class = "w3-table-all w3-hoverable">
                <tr>
                    <th>No.</th>
                    <th>Merit ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Program ID</th>
                    <th>Program Name</th>
                    <th>Merit</th>
                    <th>Participate As</th>
                    <th>Position Merit</th>
                    <th>Total Merit</th>        
                </tr>
            
                <?php 
                $sr =1;
                if (isset($_POST['search'])){
                if (mysqli_num_rows($search_result) > 0) {      
                     while($row = mysqli_fetch_array($search_result)):?>
                <tr>

                <form action="searchMerit.php" method="post" role ="form">
                    <td><?php echo $sr;?></td>
                    <td><?php echo $row['MeritID'];?></td>
                    <td><?php echo $row['StudentID'];?></td>
                    <td><?php echo $row['studentName'];?></td>
                    <td><?php echo $row['programID'];?></td>
                    <td><?php echo $row['programName'];?></td>
                    <td><?php echo $row['merit'];?></td>
                    <td><?php echo $row['position'];?></td>
                    <td><?php echo $row['positionMerit'];?></td>
                    <td><?php echo $row['totalMerit'];?></td>
                    <?php 
                        $sr++;
                    ?>
                        
                    <td> 
                        <input type="hidden" name ="id" value="<?php echo $row['MeritID']; ?>">
                        <input type="hidden" name ="pID" value="<?php echo $row['programID']; ?>">
                        <input type="hidden" name ="pName" value="<?php echo $row['programName']; ?>"> 

                     </td>           
                </tr>
                <?php endwhile; 
                ?>

                    <tr>
                        <td colspan =10> 
                            <input type="submit" name="delete" value="Delete"  style="float: right;"  class = "w3-center w3-btn w3-red w3-small w3-round-large";>       
                         <input type="submit" name="update" value="Update"  style="float: right;" class = "w3-center w3-btn w3-teal w3-small w3-round-large";>  
                       
                        </td>
                    </tr> 
                    </form>
            <?php
                    }else {
             ?>
                        <td colspan =10> <div class="alert alert-warning"> <p>No available result!</p></div></td>
             <?php     
                    }
                }
            ?>
           
      

            </table>
        </form>
            
            </center>
            <br><br>
<button type="button" onclick="window.location.href='Adminhome.php'" class = "w3-center w3-btn w3-blue w3-small w3-round-large">Back</button>
        
    </body>
</html>