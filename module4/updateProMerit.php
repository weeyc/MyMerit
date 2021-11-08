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
    
    $proId = $_POST['pid'];
    $pN = $_POST['pN'];
    $progMerit = $_POST['pmerit']; 

    $query =  "UPDATE merit
    SET merit = $progMerit, totalMerit = (positionMerit + $progMerit)
    WHERE programID ='$proId';" 	or die(mysqli_connect_error());
    $result = mysqli_query($link, $query); 

    if($result) 
    {	
?>
              <script type="text/javascript">
                    var pID = "<?php echo $proId ?>"; 
                    var pName = "<?php echo $pN ?>"; 
                    alert("All Merit for program: "+pID+ " "+pName+" has been Successfully update!");
                    window.location = "http://localhost/mymerit/module4/searchProgramMerit.php";        
                </script>  
           
<?php   
    }
    else 
        {
?>   
            <script type="text/javascript">
                    alert("Update failed");
                    window.location = "http://localhost/mymerit/module4/searchProgramMerit.php";
                  
             </script>   
<?php            
        }
}
           
?>
        <center>
            <form action="updateProMerit.php" method="post" class = "w3-table-all w3-hoverable">
                <?php 

                    $pID = $_GET['pID'];
                    $pName = $_GET['pName'];
                        
                ?>

                <p>Enter New Program merit for the program: <br> <br>
                   <?php echo "$pID  $pName";?> </p>
                <input type="number" name="pmerit" placeholder="Program Merit"><br><br>
                <input type="hidden" name="pid" value="<?php echo $pID ?>"/>
                <input type="hidden" name="pN" value="<?php echo $pName ?>"/>
                <input type="submit" name="update" value="Update"><br><br>
    
            </form>
        </center>
        

        

</html>
