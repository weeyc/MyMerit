<?php
    session_start();
$administratorID=$_SESSION['administratorID'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Search Coordinator Profile</title>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="ExternalCSS/topnav.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/3cc6771f24.js"></script>
</head>


<body>
<div class="topnav">
<a href="../module1/adminhomepage.php" style="margin-left: 5px;"><img src="ExternalImage/umplogo.png" width="110px" height="70px"><label style="font-size: 100%; padding-right: 5px;">Homepage</label></a>
<div class="topnav-right">
<a href="../module6/AdminProfile.php"><i class="fa fa-user" aria-hidden="true" style="font-size: 50px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
<a href="../module6/LoginMyMerit.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size: 48px; padding-right: 5px; padding-left: 5px; padding-top: 22%; padding-bottom: 22%;"></i></a>
</div>
</div>
<div class="startHere">
            <?php
            $link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
                    mysqli_select_db($link, "mymerit") or die(mysqli_error());


                if(isset($_POST['search'])){

                    $searchCoor = $_POST['searchCoor'];
                    $query1 = "SELECT * FROM coordinator WHERE coordinatorID  LIKE'%$searchCoor%'ORDER BY coordinator.coordinatorID";
                    $result1 = mysqli_query($link, $query1); 
                }

                    else {

                    $query1 = "SELECT * FROM `coordinator` WHERE coordinatorID= NULL";
                        $result1 = mysqli_query($link, $query1);
                }

                if(isset($_POST['delete'])){
                    $ID = $_POST['coordinatorID'];
                    echo "$ID";
                    $query2 = "DELETE FROM coordinator WHERE coordinatorID ='$ID'";
                    $result2 = mysqli_query($link, $query2);
                    if ($result2){
                            echo "delete ok";
                    }
                    else
                    
                        echo "NOT ok";
                    

        }
        ?>

</div>

<center>
        <form action="" method="post">
            <p>Search Coordinator :
            <?php
// total of coordinator count
              $query="SELECT COUNT(*) AS total FROM coordinator";
              $result=mysqli_query($link,$query);


          while($row=mysqli_fetch_assoc($result)){
              echo "(".$row['total'].")";
            }
            ?></p>
            <input type="text" name="searchCoor" placeholder="Coordinator ID"><br><br>
            <input type="submit" name="search" value="Search"><br><br>

        </form>

            <table width=100% class = "w3-table-all w3-hoverable">
                <tr>
                    <th>No.</th>
                    <th>Coordinator ID</th>
                    <th>Coordinator Name</th>
                    <th>Coordinator Email</th>
                    <th>Coordinator Telephone Number</th>
                    <th>Action</th>
                </tr>
            
                <?php 
                $i=1;
                if (isset($_POST['search'])){
                if (mysqli_num_rows($result1) > 0) {      
                     while($coordinator = mysqli_fetch_array($result1)){

                ?>

                <form action="" method="POST">
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $coordinator['coordinatorID'];?></td>
                    <td><?php echo $coordinator['coordinatorName'];?></td>
                    <td><?php echo $coordinator['coordinatorEmail'];?></td>
                    <td><?php echo $coordinator['coordinatorTelNo'];?></td>
                    <?php 
                        $i++;
                    ?>

                        
                    <td> 
<!--delete-->
                        <input type="hidden" name="coordinatorID" value="<?=$coordinator['coordinatorID']?>">
                        <input type="submit" name="delete" value="Delete" class = "w3-center w3-btn w3-red w3-small w3-round-large">  
                    
                    </td>

                    </tr>

                </form>
                    
                <?php  
                     }

                    }else {
                ?>
                        <td colspan =10> <div class="alert alert-warning"> <p>No available result!</p></div></td>
             <?php     
                    }
                }
            ?>

            </table>
            <button><center><a href="../module1/adminhomepage.php">Back</a></center></center></button>
        </center>

    </body>
</html>