<!DOCTYPE html>
<!--Wee Yuu Cheng Cb18068 (4b)-->
<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<title>Deleted Merit</title>

<?php

$link = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

//Select the database.
mysqli_select_db($link, "tmerit") or die(mysqli_error());

$mID = $_GET['ID'];
$stdID=$_GET['stdID'];
$stdName=$_GET['stdName'];




//SQL query
$Query = "DELETE FROM merit WHERE MeritID ='$mID';" 	or die(mysqli_connect_error());

$result = mysqli_query($link, $Query);
    
        if($result) 
        { 
?>      
                <script type="text/javascript">
                    var sID = "<?php echo $stdID ?>";
                    var sName = "<?php echo $stdName ?>";
                            
                                
                            var xx = confirm("Merit for " +sID+" " + sName + " has been deleted!");
                                if (xx == true)
                                window.location = "sea.php?";            
                </script>  
<?php                
        }
        else 
            {
                    
                die("Merit release is failed");
            }
?>
 

</table>


</html>
