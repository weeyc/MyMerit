<?php
    session_start();
?>
<!DOCTYPE html>
<!--Wee Yuu Cheng Cb18068 (4b)-->
<html>
<head>
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

<title>Update Student Merit</title>


<?php

$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());
mysqli_select_db($link, "mymerit") or die(mysqli_error());
?>



    <script type="text/javascript">
        var meritid = "<?php echo $mID ?>";
        var stdID = "<?php echo $stdID ?>"; 
        var stdName = "<?php echo $stdName ?>"; 
    </script>



<?php
if(isset($_POST['update']))
{
    $mID = $_POST['mid'];
    $stdId = $_POST['sID'];
    $stdN = $_POST['stdN'];
    $mPosi = $_POST['pmerit']; 
    
    $query =  "UPDATE merit
    SET positionMerit = $mPosi, totalMerit = (positionMerit + merit)
    WHERE MeritID ='$mID';" 	or die(mysqli_connect_error());
    $result = mysqli_query($link, $query); 

    if($result) 
    {	
?>
              <script type="text/javascript">
                    var stdID = "<?php echo $stdId ?>"; 
                    var stdName = "<?php echo $stdN ?>"; 
                    alert("New Position Merit for student: "+stdID+ " "+stdName+" has been Successfully update!");
                    window.location = "http://localhost/mymerit/module4/searchMerit.php";        
                </script>  
           
<?php   
    }
    else 
        {
?>   
            <script type="text/javascript">
                    alert("Update failed");
                    window.location = "http://localhost/mymerit/module4/searchMerit.php";
                  
             </script>   
<?php            
        }
}
           
?>
        <center>
            <form action="updateStdMerit.php" method="post" class = "w3-table-all w3-hoverable">
                <?php 
                    $mID = $_GET['mID'];
                    $stdID=$_GET['stdID'];
                    $stdName=$_GET['stdName'];
                ?>

                <p>Enter New Position merit for student: <br> <br>
                   <?php echo "$stdID  $stdName";?> </p>
                <input type="number" name="pmerit" placeholder="Position Merit"><br><br>
                <input type="hidden" name="mid" value="<?php echo $mID ?>"/>
                <input type="hidden" name="sID" value="<?php echo $stdID ?>"/>
                <input type="hidden" name="stdN" value="<?php echo $stdName ?>"/>
                <input type="submit" name="update" value="Update"><br><br>
    
            </form>
        </center>
        

        

</html>
