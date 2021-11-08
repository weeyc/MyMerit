
<?php
    session_start();
?>
<!DOCTYPE html>

<html>
<head>
<title>Search Program For Generate QR Code</title>

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
            $search = $_POST['valueToSearch'];
            $query = "SELECT program.programID, program.programName, program.programLocation
					FROM program 
					WHERE program.status = 'Approved' AND program.programName LIKE '%$search' AND program.programID NOT IN (
					SELECT program.programID
					FROM program, qrcode
					WHERE qrcode.programID = program.programID AND qrcode.qrCodeType IN   ('Participant','Committee')  
					GROUP BY qrcode.programID 
					HAVING COUNT(DISTINCT qrcode.qrCodeType) =2)";
            $search_result = mysqli_query($link, $query); 
        }
        else { //show nothing 1st
            $query = "SELECT program.programID, program.programName, program.programLocation
					FROM program 
					WHERE program.status = 'Approved' AND program.programID NOT IN (
					SELECT program.programID
					FROM program, qrcode
					WHERE qrcode.programID = program.programID AND qrcode.qrCodeType IN   ('Participant','Committee')  
					GROUP BY qrcode.programID 
					HAVING COUNT(DISTINCT qrcode.qrCodeType) =2)
";
            $search_result = mysqli_query($link, $query);
        }

      
?>
       
        
<body>


        <center>
        <form action="" method="post">
            <p>Search Approved Program To Generate QR Code:</p>
            <input type="text" name="valueToSearch" placeholder="Program Name"><br><br>
            <input type="submit" name="search" value="Search"><br><br>
            
            <table width=100% class = "w3-table-all w3-hoverable">
                <tr>
                    <th>No</th>
                     <th>Program ID</th>
		            <th>Program Name</th>
		            <th>Program Location</th>
		            <th>QR Code</th>
                </tr>
            
                <?php 
                $sr =1;
                
                if (mysqli_num_rows($search_result) > 0) {      
                     while($row = mysqli_fetch_array($search_result)):?>
                <tr>

                <form action="" method="post" role ="form">
                    <td><?php echo $sr;?></td>
                    <td><?php echo $row["programID"]?></td>
		            <td><?php echo $row["programName"]?></td>
		            <td><?php echo $row["programLocation"]?></td>
                  
                    <?php 
                        $sr++;
                    ?>
                        
                    <td> 
                            <a href="./generate.php?programID=<?=$row['programID']?>" class="btn btn-primary" name="generate">Generate</a>      
  
                     </td>           
                </tr>
                <?php endwhile; 
                ?>

               

                    </form>
            <?php
                    }else {
             ?>
                        <td colspan =10> <div class="alert alert-warning"> <p>No available result!</p></div></td>
             <?php     
                    }
                
            ?>
           
      

            </table>
        </form>
            
            </center>
        
    </body>
</html>